#!/usr/bin/env php
<?php

declare(strict_types=1);

/**
 * Find SVG files that fail simplexml_load_string (same check as TYPO3 SvgIconProvider).
 * XML comments must not contain the substring "--" (e.g. avoid <!-- ... --accent ... -->).
 *
 * Usage (from TYPO3 project root):
 *   php public/typo3conf/ext/shadcn2fluid_templates/scripts/scan-svg-simplexml.php /var/www/html
 *   ddev exec php public/typo3conf/ext/shadcn2fluid_templates/scripts/scan-svg-simplexml.php /var/www/html
 */

$root = $argv[1] ?? '';
if ($root === '' || !is_dir($root)) {
    fwrite(STDERR, "Usage: php scan-svg-simplexml.php <directory-to-scan>\n");
    exit(2);
}

$root = realpath($root);
$failures = 0;

$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);

foreach ($it as $f) {
    if (!$f->isFile() || strcasecmp($f->getExtension(), 'svg') !== 0) {
        continue;
    }
    $path = $f->getPathname();
    $text = file_get_contents($path);
    if ($text === false) {
        continue;
    }
    libxml_use_internal_errors(true);
    $ok = simplexml_load_string($text) !== false;
    $errors = libxml_get_errors();
    libxml_clear_errors();

    if (!$ok) {
        $failures++;
        $rel = str_starts_with($path, $root . DIRECTORY_SEPARATOR)
            ? substr($path, strlen($root) + 1)
            : $path;
        fwrite(STDOUT, $rel . "\n");
        foreach ($errors as $e) {
            fwrite(STDOUT, '  ' . trim($e->message) . "\n");
        }
    }
}

if ($failures === 0) {
    fwrite(STDOUT, "No invalid SVG files under {$root}\n");
    exit(0);
}

fwrite(STDERR, "\n{$failures} file(s) failed.\n");
exit(1);
