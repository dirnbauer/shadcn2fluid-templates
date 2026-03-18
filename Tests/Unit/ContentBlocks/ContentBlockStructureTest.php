<?php

declare(strict_types=1);

namespace Webconsulting\Shadcn2fluidTemplates\Tests\Unit\ContentBlocks;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ContentBlockStructureTest extends TestCase
{
    #[Test]
    #[DataProvider('contentBlockDirectories')]
    public function eachContentBlockProvidesRequiredFiles(string $contentBlockDirectory): void
    {
        self::assertFileExists($contentBlockDirectory . '/config.yaml');
        self::assertFileExists($contentBlockDirectory . '/assets/icon.svg');
        self::assertFileExists($contentBlockDirectory . '/templates/frontend.html');
    }

    #[Test]
    #[DataProvider('frontendTemplates')]
    public function frontendTemplatesDoNotContainInlineScripts(string $templatePath): void
    {
        $templateContent = (string) file_get_contents($templatePath);

        self::assertStringNotContainsString('<script', $templateContent);
    }

    /**
     * @return iterable<string, array{0: string}>
     */
    public static function contentBlockDirectories(): iterable
    {
        foreach (self::globDirectories(dirname(__DIR__, 3) . '/ContentBlocks/ContentElements/*') as $directory) {
            yield basename($directory) => [$directory];
        }
    }

    /**
     * @return iterable<string, array{0: string}>
     */
    public static function frontendTemplates(): iterable
    {
        foreach (self::globFiles(dirname(__DIR__, 3) . '/ContentBlocks/ContentElements/*/templates/frontend.html') as $templatePath) {
            yield basename(dirname(dirname($templatePath))) => [$templatePath];
        }
    }

    /**
     * @return list<string>
     */
    private static function globDirectories(string $pattern): array
    {
        $matches = glob($pattern, GLOB_ONLYDIR);

        if ($matches === false) {
            return [];
        }

        sort($matches);

        return $matches;
    }

    /**
     * @return list<string>
     */
    private static function globFiles(string $pattern): array
    {
        $matches = glob($pattern);

        if ($matches === false) {
            return [];
        }

        sort($matches);

        return $matches;
    }
}
