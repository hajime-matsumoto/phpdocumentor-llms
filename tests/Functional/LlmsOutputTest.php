<?php

declare(strict_types=1);

namespace PhpDocumentorLlms\Test\Functional;

class LlmsOutputTest extends FunctionalTestCase
{
    public function testLlmsTxtExists(): void
    {
        self::assertTrue(
            self::$generator->fileExists('llms.txt'),
            'llms.txt should be generated'
        );
    }

    public function testLlmsFullTxtExists(): void
    {
        self::assertTrue(
            self::$generator->fileExists('llms-full.txt'),
            'llms-full.txt should be generated'
        );
    }

    public function testLlmsTxtContainsProjectTitle(): void
    {
        self::assertFileContains(
            '# Example Project',
            'llms.txt',
            'llms.txt should contain project title'
        );
    }

    public function testLlmsTxtContainsNamespaceOverview(): void
    {
        self::assertFileContains(
            '\PhpDocumentorLlms\Example',
            'llms.txt',
            'llms.txt should contain namespace'
        );
    }

    public function testLlmsTxtContainsClassList(): void
    {
        self::assertFileContains(
            'UserService',
            'llms.txt',
            'llms.txt should list UserService class'
        );
        self::assertFileContains(
            'User',
            'llms.txt',
            'llms.txt should list User class'
        );
    }

    public function testLlmsTxtContainsInterfaceList(): void
    {
        self::assertFileContains(
            'UserRepositoryInterface',
            'llms.txt',
            'llms.txt should list UserRepositoryInterface'
        );
    }

    public function testLlmsFullTxtContainsMethodDetails(): void
    {
        self::assertFileContains(
            'findById',
            'llms-full.txt',
            'llms-full.txt should contain method details'
        );
        self::assertFileContains(
            'Create a new user',
            'llms-full.txt',
            'llms-full.txt should contain method documentation'
        );
    }

    public function testLlmsFullTxtContainsPropertyDetails(): void
    {
        self::assertFileContains(
            '$name',
            'llms-full.txt',
            'llms-full.txt should contain property details'
        );
        self::assertFileContains(
            '$email',
            'llms-full.txt',
            'llms-full.txt should contain property details'
        );
    }

    public function testLlmsFullTxtContainsTypeInfo(): void
    {
        self::assertFileContains(
            'string',
            'llms-full.txt',
            'llms-full.txt should contain type information'
        );
    }

    public function testLlmsTxtMatchesExpected(): void
    {
        self::assertLlmsFileEquals(
            __DIR__ . '/expected/llms.txt',
            'llms.txt',
            'llms.txt should match expected output'
        );
    }

    public function testLlmsFullTxtMatchesExpected(): void
    {
        self::assertLlmsFileEquals(
            __DIR__ . '/expected/llms-full.txt',
            'llms-full.txt',
            'llms-full.txt should match expected output'
        );
    }
}
