<?php

declare(strict_types=1);

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'navigation',
    'Navigation & Headers',
    'before:default'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'hero',
    'Hero & Landing',
    'after:navigation'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'features',
    'Features & Benefits',
    'after:hero'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'content',
    'Content & Editorial',
    'after:features'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'social-proof',
    'Social Proof & Trust',
    'after:content'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'pricing',
    'Pricing & Commerce',
    'after:social-proof'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'team',
    'Team & About',
    'after:pricing'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'conversion',
    'Contact & Conversion',
    'after:team'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'data',
    'Data & Display',
    'after:conversion'
);

ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'footer',
    'Footer & Legal',
    'after:data'
);
