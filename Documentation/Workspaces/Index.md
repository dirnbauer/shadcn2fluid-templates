# Workspaces

## Scope

The extension uses TYPO3 content elements (`tt_content`) via Content Blocks. That means workspace support follows TYPO3 core behavior for versioned content records.

## What works

- draft versions of the content elements can be staged in workspaces
- previews open on the source page through `options.workspaces.previewPageId.tt_content = field:pid`
- file references on content elements are versioned with the record

## Important limitation

TYPO3 does not version physical files in FAL. Only the relation to the file is versioned.

That has practical consequences:

- uploading a new file is immediately present on disk
- overwriting an existing file changes it for live and workspace previews
- confidential files should never rely on “the page is still in workspace” as protection

## Recommended workflow

- upload new staged assets with unique filenames
- do not replace existing live files in place
- use private or protected storage for sensitive files
- review file references during workspace preview before publishing

## Extension-specific notes

- the chart element no longer injects inline JavaScript, which makes strict CSP setups easier
- wizard registration is left to Content Blocks; the extension TSconfig only keeps workspace preview behavior

## Related configuration

```typoscript
options.workspaces.previewPageId.tt_content = field:pid
```
