<?php

declare(strict_types=1);

namespace PhpDocumentorLlms\Test\Functional;

use PhpDocumentorLlms\Test\Functional\Service\LlmsGeneratorService;
use PHPUnit\Framework\TestCase;

class FunctionalTestCase extends TestCase
{
    protected static LlmsGeneratorService $generator;

    public static function getProjectRootPath(): string
    {
        return dirname(__DIR__, 2);
    }

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$generator = new LlmsGeneratorService(self::getProjectRootPath());
        self::$generator->runPhpDocWithDir(self::getProjectRootPath() . '/src/Example');
    }

    public function getGenerator(): LlmsGeneratorService
    {
        return self::$generator;
    }

    final public static function assertFileContains(string $needle, string $filename, string $message = ''): void
    {
        $contents = self::$generator->loadContents($filename);
        self::assertStringContainsString(
            $needle,
            $contents,
            $message ?: "File $filename does not contain expected string."
        );
    }

    final public static function assertLlmsFileEquals(string $expectedPath, string $actualPath, string $message = ''): void
    {
        $expected = file_get_contents($expectedPath);
        $actual = self::$generator->loadContents($actualPath);
        self::assertEquals(
            $expected,
            $actual,
            $message ?: 'LLMS output does not match expected.'
        );
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::$generator->cleanup();
    }
}
