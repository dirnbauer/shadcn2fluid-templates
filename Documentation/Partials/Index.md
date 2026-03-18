# Component Partials

This chapter documents the reusable Fluid partials included with the extension. These partials can be used in your own templates to maintain consistent styling.

## Overview

The extension provides five core component partials:

| Partial | Description | File |
|---------|-------------|------|
| [Button](#button) | Versatile button/link component | `Components/Button.html` |
| [Badge](#badge) | Small label/tag component | `Components/Badge.html` |
| [Typography](#typography) | Styled text elements | `Components/Typography.html` |
| [Card](#card) | Container component | `Components/Card.html` |
| [Separator](#separator) | Horizontal/vertical divider | `Components/Separator.html` |

## Using Partials in Your Templates

### Register the Partial Path

Add the extension's partial path to your Fluid configuration:

```typoscript
lib.contentElement {
    partialRootPaths {
        100 = EXT:shadcn2fluid_templates/Resources/Private/Partials/
    }
}
```

### Render a Partial

```html
<f:render partial="Components/Button" arguments="{
    link: 'https://example.com',
    text: 'Click Me',
    variant: 'default',
    size: 'lg'
}"/>
```

---

## Button

A versatile button component that renders as either a link (`<a>`) or button (`<button>`) element.

**File:** `Components/Button.html`

### Arguments

| Argument | Type | Default | Description |
|----------|------|---------|-------------|
| `link` | string | - | URL for anchor element |
| `text` | string | - | Button label text |
| `variant` | string | `default` | Style variant |
| `size` | string | `default` | Size variant |
| `type` | string | `button` | Button type (for `<button>`) |
| `disabled` | bool | `false` | Disabled state |
| `class` | string | - | Additional CSS classes |
| `children` | string | - | Child content (HTML) |

### Variants

| Variant | Description | CSS Class |
|---------|-------------|-----------|
| `default` | Primary filled button | `shadcn-btn--default` |
| `secondary` | Secondary muted button | `shadcn-btn--secondary` |
| `outline` | Bordered button | `shadcn-btn--outline` |
| `ghost` | Transparent button | `shadcn-btn--ghost` |
| `destructive` | Danger/delete button | `shadcn-btn--destructive` |
| `link` | Text link style | `shadcn-btn--link` |

### Sizes

| Size | Description | CSS Class |
|------|-------------|-----------|
| `default` | Standard size | `shadcn-btn--default-size` |
| `sm` | Small button | `shadcn-btn--sm` |
| `lg` | Large button | `shadcn-btn--lg` |
| `icon` | Square icon button | `shadcn-btn--icon` |

### Examples

**Primary Link Button:**
```html
<f:render partial="Components/Button" arguments="{
    link: '/signup',
    text: 'Get Started',
    variant: 'default',
    size: 'lg'
}"/>
```

**Outline Button:**
```html
<f:render partial="Components/Button" arguments="{
    link: '/learn-more',
    text: 'Learn More',
    variant: 'outline'
}"/>
```

**Ghost Button:**
```html
<f:render partial="Components/Button" arguments="{
    link: '/pricing',
    text: 'View Pricing',
    variant: 'ghost'
}"/>
```

**Submit Button:**
```html
<f:render partial="Components/Button" arguments="{
    text: 'Submit Form',
    type: 'submit',
    variant: 'default'
}"/>
```

**Destructive Action:**
```html
<f:render partial="Components/Button" arguments="{
    text: 'Delete Account',
    variant: 'destructive',
    type: 'button'
}"/>
```

**Disabled Button:**
```html
<f:render partial="Components/Button" arguments="{
    text: 'Unavailable',
    disabled: 1
}"/>
```

**Icon Button:**
```html
<f:render partial="Components/Button" arguments="{
    link: '/search',
    size: 'icon',
    children: '<svg>...</svg>'
}"/>
```

---

## Badge

A small label component for tags, categories, or status indicators.

**File:** `Components/Badge.html`

### Arguments

| Argument | Type | Default | Description |
|----------|------|---------|-------------|
| `text` | string | - | Badge text content |
| `variant` | string | `default` | Style variant |
| `class` | string | - | Additional CSS classes |

### Variants

| Variant | Description | CSS Class |
|---------|-------------|-----------|
| `default` | Primary colored badge | `shadcn-badge--default` |
| `secondary` | Muted secondary badge | `shadcn-badge--secondary` |
| `outline` | Bordered badge | `shadcn-badge--outline` |
| `destructive` | Error/danger badge | `shadcn-badge--destructive` |

### Examples

**Default Badge:**
```html
<f:render partial="Components/Badge" arguments="{text: 'New'}"/>
```

**Category Badge:**
```html
<f:render partial="Components/Badge" arguments="{
    text: 'Technology',
    variant: 'secondary'
}"/>
```

**Status Badge:**
```html
<f:render partial="Components/Badge" arguments="{
    text: 'Deprecated',
    variant: 'destructive'
}"/>
```

**Outline Badge:**
```html
<f:render partial="Components/Badge" arguments="{
    text: 'Coming Soon',
    variant: 'outline'
}"/>
```

---

## Typography

Styled text elements following shadcn/ui typography conventions.

**File:** `Components/Typography.html`

### Arguments

| Argument | Type | Default | Description |
|----------|------|---------|-------------|
| `text` | string | - | Text content |
| `tag` | string | `p` | HTML tag to render |
| `variant` | string | `p` | Typography style |
| `class` | string | - | Additional CSS classes |

### Tags

Available HTML tags: `h1`, `h2`, `h3`, `h4`, `p`, `span`

### Variants

| Variant | Description | CSS Class |
|---------|-------------|-----------|
| `h1` | Extra large heading | `shadcn-h1` |
| `h2` | Large heading | `shadcn-h2` |
| `h3` | Medium heading | `shadcn-h3` |
| `h4` | Small heading | `shadcn-h4` |
| `p` | Body paragraph | `shadcn-p` |
| `lead` | Large lead paragraph | `shadcn-lead` |
| `large` | Large semibold text | `shadcn-large` |
| `small` | Small text | `shadcn-small` |
| `muted` | Muted gray text | `shadcn-muted` |

### Examples

**Page Title:**
```html
<f:render partial="Components/Typography" arguments="{
    text: 'Welcome to Our Platform',
    tag: 'h1',
    variant: 'h1'
}"/>
```

**Lead Paragraph:**
```html
<f:render partial="Components/Typography" arguments="{
    text: 'A brief introduction to what we offer.',
    tag: 'p',
    variant: 'lead'
}"/>
```

**Muted Helper Text:**
```html
<f:render partial="Components/Typography" arguments="{
    text: 'Last updated 3 days ago',
    tag: 'span',
    variant: 'muted'
}"/>
```

---

## Card

A container component with optional header, content, and footer sections.

**File:** `Components/Card.html`

### Arguments

| Argument | Type | Default | Description |
|----------|------|---------|-------------|
| `title` | string | - | Card title |
| `description` | string | - | Card description |
| `content` | string | - | Card body (HTML allowed) |
| `footer` | string | - | Card footer (HTML allowed) |
| `class` | string | - | Additional CSS classes |

### Example

```html
<f:render partial="Components/Card" arguments="{
    title: 'Account Settings',
    description: 'Manage your account preferences.',
    content: '<p>Configure your notification settings, privacy options, and more.</p>',
    footer: '<button class=\"shadcn-btn shadcn-btn--default\">Save Changes</button>'
}"/>
```

### Output Structure

```html
<div class="shadcn-card">
    <div class="shadcn-card__header">
        <h3 class="shadcn-card__title">Account Settings</h3>
        <p class="shadcn-card__description">Manage your account preferences.</p>
    </div>
    <div class="shadcn-card__content">
        <p>Configure your notification settings...</p>
    </div>
    <div class="shadcn-card__footer">
        <button class="shadcn-btn shadcn-btn--default">Save Changes</button>
    </div>
</div>
```

---

## Separator

A horizontal or vertical divider line.

**File:** `Components/Separator.html`

### Arguments

| Argument | Type | Default | Description |
|----------|------|---------|-------------|
| `orientation` | string | `horizontal` | Direction |
| `class` | string | - | Additional CSS classes |

### Orientations

| Orientation | Description | CSS Class |
|-------------|-------------|-----------|
| `horizontal` | Full-width horizontal line | `shadcn-separator--horizontal` |
| `vertical` | Full-height vertical line | `shadcn-separator--vertical` |

### Examples

**Horizontal Separator:**
```html
<f:render partial="Components/Separator"/>
```

**Vertical Separator (in flex container):**
```html
<div style="display: flex; align-items: center; height: 50px;">
    <span>Left</span>
    <f:render partial="Components/Separator" arguments="{orientation: 'vertical'}"/>
    <span>Right</span>
</div>
```

---

## Creating Custom Partials

Extend the extension with your own component partials:

### 1. Create the Partial File

```html
<!-- EXT:your_site_package/Resources/Private/Partials/Components/CustomComponent.html -->
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
      data-namespace-typo3-fluid="true">

<div class="custom-component {class}">
    <f:if condition="{title}">
        <h3 class="custom-component__title">{title}</h3>
    </f:if>
    <div class="custom-component__content">
        {content -> f:format.raw()}
    </div>
</div>

</html>
```

### 2. Add CSS Styles

```css
/* EXT:your_site_package/Resources/Public/Css/components.css */
.custom-component {
    padding: 1.5rem;
    background: hsl(var(--card));
    border: 1px solid hsl(var(--border));
    border-radius: var(--radius);
}

.custom-component__title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
}
```

### 3. Use the Partial

```html
<f:render partial="Components/CustomComponent" arguments="{
    title: 'My Custom Component',
    content: '<p>Content goes here.</p>'
}"/>
```

---

**Previous:** [Theming](../Theming/Index.md) | **Next:** [Extending](../Extending/Index.md)
