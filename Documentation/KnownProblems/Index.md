# Known Problems & Troubleshooting

## Composer cannot install TYPO3 packages

### Symptom

Composer fails while resolving TYPO3 core packages.

### Checks

- confirm the project root targets TYPO3 `^14.2@dev`
- confirm `minimum-stability` is `dev`
- confirm `prefer-stable` is `true`
- confirm PHP `ext-intl` is available in the CLI runtime

## Content elements do not appear in the backend

### Checks

1. Confirm the extension is installed:

```bash
vendor/bin/typo3 extension:list | grep shadcn2fluid_templates
```

2. Flush caches:

```bash
vendor/bin/typo3 cache:flush
vendor/bin/typo3 cache:flush -g system
```

3. Confirm the site uses the `ShadCN to Fluid Templates` site set.

## CSS does not load

### Checks

- verify the site set is assigned to the site
- verify the generated page output includes both bundled CSS files
- verify a custom theme override path points to a readable file

## Workspace preview shows an unexpected file

### Cause

The record is versioned, but the physical file is not.

### Fix

- upload a new file with a new filename
- update the workspace record to point to that new file
- do not overwrite the live asset in place

## Charts do not render

### Checks

- ensure the chart data is valid JSON
- inspect the browser console for JSON parsing errors
- confirm the external chart asset is included in the page output

Example JSON:

```json
[
  {"label": "Jan", "value": 186},
  {"label": "Feb", "value": 305}
]
```

## Validation commands

```bash
composer validate --strict
vendor/bin/phpstan analyse --configuration=phpstan.neon.dist
vendor/bin/phpunit --configuration=phpunit.xml.dist
```
