<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    // ==============================================
    // Hero Variant Icons
    // ==============================================
    'shadcn2fluid-hero-centered' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/ContentElements/hero-centered.svg',
    ],
    'shadcn2fluid-hero-split' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/ContentElements/hero-split.svg',
    ],
    'shadcn2fluid-hero-background' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/ContentElements/hero-background.svg',
    ],

    // ==============================================
    // Card Variant Icons
    // ==============================================
    'shadcn2fluid-card-basic' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/card-basic.svg',
    ],
    'shadcn2fluid-card-image' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/card-image.svg',
    ],
    'shadcn2fluid-card-horizontal' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/card-horizontal.svg',
    ],

    // ==============================================
    // Alert Variant Icons
    // ==============================================
    'shadcn2fluid-alert-default' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/alert-default.svg',
    ],
    'shadcn2fluid-alert-info' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/alert-info.svg',
    ],
    'shadcn2fluid-alert-success' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/alert-success.svg',
    ],
    'shadcn2fluid-alert-warning' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/alert-warning.svg',
    ],
    'shadcn2fluid-alert-destructive' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:shadcn2fluid_templates/Resources/Public/Icons/Variants/alert-destructive.svg',
    ],
];
