# shadcn2fluid Templates

shadcn/ui-inspired Fluid 5 component library and content elements for TYPO3 14, implemented as native Fluid 5 Components (atomic design) and Content Blocks.

## Status

- Extension key: `shadcn2fluid_templates`
- Extension version: `3.0.0`
- TYPO3 target: `^14.2`
- Content Blocks target: `^2.1`
- PHP: `^8.2`

## Architecture

Three-layer system following shadcn/ui principles:

1. **Fluid 5 Components** (`<s2f:atom.*>`, `<s2f:molecule.*>`, `<s2f:layout.*>`) — typed primitives with `<f:argument>` and `<f:slot>`
2. **Content Blocks** — 250 content elements composing Fluid 5 Components
3. **Theme extension** — page templates and styling are provided by a separate theme, e.g. [Desiderio](https://github.com/dirnbauer/desiderio)

## Included content elements (250)

Organized in 10 wizard categories (25 each):

| Category | Examples |
|---|---|
| Navigation & Headers | Navbar, Mega Menu, Breadcrumb, Sticky Navbar, ... |
| Hero & Landing | Hero, Hero Video, Hero Stats, Hero Fullscreen, ... |
| Features & Benefits | Feature Cards, Feature Bento, Feature Tabs, ... |
| Content & Editorial | Textmedia, Accordion, Tabs, FAQ, Gallery, ... |
| Social Proof & Trust | Testimonial, Stats, Logo Cloud, Awards, ... |
| Pricing & Commerce | Pricing, Pricing Toggle, Product Card, ... |
| Team & About | Team, About Us, Career Listing, Company Values, ... |
| Contact & Conversion | Contact, CTA, Newsletter, Demo Request, ... |
| Data & Display | Card, Chart, KPI Cards, Data Table, ... |
| Footer & Legal | Footer, Cookie Banner, Imprint, GDPR Banner, ... |

## Page Templates

Page templates and styling are **not included** in this extension. Use a theme extension like [Desiderio](https://github.com/dirnbauer/desiderio) which provides:

- Backend layouts with visual-editor content areas (PAGEVIEW)
- 5 page templates (Startpage, Contentpage, Sidebar, Styleguide, Default)
- 5 swappable design styles (SaaS, Corporate, Portfolio, Blog, Dashboard)
- Dark mode toggle
- Auto-generated styleguide page

## Fluid 5 Components

37 components using `<f:argument>` typed parameters and `<f:slot>` for child content:

**Atoms (16):** Button, Badge, Input, Textarea, Label, Select, Separator, Avatar, Icon, Image, Link, Typography, Progress, Skeleton, AspectRatio, ScrollArea

**Molecules (17):** Card, CardHeader, CardContent, CardFooter, Alert, AlertTitle, AlertDescription, Accordion, AccordionItem, Tabs, TabsList, TabsTrigger, TabsContent, Table, TableHeader, TableRow, TableCell

**Layout (4):** Section, Container, Grid, Stack

## Installation

Requires TYPO3 14.2+ with PHP 8.2+:

```bash
composer require webconsulting/shadcn2fluid-templates
vendor/bin/typo3 extension:setup
vendor/bin/typo3 cache:flush
```

Then enable the site set:

1. Open `Site Management > Sites`
2. Edit the target site
3. Add the `shadcn2fluid Templates` set
4. Save and flush caches

For page templates, also install [Desiderio](https://github.com/dirnbauer/desiderio):

```bash
composer require webconsulting/desiderio
```

## Configuration

The site set loads:

- `shadcn-theme.css` — OKLch design tokens (generate at [ui.shadcn.com/create](https://ui.shadcn.com/create))
- `components.css` — BEM component styles for all Fluid 5 Components
- `s2f.js` — Shared vanilla JS (accordion, tabs, dark mode, counters)

Custom theme override via site set settings:

```yaml
settings:
  'shadcn2fluid.themeCss': 'EXT:site_package/Resources/Public/Css/shadcn-theme.css'
  'shadcn2fluid.themeSourceUrl': 'https://ui.shadcn.com/create#b2D0wqNxT'
```

### Creating a custom theme

1. Go to [ui.shadcn.com/create](https://ui.shadcn.com/create)
2. Customize colors, radius, fonts, shadows
3. Copy the generated CSS (`:root` and `.dark` blocks)
4. Save it in your site package, e.g. `EXT:site_package/Resources/Public/Css/shadcn-theme.css`
5. Set `shadcn2fluid.themeCss` in your site configuration

## Quality gates

```bash
composer validate --strict
vendor/bin/phpstan analyse --configuration=phpstan.neon.dist
vendor/bin/phpunit --configuration=phpunit.xml.dist
```

## Documentation

- [Documentation index](Documentation/Index.md)
- [Installation](Documentation/Installation/Index.md)
- [Configuration](Documentation/Configuration/Index.md)
- [Theming](Documentation/Theming/Index.md)
- [Troubleshooting](Documentation/KnownProblems/Index.md)

## Notes

- TYPO3 14 requires PHP's `ext-intl`.
- This extension is not affiliated with shadcn/ui.
- Theme CSS uses OKLch color space — customize at [ui.shadcn.com/create](https://ui.shadcn.com/create).
