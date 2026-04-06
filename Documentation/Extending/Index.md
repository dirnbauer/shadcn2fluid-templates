# Extending the Extension

This chapter explains how to add your own content elements and customize existing ones.

## Adding New Content Elements

The extension uses TYPO3's Content Blocks system with Fluid 5 Components.

### Content Block Structure

Each content element follows this structure:

```
ContentBlocks/ContentElements/{element-name}/
├── assets/
│   ├── icon.svg              # Element icon for backend
│   └── frontend.css          # Element-specific composition CSS
├── config.yaml               # Field definitions
└── templates/
    └── frontend.html         # Main template using <s2f:*> components
```

### Step 1: Create the Directory Structure

```bash
mkdir -p ContentBlocks/ContentElements/my-element/assets
mkdir -p ContentBlocks/ContentElements/my-element/templates
```

### Step 2: Create the Icon

Create `assets/icon.svg`:

```xml
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
     stroke="currentColor" stroke-width="2">
    <rect x="3" y="4" width="18" height="16" rx="2"/>
    <path d="M3 10h18"/>
</svg>
```

### Step 3: Define Fields in config.yaml

```yaml
name: shadcn2fluid/my-element
title: My Element
description: Description of my element
group: content
prefixFields: false
fields:
  - identifier: header
    useExistingField: true
    label: Heading

  - identifier: subheadline
    type: Textarea
    label: Subheadline
    rows: 2

  - identifier: items
    type: Collection
    label: Items
    minItems: 1
    maxItems: 6
    fields:
      - identifier: title
        type: Text
        label: Item Title
        required: true
      - identifier: description
        type: Textarea
        label: Item Description
        rows: 2
```

### Step 4: Create the Frontend Template

Create `templates/frontend.html` using `<s2f:*>` Fluid 5 Components:

```html
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
      xmlns:cb="http://typo3.org/ns/TYPO3/CMS/ContentBlocks/ViewHelpers"
      xmlns:s2f="http://typo3.org/ns/Webconsulting/Shadcn2fluidTemplates/Components/ComponentCollection"
      data-namespace-typo3-fluid="true">

<f:asset.css identifier="s2f-my-element" href="{cb:assetPath()}/frontend.css"/>

<s2f:layout.section class="my-element">
    <s2f:layout.container>
        <f:if condition="{data.header}">
            <s2f:atom.typography tag="h2" variant="h2">{data.header}</s2f:atom.typography>
        </f:if>
        <f:if condition="{data.subheadline}">
            <s2f:atom.typography tag="p" variant="lead">{data.subheadline}</s2f:atom.typography>
        </f:if>

        <s2f:layout.grid cols="3" gap="default">
            <f:for each="{data.items}" as="item">
                <s2f:molecule.card>
                    <s2f:molecule.cardHeader title="{item.title}" />
                    <s2f:molecule.cardContent>
                        <s2f:atom.typography variant="muted">{item.description}</s2f:atom.typography>
                    </s2f:molecule.cardContent>
                </s2f:molecule.card>
            </f:for>
        </s2f:layout.grid>
    </s2f:layout.container>
</s2f:layout.section>

</html>
```

### Step 5: Add Element CSS

Create `assets/frontend.css` with composition styles only (component primitives are loaded globally):

```css
.my-element {
    text-align: center;
}

.my-element .grid {
    margin-top: 2rem;
}
```

### Step 6: Clear Cache

```bash
vendor/bin/typo3 cache:flush
```

## Available Fluid 5 Components

Use these `<s2f:*>` tags in your templates:

### Atoms
- `<s2f:atom.button variant="default" size="lg" link="{data.button_link}">Text</s2f:atom.button>`
- `<s2f:atom.button variant="default" size="lg" href="https://example.com">Text</s2f:atom.button>`
- `<s2f:atom.badge variant="outline">Label</s2f:atom.badge>`
- `<s2f:atom.typography tag="h2" variant="h2">Heading</s2f:atom.typography>`
- `<s2f:atom.input type="email" placeholder="..." />`
- `<s2f:atom.avatar src="..." alt="..." size="lg" />`
- `<s2f:atom.separator orientation="horizontal" />`
- `<s2f:atom.progress value="75" />`

### Molecules
- `<s2f:molecule.card>...</s2f:molecule.card>`
- `<s2f:molecule.alert variant="destructive">...</s2f:molecule.alert>`
- `<s2f:molecule.accordion>...</s2f:molecule.accordion>`
- `<s2f:molecule.tabs defaultValue="tab1">...</s2f:molecule.tabs>`

### Layout
- `<s2f:layout.section background="muted" spacing="lg">...</s2f:layout.section>`
- `<s2f:layout.container size="lg">...</s2f:layout.container>`
- `<s2f:layout.grid cols="3" gap="default">...</s2f:layout.grid>`
- `<s2f:layout.stack direction="horizontal" gap="default">...</s2f:layout.stack>`

## Naming Conventions

- Content block directories: `{element-name}` (kebab-case, no prefix)
- config.yaml name: `shadcn2fluid/{element-name}`
- CSS classes: `.{element}`, `.{element}__{child}`, `.{element}--{modifier}` (BEM)
- Always use CSS custom properties for colors, radius, shadows

## Best Practices

### Use the stdheader Field

Always use `identifier: header` with `useExistingField: true` for element headings. This maps to TYPO3's native `tt_content.header` column.

### Compose with Components

Always use `<s2f:*>` components instead of raw HTML for buttons, cards, badges, etc. This ensures consistent styling and that the Styleguide page stays in sync.

### Consistent Styling

```css
/* Use CSS custom properties */
.my-element {
    color: var(--foreground);
    background: var(--background);
    border: 1px solid var(--border);
    border-radius: var(--radius);
}
```

### Accessibility

- Semantic HTML elements
- ARIA attributes where needed
- Keyboard navigation support
- Sufficient color contrast
- Alt text for images

---

**Previous:** [Theming](../Theming/Index.md) | **Next:** [Known Problems](../KnownProblems/Index.md)
