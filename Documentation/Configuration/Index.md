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
settings:
  'shadcn2fluid.themeCss': 'EXT:site_package/Resources/Public/Css/shadcn-theme.css'
  'shadcn2fluid.themeSourceUrl': 'https://ui.shadcn.com/create?preset=b2D0wqNxT'
```

`shadcn2fluid.themeCss` controls which CSS file is loaded in the frontend. `shadcn2fluid.themeSourceUrl` is an optional reference to the [ui.shadcn.com/create](https://ui.shadcn.com/create) preset used to generate that CSS — stored for traceability, does not affect rendering.

### Creating a custom theme

1. Go to [ui.shadcn.com/create](https://ui.shadcn.com/create)
2. Customize colors, radius, fonts, shadows
3. Export the CSS (`:root` and `.dark` blocks)
4. Save it in your site package
5. Set `shadcn2fluid.themeCss` to the path

See [Theming](../Theming/Index.md) for a detailed guide.

## Page templates and styling

Page templates, backend layouts, and page-level styling are **not** part of this extension. Use the [Desiderio](https://github.com/dirnbauer/desiderio) theme extension for:

- Backend layouts with visual-editor content areas (PAGEVIEW)
- 5 page templates (Startpage, Contentpage, Sidebar, Styleguide, Default)
- 5 swappable design styles
- Dark mode toggle
- Auto-generated styleguide

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
