# ShadCN to Fluid Templates

TYPO3 content elements inspired by shadcn/ui, implemented as Content Blocks and Fluid templates for TYPO3 `^14.2@dev`.

## Status

- Extension key: `shadcn2fluid_templates`
- Extension version: `2.0.0`
- TYPO3 target: `^14.2@dev`
- Content Blocks target: `^2.1`
- PHP: `^8.2`

## Included and documented

- Hero
- Accordion / FAQ
- Alert / Callout
- Card
- Chart
- Contact
- Call to Action
- Feature Grid
- Logo Cloud
- Pricing
- Stats
- Team
- Testimonial
- Text with Media
- Timeline

The extension ships a broader set of content elements in the repository, plus a TYPO3 site set, bundled CSS, reusable Fluid partials, and a CSP-friendly external JavaScript asset for the chart element.

## Installation

Use the TYPO3 14.2 development line in the project root, then require the extension:

```bash
composer require webconsulting/shadcn2fluid-templates
vendor/bin/typo3 extension:setup
vendor/bin/typo3 cache:flush
```

Then enable the site set in the site configuration:

1. Open `Site Management > Sites`
2. Edit the target site
3. Add the `ShadCN to Fluid Templates` set
4. Save and flush caches

## Configuration

The site set loads:

- `EXT:shadcn2fluid_templates/Resources/Public/Css/shadcn-theme.css`
- `EXT:shadcn2fluid_templates/Resources/Public/Css/components.css`

Optional custom theme override:

```typoscript
plugin.tx_shadcn2fluid_templates.settings.customThemeCss = EXT:site_package/Resources/Public/Css/shadcn-theme.css
```

The extension also auto-loads `Configuration/page.tsconfig` and sets:

```typoscript
options.workspaces.previewPageId.tt_content = field:pid
```

That keeps workspace previews for draft content elements on the correct page in TYPO3 14.

## Workspaces

`tt_content` records are workspace-aware out of the box, so the content elements can be staged and previewed in TYPO3 workspaces. The important limitation is TYPO3’s normal FAL behavior:

- file references are versioned
- physical files are not versioned
- overwriting an existing file affects live and workspace previews immediately

Use new filenames for staged assets instead of replacing existing files in place.

## Quality gates

The extension now includes:

- `composer validate --strict`
- PHPStan level `9`
- PHPUnit smoke coverage for metadata and content-block structure

Run them locally with:

```bash
composer validate --strict
vendor/bin/phpstan analyse --configuration=phpstan.neon.dist
vendor/bin/phpunit --configuration=phpunit.xml.dist
```

## Documentation

- [Documentation index](Documentation/Index.md)
- [Installation](Documentation/Installation/Index.md)
- [Configuration](Documentation/Configuration/Index.md)
- [Workspaces](Documentation/Workspaces/Index.md)
- [Troubleshooting](Documentation/KnownProblems/Index.md)

## Notes

- TYPO3 14 requires PHP’s `ext-intl`.
- The Composer constraint intentionally follows the TYPO3 `14.2` development branch: `^14.2@dev`.
- This extension is not affiliated with shadcn/ui.
