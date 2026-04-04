#!/bin/bash
# Temporarily patch ProcessingInput.php to show which content block is missing typeName
FILE="/var/www/html/vendor/friendsoftypo3/content-blocks/Classes/Definition/Factory/Processing/ProcessingInput.php"

cat > /tmp/patch.php << 'PHPEOF'
<?php
$file = $argv[1];
$code = file_get_contents($file);
$old = "return \$this->yaml['typeName'];";
$new = <<<'PHP'
if (!array_key_exists('typeName', $this->yaml)) {
    throw new \RuntimeException('Missing typeName for table: ' . $this->table . ' contentType: ' . $this->contentType->value . ' yaml keys: ' . implode(', ', array_keys($this->yaml)));
}
return $this->yaml['typeName'];
PHP;
$code = str_replace($old, $new, $code);
file_put_contents($file, $code);
echo "Patched successfully.\n";
PHPEOF

php /tmp/patch.php "$FILE"
