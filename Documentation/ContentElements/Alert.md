# Alert / Callout

**Content Block Name:** `shadcn2fluid/alert`

The Alert component displays important messages, tips, warnings, or error notifications with appropriate visual styling and optional icons.

## Variants

### Default

Neutral alert for general information.

```
┌─────────────────────────────────────────────────────────────┐
│  ⓘ  Alert Title                                            │
│     Alert content with additional details...                │
└─────────────────────────────────────────────────────────────┘
```

### Info

Blue-tinted alert for informational messages.

```
┌─────────────────────────────────────────────────────────────┐
│  ℹ️  Did you know?                                          │
│     Here's some helpful information you might find useful.  │
└─────────────────────────────────────────────────────────────┘
```

### Success

Green-tinted alert for success messages.

```
┌─────────────────────────────────────────────────────────────┐
│  ✓  Success!                                                │
│     Your action was completed successfully.                 │
└─────────────────────────────────────────────────────────────┘
```

### Warning

Yellow/orange-tinted alert for warnings.

```
┌─────────────────────────────────────────────────────────────┐
│  ⚠  Attention Required                                      │
│     Please review this information before proceeding.       │
└─────────────────────────────────────────────────────────────┘
```

### Destructive / Error

Red-tinted alert for errors or critical information.

```
┌─────────────────────────────────────────────────────────────┐
│  ✕  Error                                                   │
│     Something went wrong. Please try again.                 │
└─────────────────────────────────────────────────────────────┘
```

## Field Reference

| Field | Type | Description |
|-------|------|-------------|
| `variant` | Select | Alert type: default, info, success, warning, destructive |
| `title` | Text | Optional alert title |
| `content` | Textarea (RTE) | Alert message content (required) |
| `show_icon` | Checkbox | Show/hide the variant icon (default: on) |
| `dismissible` | Checkbox | Allow users to close the alert |

## CSS Classes

```css
.shadcn-alert                  /* Base alert container */
.shadcn-alert--default         /* Default variant */
.shadcn-alert--info            /* Info variant (blue) */
.shadcn-alert--success         /* Success variant (green) */
.shadcn-alert--warning         /* Warning variant (yellow) */
.shadcn-alert--destructive     /* Error variant (red) */
.shadcn-alert__icon            /* Icon container */
.shadcn-alert__content         /* Content wrapper */
.shadcn-alert__title           /* Alert title */
.shadcn-alert__description     /* Alert description */
.shadcn-alert__close           /* Close button (if dismissible) */
```

## Variant Styling

Each variant has a distinct color scheme:

| Variant | Border | Background | Icon |
|---------|--------|------------|------|
| Default | Border color | Background | Muted |
| Info | Blue | Light blue | Blue |
| Success | Green | Light green | Green |
| Warning | Yellow | Light yellow | Yellow |
| Destructive | Red | Light red | Red |

## Usage Examples

### Informational Callout

```
Variant: Info
Title: Pro Tip
Content: You can use keyboard shortcuts to navigate faster.
Show Icon: ✓
```

### Error Message

```
Variant: Destructive
Title: Form Error
Content: Please correct the highlighted fields.
Show Icon: ✓
Dismissible: ✓
```

### Promotional Banner

```
Variant: Success
Title: Special Offer
Content: Get 20% off your first order with code WELCOME20.
Show Icon: ✓
```

## Customization

### Custom Icon Colors

```css
.shadcn-alert--info .shadcn-alert__icon {
    color: hsl(217 91% 50%);
}

.shadcn-alert--success .shadcn-alert__icon {
    color: hsl(142 76% 36%);
}
```

### Full-Width Alert

```css
.shadcn-alert--fullwidth {
    border-radius: 0;
    border-left: none;
    border-right: none;
}
```

### Compact Alert

```css
.shadcn-alert--compact {
    padding: 0.5rem 0.75rem;
}

.shadcn-alert--compact .shadcn-alert__title {
    font-size: 0.8125rem;
}
```

### Dismissible Alert JavaScript

```javascript
document.querySelectorAll('.shadcn-alert__close').forEach(button => {
    button.addEventListener('click', () => {
        const alert = button.closest('.shadcn-alert');
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => alert.remove(), 200);
    });
});
```

## Best Practices

1. **Choose the right variant** - Match the severity to the message
2. **Keep titles short** - 2-4 words maximum
3. **Be specific** - Clear, actionable content
4. **Don't overuse** - Too many alerts reduce effectiveness
5. **Position appropriately** - Place near relevant content

## Accessibility

- Uses `role="alert"` for screen reader announcements
- Color is not the only indicator (icons provide visual distinction)
- Sufficient color contrast for all variants
- Close button is keyboard accessible

---

**Previous:** [Accordion](Accordion.md) | **Next:** [Card](Card.md)
