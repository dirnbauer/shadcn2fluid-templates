<?php

declare(strict_types=1);

/**
 * Wrap Content Block text fields with f:render.text for EXT:visual_editor (TYPO3 v14).
 * Field list comes from each content block config.yaml (Text, Textarea, useExistingField).
 *
 * Usage: php scripts/apply-visual-editor-fluid.php
 */

use Symfony\Component\Yaml\Yaml;

require dirname(__DIR__) . '/vendor/autoload.php';

$base = dirname(__DIR__) . '/ContentBlocks/ContentElements';

/** @var list<string> */
$blacklist = [
    'table_data',
    'chart_data',
    'code',
];

/**
 * @param array<int, mixed> $fields
 * @return list<string>
 */
function collectTextFields(array $fields): array
{
    $out = [];
    foreach ($fields as $field) {
        if (!is_array($field)) {
            continue;
        }
        $id = $field['identifier'] ?? null;
        if (!is_string($id) || $id === '') {
            continue;
        }
        $type = $field['type'] ?? null;
        if (($field['useExistingField'] ?? false) === true) {
            $out[] = $id;
            continue;
        }
        if (in_array($type, ['Textarea', 'Text'], true)) {
            $out[] = $id;
            continue;
        }
        if ($type === 'Collection') {
            $nested = $field['fields'] ?? [];
            if (is_array($nested)) {
                foreach (collectTextFields($nested) as $n) {
                    $out[] = $n;
                }
            }
        }
    }

    return array_values(array_unique($out));
}

$updated = 0;
foreach (glob($base . '/*/config.yaml') ?: [] as $configPath) {
    /** @var array<string, mixed> $yaml */
    $yaml = Yaml::parseFile($configPath);
    $fields = $yaml['fields'] ?? [];
    if (!is_array($fields)) {
        continue;
    }
    $textFields = array_flip(collectTextFields($fields));

    $htmlPath = dirname($configPath) . '/templates/frontend.html';
    if (!is_file($htmlPath)) {
        continue;
    }
    $html = file_get_contents($htmlPath);
    if ($html === false) {
        continue;
    }
    $original = $html;

    $replaceField = static function (string $var, string $field) use ($textFields, $blacklist): string {
        if (!isset($textFields[$field]) || in_array($field, $blacklist, true)) {
            return '{' . $var . '.' . $field . '}';
        }

        return sprintf('{%s -> f:render.text(field: \'%s\')}', $var, $field);
    };

    // 1) <f:format.html>{var.field}</f:format.html> → f:render.text
    $html = preg_replace_callback(
        '/<f:format\.html>\s*\{([a-zA-Z_][a-zA-Z0-9]*)\.([a-zA-Z0-9_]+)\}\s*<\/f:format\.html>/s',
        static function (array $m) use ($replaceField): string {
            return $replaceField($m[1], $m[2]);
        },
        $html
    );

    // 2) Bare {var.field} for text fields (avoid touching {data.media.0} — no closing brace after first segment)
    $html = preg_replace_callback(
        '/\{([a-zA-Z_][a-zA-Z0-9]*)\.([a-zA-Z0-9_]+)\}/',
        static function (array $m) use ($replaceField): string {
            return $replaceField($m[1], $m[2]);
        },
        $html
    );

    if ($html !== $original) {
        file_put_contents($htmlPath, $html);
        ++$updated;
    }
}

fwrite(STDOUT, "Updated {$updated} frontend.html file(s).\n");

// Use raw field access in condition="..." (f:render.text breaks empty checks there).
$condPat = '/\{([a-zA-Z_][a-zA-Z0-9]*) -> f:render\.text\(field: \'([a-zA-Z0-9_]+)\'\)\}/';
$condFixed = 0;
foreach (glob($base . '/*/templates/frontend.html') ?: [] as $htmlPath) {
    $html = file_get_contents($htmlPath);
    if ($html === false) {
        continue;
    }
    $fixed = preg_replace_callback(
        '/\bcondition="([^"]*)"/',
        static function (array $m) use ($condPat): string {
            $inner = preg_replace($condPat, '{$1.$2}', $m[1]);

            return 'condition="' . $inner . '"';
        },
        $html
    );
    if ($fixed !== $html) {
        file_put_contents($htmlPath, $fixed);
        ++$condFixed;
    }
}
fwrite(STDOUT, "Adjusted condition attributes in {$condFixed} file(s).\n");
