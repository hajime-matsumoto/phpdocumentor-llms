<?php

declare(strict_types=1);

namespace PhpDocumentorLlms\Test\Functional\Service;

use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class LlmsGeneratorService
{
    protected string $projectRootPath;
    protected string $workingDir;
    protected Filesystem $filesystem;

    public function __construct(string $projectRootPath)
    {
        $this->projectRootPath = $projectRootPath;
        $this->filesystem = new Filesystem();
        $this->workingDir = tempnam(sys_get_temp_dir(), 'phpdoc-llms');
        $this->filesystem->remove($this->workingDir);

        if (!mkdir($this->workingDir) && !is_dir($this->workingDir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $this->workingDir));
        }
    }

    public function cleanup(): void
    {
        $this->filesystem->remove($this->workingDir);
    }

    protected function getProjectRootPath(): string
    {
        return $this->projectRootPath;
    }

    protected function getPhpDocBinaryPath(): string
    {
        // Use phar if available, fallback to vendor
        $pharPath = dirname($this->getProjectRootPath()) . '/phpDocumentor.phar';
        if (file_exists($pharPath)) {
            return $pharPath;
        }
        return "{$this->getProjectRootPath()}/vendor/bin/phpdoc";
    }

    public function runPhpDocWithDir(string $path, array $arguments = []): Process
    {
        if (!is_dir($path)) {
            throw new InvalidArgumentException(sprintf('The path "%s" is not a directory.', $path));
        }

        $this->filesystem->mirror($path, "$this->workingDir/test");

        $process = new Process(
            array_merge(
                [
                    PHP_BINARY,
                    $this->getPhpDocBinaryPath(),
                    '-vvv',
                    '--force',
                    '--directory=' . $this->workingDir . '/test',
                    '--target=' . $this->workingDir . '/output',
                    '--template=' . $this->getProjectRootPath() . '/themes/llms',
                    '--title=Example Project',
                ],
                $arguments
            ),
            $this->getProjectRootPath()
        );

        $process->setTimeout(120);

        return $process->mustRun();
    }

    public function loadContents(string $filename): string
    {
        $path = $this->workingDir . '/output/' . $filename;
        if (!file_exists($path)) {
            throw new RuntimeException("File not found: $path");
        }
        return file_get_contents($path);
    }

    public function fileExists(string $filename): bool
    {
        return file_exists($this->workingDir . '/output/' . $filename);
    }
}
