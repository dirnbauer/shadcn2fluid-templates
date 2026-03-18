<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'ShadCN to Fluid Templates',
    'description' => 'ShadCN/UI design patterns converted to pure Fluid templates with tweakcn theme integration. Provides beautiful, accessible content elements without JavaScript.',
    'category' => 'templates',
    'author' => 'webconsulting studio',
    'author_email' => '',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.99.99',
            'fluid' => '13.4.0-14.99.99',
            'content_blocks' => '1.0.0-2.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
