<?php

declare(strict_types=1);

namespace Webconsulting\Shadcn2fluidTemplates\Tests\Unit\Configuration;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ExtensionMetadataTest extends TestCase
{
    private const EXTENSION_KEY = 'shadcn2fluid_templates';

    #[Test]
    public function composerConfigurationTargetsTypo3Version14Only(): void
    {
        $composerConfiguration = $this->readComposerConfiguration();
        $requirements = $composerConfiguration['require'];
        $suggestions = $composerConfiguration['suggest'];

        self::assertSame('typo3-cms-extension', $composerConfiguration['type']);
        self::assertSame('^14.3@dev', $requirements['typo3/cms-core']);
        self::assertSame('^14.3@dev', $requirements['typo3/cms-fluid']);
        self::assertSame('^2.2', $requirements['friendsoftypo3/content-blocks']);
        self::assertSame(
            'Recommended to stage and preview content elements in TYPO3 workspaces.',
            $suggestions['typo3/cms-workspaces'],
        );
    }

    #[Test]
    public function extEmconfDependenciesMatchComposerRequirements(): void
    {
        $extensionConfiguration = $this->loadExtensionConfiguration();
        $dependencies = $extensionConfiguration['constraints']['depends'];
        $suggestions = $extensionConfiguration['constraints']['suggests'];

        self::assertSame('3.0.0', $extensionConfiguration['version']);
        self::assertSame('14.3.0-14.99.99', $dependencies['typo3']);
        self::assertSame('14.3.0-14.99.99', $dependencies['fluid']);
        self::assertSame('2.2.0-2.99.99', $dependencies['content_blocks']);
        self::assertSame('14.3.0-14.99.99', $suggestions['workspaces']);
    }

    #[Test]
    public function legacyTypoScriptDirectoryWasRemoved(): void
    {
        self::assertDirectoryDoesNotExist(dirname(__DIR__, 3) . '/Configuration/TypoScript');
    }

    /**
     * @return array{
     *     type: string,
     *     require: array<string, string>,
     *     suggest: array<string, string>
     * }
     */
    private function readComposerConfiguration(): array
    {
        $composerConfiguration = json_decode((string) file_get_contents(dirname(__DIR__, 3) . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($composerConfiguration);
        self::assertIsString($composerConfiguration['type'] ?? null);

        return [
            'type' => $composerConfiguration['type'],
            'require' => $this->assertStringMap($composerConfiguration['require'] ?? null),
            'suggest' => $this->assertStringMap($composerConfiguration['suggest'] ?? null),
        ];
    }

    /**
     * @return array{
     *     version: string,
     *     constraints: array{
     *         depends: array<string, string>,
     *         suggests: array<string, string>
     *     }
     * }
     */
    private function loadExtensionConfiguration(): array
    {
        $extensionConfiguration = (static function (string $extensionKey, string $configurationPath): array {
            $EM_CONF = [];
            $_EXTKEY = $extensionKey;

            require $configurationPath;

            return $EM_CONF[$_EXTKEY] ?? [];
        })(self::EXTENSION_KEY, dirname(__DIR__, 3) . '/ext_emconf.php');

        self::assertIsArray($extensionConfiguration);
        self::assertIsString($extensionConfiguration['version'] ?? null);
        self::assertIsArray($extensionConfiguration['constraints'] ?? null);

        return [
            'version' => $extensionConfiguration['version'],
            'constraints' => [
                'depends' => $this->assertStringMap($extensionConfiguration['constraints']['depends'] ?? null),
                'suggests' => $this->assertStringMap($extensionConfiguration['constraints']['suggests'] ?? null),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    private function assertStringMap(mixed $value): array
    {
        self::assertIsArray($value);

        $stringMap = [];
        foreach ($value as $key => $entry) {
            self::assertIsString($key);
            self::assertIsString($entry);
            $stringMap[$key] = $entry;
        }

        return $stringMap;
    }
}
