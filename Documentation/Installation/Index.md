# Installation

## Requirements

| Requirement | Version |
|-------------|---------|
| PHP | `^8.2` |
| TYPO3 | `^14.2@dev` |
| Content Blocks | `^2.1` |
| Composer | `2.x` |

TYPO3 14 requires the PHP `intl` extension in the runtime that executes Composer and TYPO3 CLI commands.

## Project setup

The project root should already target TYPO3 14.2 development builds. A minimal example:

```json
{
    "require": {
        "typo3/cms-core": "^14.2@dev",
        "typo3/cms-fluid": "^14.2@dev"
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

## Require the extension

```bash
composer require webconsulting/shadcn2fluid-templates
vendor/bin/typo3 extension:setup
vendor/bin/typo3 cache:flush
```

## Enable the site set

1. Open `Site Management > Sites`
2. Edit the target site configuration
3. Add the `ShadCN to Fluid Templates` set
4. Save
5. Flush caches again

## Verify the installation

Check that the package is installed:

```bash
vendor/bin/typo3 extension:list | grep shadcn2fluid_templates
```

Expected result:

```text
shadcn2fluid_templates    2.0.0    active
```

Then add a content element in the backend and confirm the ShadCN elements are available.

The installed set now includes:

- Hero
- Accordion / FAQ
- Alert / Callout
- Area Chart
- Card
- Call to Action
- Compare
- Contact
- Feature Grid
- Footer
- Gallery / Portfolio
- Logo Cloud
- Navbar
- Pricing
- Stats
- Team
- Testimonial
- Text with Media
- Timeline
- Blog Teasers

## Local development

If the extension is used from a local path repository:

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

Then require it as usual:

```bash
composer require webconsulting/shadcn2fluid-templates:@dev
```

## Next step

Continue with [Configuration](../Configuration/Index.md).
