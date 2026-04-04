# Configuration

## Site set

The extension is configured through the TYPO3 site set in:

`Configuration/Sets/Shadcn2fluidTemplates/`

The set loads the bundled CSS automatically when it is attached to a site.

## Bundled assets

The set includes:

```typoscript
page.includeCSS {
    shadcnTheme = EXT:shadcn2fluid_templates/Resources/Public/Css/shadcn-theme.css
    shadcnComponents = EXT:shadcn2fluid_templates/Resources/Public/Css/components.css
}
```

The chart content element loads its JavaScript with `f:asset.script`, so no inline JavaScript setup is needed in TypoScript.

## Custom theme override

The site set exposes two site settings that are stored in the TYPO3 site `config.yaml`:

- `shadcn2fluid.themeCss`
- `shadcn2fluid.themeSourceUrl`

Example:

```yaml
base: 'https://www.watchlist-internet.at/'
baseVariants:
  - base: 'https://staging.watchlist-internet.at/'
    condition: 'applicationContext == "Production/Staging"'

settings:
  'shadcn2fluid.themeCss': 'EXT:site_package/Resources/Public/Css/shadcn-theme.css'
  'shadcn2fluid.themeSourceUrl': 'https://tweakcn.com/editor/theme'
```

`shadcn2fluid.themeCss` controls which CSS file is loaded in the frontend. `shadcn2fluid.themeSourceUrl` is an optional reference to the tweakcn editor or shared preset used to generate that CSS.

## Page TSconfig

The extension auto-loads `Configuration/page.tsconfig` and configures workspace preview handling:

```typoscript
options.workspaces.previewPageId.tt_content = field:pid
```

This keeps workspace previews for content elements on the correct page in TYPO3 14.

## Content Blocks

Each element is defined in:

`ContentBlocks/ContentElements/*/config.yaml`

The extension relies on Content Blocks as the single source of truth for:

- field definitions
- backend form structure
- content element registration
- frontend template wiring

## Reusable partials

Reusable Fluid partials live in:

`Resources/Private/Partials/Components/`

To use them in your own Fluid setup, register the partial path in your site package.

## Extension Manager settings

There are no Extension Manager settings. Configuration is handled through the site set, TypoScript, CSS overrides, and Content Block definitions.

## Next step

Continue with [Workspaces](../Workspaces/Index.md).
