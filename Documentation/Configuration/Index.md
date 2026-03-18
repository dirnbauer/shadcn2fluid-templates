# Configuration

This chapter covers the configuration options for ShadCN to Fluid Templates.

## TypoScript Configuration

The extension provides TypoScript constants for customization.

### Available Constants

```typoscript
# Custom theme CSS file (overrides default theme)
plugin.tx_shadcn2fluid_templates.settings.customThemeCss =
```

### CSS Inclusion

The extension automatically includes these CSS files via TypoScript setup:

```typoscript
page {
    includeCSS {
        # Base theme variables (from tweakcn)
        shadcnTheme = EXT:shadcn2fluid_templates/Resources/Public/Css/shadcn-theme.css

        # Component styles
        shadcnComponents = EXT:shadcn2fluid_templates/Resources/Public/Css/components.css
    }
}
```

## Custom Theme Configuration

### Option 1: Custom Theme File

Create a custom theme CSS file and configure it via TypoScript constants:

```typoscript
# In your site's TypoScript constants
plugin.tx_shadcn2fluid_templates.settings.customThemeCss = fileadmin/css/my-custom-theme.css
```

### Option 2: Override via Site Package

In your site package's CSS, override the CSS custom properties:

```css
/* EXT:your_site_package/Resources/Public/Css/theme-override.css */
:root {
    --primary: oklch(0.5 0.2 250);
    --primary-foreground: oklch(1 0 0);
    /* ... more overrides */
}
```

Then include it after the extension's CSS in your TypoScript:

```typoscript
page.includeCSS {
    siteThemeOverride = EXT:your_site_package/Resources/Public/Css/theme-override.css
    siteThemeOverride.after = shadcnComponents
}
```

## Page TSconfig

The extension includes Page TSconfig for content element configuration:

**File:** `Configuration/page.tsconfig`

This configures:
- Content element icons
- Wizard positioning
- Field configurations

### Custom Page TSconfig

To customize content element behavior, add to your site's Page TSconfig:

```typoscript
# Example: Restrict ShadCN elements to specific page types
[page["doktype"] == 1]
    mod.wizards.newContentElement.wizardItems.common {
        elements {
            shadcn2fluid_hero.hidden = 0
        }
    }
[end]
```

## Content Block Configuration

Each content element is configured via YAML files in `ContentBlocks/ContentElements/*/config.yaml`.

### Field Display Conditions

Many fields use `displayCond` to show/hide based on other field values:

```yaml
# Example: Image field only shown for non-centered variants
- identifier: hero_image
  type: File
  displayCond: 'FIELD:variant:!=:centered'
```

### Customizing Field Labels

Override field labels via TCA overrides in your site package:

```php
// EXT:your_site_package/Configuration/TCA/Overrides/tt_content.php
$GLOBALS['TCA']['tt_content']['columns']['shadcn2fluid_hero_headline']['label'] = 'My Custom Label';
```

## Fluid Template Paths

### Registering Additional Partial Paths

To use the ShadCN component partials in your own templates:

```typoscript
lib.contentElement {
    partialRootPaths {
        100 = EXT:shadcn2fluid_templates/Resources/Private/Partials/
    }
}
```

### Using in Standalone Fluid Templates

```html
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
      data-namespace-typo3-fluid="true">

{namespace shadcn=Webconsulting\Shadcn2fluidTemplates\ViewHelpers}

<!-- Use the Button partial -->
<f:render partial="Components/Button" arguments="{
    link: 'https://example.com',
    text: 'Click Me',
    variant: 'default',
    size: 'lg'
}"/>

</html>
```

## Extension Configuration

The extension does not require any settings in the Extension Manager. All configuration is done via TypoScript and CSS.

## Cache Configuration

Content blocks are cached by TYPO3's standard caching mechanism. No additional cache configuration is required.

For development, you may want to disable caching:

```typoscript
# Development only!
config.no_cache = 1
```

---

**Next:** [Content Elements](../ContentElements/Index.md)
