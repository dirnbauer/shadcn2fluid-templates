<?php
$file = '/var/www/html/vendor/friendsoftypo3/content-blocks/Classes/Definition/Factory/Processing/ProcessingInput.php';
$code = file_get_contents($file);
$old = <<<'PHP'
    private function resolveTypeName(): string|int
    {
        if ($this->typeField === null && $this->contentType !== ContentType::FILE_TYPE) {
            return '1';
        }
        return $this->yaml['typeName'];
    }
PHP;
$new = <<<'PHP'
    private function resolveTypeName(): string|int
    {
        if ($this->typeField === null && $this->contentType !== ContentType::FILE_TYPE) {
            return '1';
        }
        if (!array_key_exists('typeName', $this->yaml)) {
            throw new \RuntimeException(
                'Missing typeName for table=' . $this->table
                . ' typeField=' . ($this->typeField ?? 'NULL')
                . ' contentType=' . $this->contentType->value
                . ' yaml=' . json_encode($this->yaml, JSON_UNESCAPED_SLASHES)
            );
        }
        return $this->yaml['typeName'];
    }
PHP;
$code = str_replace($old, $new, $code);
file_put_contents($file, $code);
echo "Patched OK\n";
