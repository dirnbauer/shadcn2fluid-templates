<?php

declare(strict_types=1);

$_EXTKEY ??= 'shadcn2fluid_templates';

$EM_CONF[$_EXTKEY] = [
    'title' => 'ShadCN to Fluid Templates',
    'description' => 'ShadCN/UI design patterns converted to pure Fluid templates with tweakcn theme integration. Provides accessible TYPO3 14 content elements based on Content Blocks 2.x.',
    'category' => 'templates',
    'author' => 'webconsulting studio',
    'author_email' => '',
    'state' => 'stable',
    'version' => '3.0.0',
    'constraints' => [
        'depends' => [
            'php' => '8.2.0-8.4.99',
            'typo3' => '14.3.0-14.99.99',
            'fluid' => '14.3.0-14.99.99',
            'content_blocks' => '2.2.0-2.99.99',
        ],
        'conflicts' => [],
        'suggests' => [
            'workspaces' => '14.3.0-14.99.99',
        ],
    ],
];
