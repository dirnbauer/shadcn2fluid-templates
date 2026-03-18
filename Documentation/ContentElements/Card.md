# Card

**Content Block Name:** `shadcn2fluid/card`

The Card component is a versatile container for displaying content in a distinct, elevated style. It supports multiple layout variants for different use cases.

## Variants

### Basic Card

Simple card with title, description, and optional badge.

```
┌─────────────────────────────────────┐
│                                     │
│   [Badge]                           │
│                                     │
│   Card Title                        │
│                                     │
│   Card description text goes here   │
│   with additional details.          │
│                                     │
│   [Button]                          │
│                                     │
└─────────────────────────────────────┘
```

### Card with Image

Card with a featured image at the top.

```
┌─────────────────────────────────────┐
│  ┌───────────────────────────────┐  │
│  │                               │  │
│  │         Featured Image        │  │
│  │                               │  │
│  └───────────────────────────────┘  │
│                                     │
│   [Badge]                           │
│                                     │
│   Card Title                        │
│                                     │
│   Card description text goes here.  │
│                                     │
│   [Button]                          │
│                                     │
└─────────────────────────────────────┘
```

### Horizontal Card

Side-by-side layout with image and content.

```
┌─────────────────────────────────────────────────────────────┐
│  ┌─────────────┐                                            │
│  │             │   [Badge]                                  │
│  │             │                                            │
│  │   Image     │   Card Title                               │
│  │             │                                            │
│  │             │   Card description text goes here.         │
│  │             │                                            │
│  └─────────────┘   [Button]                                 │
└─────────────────────────────────────────────────────────────┘
```

## Field Reference

| Field | Type | Description |
|-------|------|-------------|
| `variant` | Select | Card style: basic, image, horizontal |
| `image` | File | Card image (for image and horizontal variants) |
| `title` | Text | Card title (required) |
| `description` | Textarea | Card description text |
| `badge_text` | Text | Optional badge displayed on the card |
| `link` | Link | Makes the entire card clickable |
| `button_text` | Text | Optional button at bottom of card |
| `button_link` | Link | Button destination (shown when button_text is set) |

## CSS Classes

```css
.shadcn-card                    /* Base card container */
.shadcn-card--with-image        /* Card with top image */
.shadcn-card--horizontal        /* Horizontal layout */
.shadcn-card__image-wrapper     /* Image container */
.shadcn-card__image             /* Image element */
.shadcn-card__body              /* Content body (horizontal) */
.shadcn-card__header            /* Header section */
.shadcn-card__title             /* Title text */
.shadcn-card__description       /* Description text */
.shadcn-card__content           /* Main content area */
.shadcn-card__footer            /* Footer with button */
.shadcn-card__link-wrapper      /* Link wrapper (for clickable cards) */
```

## Usage Examples

### Blog Post Card

```
Variant: Image
Image: blog-post-thumbnail.jpg
Title: Getting Started with TYPO3
Description: Learn the basics of TYPO3 CMS in this comprehensive guide.
Badge: Tutorial
Button Text: Read More
Button Link: /blog/getting-started
```

### Team Member Card

```
Variant: Horizontal
Image: team-member.jpg
Title: Jane Doe
Description: Senior Developer with 10 years of experience in web development.
Button Text: View Profile
Button Link: /team/jane-doe
```

### Feature Card

```
Variant: Basic
Title: Fast Performance
Description: Optimized for speed with server-side rendering.
Badge: New
Link: /features/performance
```

## Customization

### Card Hover Effect

```css
.shadcn-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.shadcn-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px hsl(var(--foreground) / 0.1);
}
```

### Image Zoom on Hover

```css
.shadcn-card__image {
    transition: transform 0.3s ease;
}

.shadcn-card:hover .shadcn-card__image {
    transform: scale(1.05);
}
```

### Custom Card Background

```css
.shadcn-card--featured {
    background: linear-gradient(135deg, hsl(var(--primary) / 0.1), transparent);
    border-color: hsl(var(--primary) / 0.3);
}
```

### Aspect Ratio Control

```css
/* 16:9 aspect ratio for images */
.shadcn-card--with-image .shadcn-card__image {
    aspect-ratio: 16 / 9;
    object-fit: cover;
}

/* Square images */
.shadcn-card--square .shadcn-card__image {
    aspect-ratio: 1 / 1;
}
```

### Card Grid Layout

Use CSS Grid to display multiple cards:

```css
.card-grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}
```

## Clickable Cards

When a `link` is provided, the entire card becomes clickable:

- The card is wrapped in an anchor element
- Hover states apply to the whole card
- The button (if present) becomes a visual element only

```html
<a href="/link" class="shadcn-card__link-wrapper">
    <div class="shadcn-card">
        <!-- Card content -->
    </div>
</a>
```

## Best Practices

1. **Consistent image sizes** - Use the same aspect ratio across cards
2. **Concise titles** - Keep titles to one line when possible
3. **Clear CTAs** - Use descriptive button text
4. **Visual hierarchy** - Badge → Title → Description → Button
5. **Responsive testing** - Check horizontal cards on mobile

## Accessibility

- Semantic heading structure
- Alt text for images
- Proper link text (not "Click here")
- Focus indicators for interactive cards
- Color contrast compliance

---

**Previous:** [Alert](Alert.md) | **Next:** [Call to Action](Cta.md)
