# Page Templates

Page templates have been moved to the [Desiderio](https://github.com/dirnbauer/desiderio) theme extension.

## Why a separate extension?

shadcn2fluid-templates is a **component library** — it provides 250 content elements and 37 Fluid 5 Components. Page templates, backend layouts, and visual styling are the responsibility of a theme extension.

This separation means you can:

- Use the content elements with any theme, not just Desiderio
- Swap visual designs without reinstalling content elements
- Keep your component library stable while iterating on page design

## Desiderio

[Desiderio](https://github.com/dirnbauer/desiderio) is the recommended theme extension. It provides:

- 4 backend layouts (Startpage, Contentpage, Contentpage with Sidebar, Styleguide)
- PAGEVIEW rendering with visual-editor content areas
- 5 swappable design styles (SaaS Landing, Corporate, Portfolio, Blog, Dashboard)
- Dark mode with sun/moon toggle
- Auto-generated styleguide showing all 250 content elements

Install it alongside shadcn2fluid-templates:

```bash
composer require webconsulting/desiderio
```

## Building your own theme

If you prefer a custom theme instead of Desiderio, your theme extension should:

1. Depend on `webconsulting/shadcn2fluid-templates` in `composer.json`
2. Use `PAGEVIEW` for page rendering (enables visual-editor content areas)
3. Register backend layouts with named `identifier` fields for content areas
4. Include `s2f:` components via the namespace `xmlns:s2f="http://typo3.org/ns/Webconsulting/Shadcn2fluidTemplates/Components/ComponentCollection"`

See Desiderio's source code for a complete reference implementation.
