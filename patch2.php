<?php
$file = '/var/www/html/vendor/friendsoftypo3/content-blocks/Classes/Definition/Factory/Processing/ProcessingInput.php';
$code = file_get_contents($file);
$search = "\$this->yaml['typeName'];\n    }";
$replace = "\$this->yaml['typeName'];\n    }\n";
if (strpos($code, 'DEBUGPATCHED') === false) {
    $code = str_replace(
        "return \$this->yaml['typeName'];",
        "if(!array_key_exists('typeName',\$this->yaml)){throw new \\RuntimeException('DEBUGPATCHED typeName missing table='.\$this->table.' typeField='.\$this->typeField.' contentType='.\$this->contentType->value.' yaml='.json_encode(\$this->yaml,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));}return \$this->yaml['typeName'];",
        $code
    );
    file_put_contents($file, $code);
    echo "Patched OK\n";
} else {
    echo "Already patched\n";
}
