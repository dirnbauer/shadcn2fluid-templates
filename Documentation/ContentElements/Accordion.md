# Accordion / FAQ

**Content Block Name:** `shadcn2fluid/accordion`

The Accordion component creates collapsible content sections, perfect for FAQs, feature lists, and any content that benefits from progressive disclosure.

## Features

- **Pure CSS/HTML** - Uses native `<details>` and `<summary>` elements
- **No JavaScript required** - Works without JavaScript
- **Multiple open mode** - Optionally allow multiple sections open simultaneously
- **Rich text content** - Full RTE support for answers
- **Accessible** - Keyboard navigable with proper ARIA support

## Layout

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│                     Section Headline                        │
│                                                             │
├─────────────────────────────────────────────────────────────┤
│  ▼  What is this product?                                   │
├─────────────────────────────────────────────────────────────┤
│     This is the answer to the question. It can contain      │
│     rich text with formatting, links, and more.             │
│                                                             │
├─────────────────────────────────────────────────────────────┤
│  ▶  How does it work?                                       │
├─────────────────────────────────────────────────────────────┤
│  ▶  What are the pricing options?                           │
├─────────────────────────────────────────────────────────────┤
│  ▶  How do I get started?                                   │
└─────────────────────────────────────────────────────────────┘
```

## Field Reference

### Section Fields

| Field | Type | Description |
|-------|------|-------------|
| `headline` | Text | Optional headline above the accordion |
| `allow_multiple` | Checkbox | Allow multiple items to be open at once |

### Item Fields (Collection)

| Field | Type | Description |
|-------|------|-------------|
| `title` | Text | Question or item title (required) |
| `content` | Textarea (RTE) | Answer or item content (required) |
| `open_by_default` | Checkbox | Whether this item starts expanded |

## Usage Examples

### FAQ Section

A common FAQ layout with multiple questions and answers:

1. Add the "ShadCN Accordion / FAQ" content element
2. Set the headline to "Frequently Asked Questions"
3. Add items with question/answer pairs
4. Enable "Allow Multiple Open" if desired

### Feature Breakdown

Use the accordion to progressively reveal feature details:

1. Set headline to "Features"
2. Add items for each feature category
3. Include detailed descriptions with formatting

### Terms and Conditions

Long legal text benefits from accordion formatting:

1. Group terms into logical sections
2. Each section becomes an accordion item
3. Users can expand only what they need

## CSS Classes

```css
.shadcn-accordion-section          /* Main wrapper */
.shadcn-accordion-section__headline /* Section headline */
.shadcn-accordion                  /* Accordion container */
.shadcn-accordion__item            /* Individual item (<details>) */
.shadcn-accordion__trigger         /* Item header (<summary>) */
.shadcn-accordion__title           /* Title text */
.shadcn-accordion__icon            /* Chevron icon */
.shadcn-accordion__content         /* Expanded content */
```

## Customization

### Custom Icon Animation

```css
.shadcn-accordion__icon {
    transition: transform 0.3s ease;
}

.shadcn-accordion__item[open] .shadcn-accordion__icon {
    transform: rotate(180deg);
}
```

### Hover Effect

```css
.shadcn-accordion__trigger:hover {
    color: hsl(var(--primary));
    background-color: hsl(var(--muted) / 0.5);
}
```

### Custom Border Style

```css
.shadcn-accordion__item {
    border-bottom: 2px solid hsl(var(--primary) / 0.2);
}

.shadcn-accordion__item:last-child {
    border-bottom: none;
}
```

### Card-Style Items

```css
.shadcn-accordion__item {
    background: hsl(var(--card));
    border: 1px solid hsl(var(--border));
    border-radius: var(--radius);
    margin-bottom: 0.5rem;
    padding: 0 1rem;
}
```

## JavaScript Enhancement (Optional)

While the accordion works without JavaScript, you can add an enhancement for single-item-open behavior:

```javascript
// Optional: Force single item open (when allow_multiple is false)
document.querySelectorAll('.shadcn-accordion[data-allow-multiple="false"]').forEach(accordion => {
    accordion.querySelectorAll('.shadcn-accordion__item').forEach(item => {
        item.addEventListener('toggle', (e) => {
            if (item.open) {
                accordion.querySelectorAll('.shadcn-accordion__item').forEach(other => {
                    if (other !== item) other.open = false;
                });
            }
        });
    });
});
```

## Accessibility

The accordion is fully accessible:

- Uses native `<details>`/`<summary>` elements
- Keyboard navigable (Enter/Space to toggle)
- Screen reader announces expanded/collapsed state
- No JavaScript required for core functionality

## Best Practices

1. **Keep questions concise** - Clear, scannable titles
2. **Front-load important info** - Most relevant items first
3. **Use rich text wisely** - Format answers for readability
4. **Consider default states** - Open the most important item by default
5. **Test keyboard navigation** - Ensure smooth tab experience

---

**Previous:** [Hero Section](Hero.md) | **Next:** [Alert / Callout](Alert.md)
