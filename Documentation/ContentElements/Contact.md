# Contact

**Content Block Name:** `shadcn2fluid/contact`

Contact combines editorial intro content, a structured information panel, and a simple lead-form layout.

## Templates

- `full-width`
- `two-columns`
- `stacked`

## Main fields

| Field | Type | Purpose |
|-------|------|---------|
| `eyebrow` | Text | Small section kicker |
| `headline` | Text | Main section heading |
| `subheadline` | Textarea | Supporting copy |
| `info_title` | Text | Contact panel title |
| `info_text` | Textarea | Contact panel intro |
| `contact_items` | Collection | Label/value/link rows |
| `form_title` | Text | Form title |
| `form_description` | Textarea | Form helper text |
| `form_action` | Link | Optional form target |
| `form_method` | Select | `post` or `get` |
| `submit_text` | Text | Submit button label |
| `privacy_text` | Textarea | Privacy note below the fields |

## Notes

- the block renders a presentational form layout only
- form processing must be handled by the target URL or a dedicated TYPO3 form solution
