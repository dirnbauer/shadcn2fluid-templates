# Installation

This chapter guides you through installing the ShadCN to Fluid Templates extension in your TYPO3 project.

## Prerequisites

Before installing, ensure your environment meets these requirements:

| Requirement | Version | Notes |
|-------------|---------|-------|
| PHP | 8.2 or higher | Required for TYPO3 13/14 |
| TYPO3 | 13.4+ or 14.x | Both LTS and current versions supported |
| Composer | 2.x | Required for installation |
| content_blocks | 1.x or 2.x | Automatically installed as dependency |

## Installation via Composer

### Step 1: Require the Package

```bash
composer require webconsulting/shadcn2fluid-templates
```

This command automatically:
- Downloads the extension
- Installs the `friendsoftypo3/content-blocks` dependency
- Registers the package in your TYPO3 installation

### Step 2: Activate the Extension

After composer installation, activate the extension:

```bash
# Using TYPO3 CLI
vendor/bin/typo3 extension:setup

# Using DDEV
ddev exec vendor/bin/typo3 extension:setup
```

### Step 3: Clear All Caches

```bash
# Using TYPO3 CLI
vendor/bin/typo3 cache:flush

# Using DDEV
ddev exec vendor/bin/typo3 cache:flush
```

## Manual Installation (Development)

For local development or when the package is not published to Packagist:

### Step 1: Place the Extension

Copy or clone the extension to your packages directory:

```
your-project/
├── packages/
│   └── shadcn2fluid_templates/
│       ├── composer.json
│       ├── ext_emconf.php
│       └── ...
```

### Step 2: Configure Composer Repository

Add the path repository to your root `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "packages/*"
        }
    ]
}
```

### Step 3: Require the Local Package

```bash
composer require webconsulting/shadcn2fluid-templates:@dev
```

### Step 4: Complete Installation

```bash
vendor/bin/typo3 extension:setup
vendor/bin/typo3 cache:flush
```

## Verification

After installation, verify the extension is active:

### Via CLI

```bash
vendor/bin/typo3 extension:list | grep shadcn
```

Expected output:
```
shadcn2fluid_templates    1.0.0    active
```

### Via TYPO3 Backend

1. Navigate to **Admin Tools → Extensions**
2. Search for "shadcn"
3. Confirm the extension shows as "Installed"

### Content Elements Available

After successful installation, these content elements appear in the "Common" tab of the content element wizard:

- ShadCN Hero Section
- ShadCN Accordion / FAQ
- ShadCN Alert / Callout
- ShadCN Card
- ShadCN Call to Action
- ShadCN Feature Grid
- ShadCN Testimonial
- ShadCN Text with Media

## TypoScript Inclusion

The extension's TypoScript is automatically included via `ext_localconf.php`. However, if you need to manually include it:

### Constants

```typoscript
@import 'EXT:shadcn2fluid_templates/Configuration/TypoScript/constants.typoscript'
```

### Setup

```typoscript
@import 'EXT:shadcn2fluid_templates/Configuration/TypoScript/setup.typoscript'
```

## Troubleshooting Installation

### Content Elements Not Appearing

1. Ensure `content_blocks` extension is active:
   ```bash
   vendor/bin/typo3 extension:list | grep content_blocks
   ```

2. Clear all caches:
   ```bash
   vendor/bin/typo3 cache:flush
   ```

3. Rebuild content block cache:
   ```bash
   vendor/bin/typo3 cache:flush -g system
   ```

### CSS Not Loading

1. Verify TypoScript is included in your site template
2. Check browser DevTools Network tab for 404 errors
3. Ensure your page template includes CSS assets

### Database Errors

If you encounter database errors after installation:

```bash
# Compare and update database schema
vendor/bin/typo3 database:updateschema
```

---

**Next:** [Configuration](../Configuration/Index.md)
