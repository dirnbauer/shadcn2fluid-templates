<?php
$file = '/var/www/html/vendor/friendsoftypo3/content-blocks/Classes/Definition/Factory/Processing/ProcessingInput.php';
$code = file_get_contents($file);
$old = 'return $this->yaml[\'typeName\'];';
$new = 'if(!array_key_exists(\'typeName\',$this->yaml)){throw new \RuntimeException(\'Missing typeName table: \'.$this->table.\' type: \'.$this->contentType->value.\' keys: \'.implode(\',\',array_keys($this->yaml)));}return $this->yaml[\'typeName\'];';
$code = str_replace($old, $new, $code);
file_put_contents($file, $code);
echo "Patched.\n";
