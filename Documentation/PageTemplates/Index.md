# Page Templates

The extension now ships 10 backend-selectable TYPO3 page templates as Content Blocks Page Types.

## Available page templates

1. SaaS Marketing
2. Corporate Company
3. Agency Studio
4. Startup Launch
5. Docs Knowledge Base
6. Blog Magazine
7. Ecommerce Brand
8. Event Conference
9. Dashboard App Shell
10. Personal Brand Portfolio

## What each page template includes

- logo / brand field support
- main navigation from the TYPO3 page tree
- optional header CTA
- hero eyebrow, headline, subheadline, and CTA fields
- hero image field
- footer brand and footer copy fields
- rendering of the default main content column (`colPos = 0`)

## Rendering model

The page templates are mapped by `doktype` in the shipped TypoScript setup. The frontend shell lives in:

- `Resources/Private/Templates/Pages/`
- `Resources/Private/Partials/Page/Shell.html`

The TYPO3 page tree remains the navigation source. Editors choose the page template by selecting the corresponding Page Type in the backend.

## Note

These page templates provide the structural shell. The body is still composed with content elements, which is the intended TYPO3 model for this extension.
