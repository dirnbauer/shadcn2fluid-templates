# shadcn2fluid Templates

> Extension key: `shadcn2fluid_templates`
>
> Version: `3.0.0`
>
> TYPO3 target: `^14.2`
>
> Author: `webconsulting studio`

## Overview

This extension provides shadcn/ui-inspired content elements for TYPO3 14, built on native Fluid 5 Components (atomic design) and Content Blocks. It ships 250 content elements and 37 reusable Fluid 5 Components.

Page templates and styling are provided by a separate theme extension — see [Desiderio](https://github.com/dirnbauer/desiderio).

## Highlights

- TYPO3 `^14.2` only
- Content Blocks `^2.1`
- Native Fluid 5 Components with `<f:argument>` typed parameters
- Atomic design: `<s2f:atom.*>`, `<s2f:molecule.*>`, `<s2f:layout.*>`
- 250 content elements in 10 wizard categories
- OKLch design tokens via `shadcn-theme.css` (generate at [ui.shadcn.com/create](https://ui.shadcn.com/create))
- BEM CSS, no utility class dependencies
- Shared vanilla JS (`s2f.js`) for interactive components
- Workspace-aware content staging
- PHPStan level 9 and PHPUnit coverage

## Page templates

Page templates are **not included** in this extension. Use [Desiderio](https://github.com/dirnbauer/desiderio) for:

- Backend layouts with PAGEVIEW and visual-editor content areas
- 5 page templates (Startpage, Contentpage, Sidebar, Styleguide, Default)
- 5 swappable design styles
- Dark mode toggle

## Content element categories (250 total)

| Category | Count |
|---|---|
| Navigation & Headers | 25 |
| Hero & Landing | 25 |
| Features & Benefits | 25 |
| Content & Editorial | 25 |
| Social Proof & Trust | 25 |
| Pricing & Commerce | 25 |
| Team & About | 25 |
| Contact & Conversion | 25 |
| Data & Display | 25 |
| Footer & Legal | 25 |

## Navigation

```{toctree}
:maxdepth: 2
:titlesonly:

Installation/Index
Configuration/Index
ShadcnWorkflow/Index
Roadmap/Index
Workspaces/Index
ContentElements/Index
Theming/Index
Extending/Index
KnownProblems/Index
```

## Compatibility

| Requirement | Version |
|-------------|---------|
| TYPO3 | `^14.2` |
| PHP | `^8.2` |
| Content Blocks | `^2.1` |

## Support

- Issue tracker: <https://github.com/dirnbauer/shadcn2fluid-templates/issues>
- Source: <https://github.com/dirnbauer/shadcn2fluid-templates>
