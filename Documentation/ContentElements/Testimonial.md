# Testimonial

**Content Block Name:** `shadcn2fluid/testimonial`

The Testimonial component displays customer quotes, reviews, and endorsements with author attribution, photos, and optional star ratings.

## Variants

### Simple Quote

Minimal design with quote and author.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  ★★★★★                                                      │
│                                                             │
│  "This product has transformed how we work. The team       │
│   is more productive than ever."                           │
│                                                             │
│  ┌───┐                                                      │
│  │ 👤│  Jane Doe                                            │
│  └───┘  CEO, Example Company                                │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Card Style

Testimonial in an elevated card container.

```
┌─────────────────────────────────────────────────────────────┐
│  ╔═══════════════════════════════════════════════════════╗  │
│  ║                                                       ║  │
│  ║  ★★★★★                                                ║  │
│  ║                                                       ║  │
│  ║  "Amazing experience from start to finish. Highly    ║  │
│  ║   recommend to anyone looking for quality."          ║  │
│  ║                                                       ║  │
│  ║  ┌───┐  John Smith                                   ║  │
│  ║  │ 👤│  Marketing Director, Corp Inc.                ║  │
│  ║  └───┘                                               ║  │
│  ║                                                       ║  │
│  ╚═══════════════════════════════════════════════════════╝  │
└─────────────────────────────────────────────────────────────┘
```

### Large Quote

Prominent, centered testimonial for hero sections.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│                         ★★★★★                               │
│                                                             │
│               "The best decision we ever made               │
│                for our business growth."                    │
│                                                             │
│                        ┌───┐                                │
│                        │ 👤│                                │
│                        └───┘                                │
│                      Jane Doe                               │
│                  CEO, Example Company                       │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

## Field Reference

| Field | Type | Description |
|-------|------|-------------|
| `variant` | Select | Style: simple, card, large |
| `quote` | Textarea | Quote text (required) |
| `author_name` | Text | Author name (required) |
| `author_title` | Text | Author's job title/role |
| `author_company` | Text | Author's company name |
| `author_image` | File | Author's photo/avatar |
| `rating` | Select | Star rating: 0-5 (0 = no rating shown) |

## Star Ratings

| Value | Display |
|-------|---------|
| 0 | No stars shown |
| 1 | ★☆☆☆☆ |
| 2 | ★★☆☆☆ |
| 3 | ★★★☆☆ |
| 4 | ★★★★☆ |
| 5 | ★★★★★ |

## CSS Classes

```css
.shadcn-testimonial               /* Base testimonial */
.shadcn-testimonial--simple       /* Simple variant */
.shadcn-testimonial--card         /* Card variant */
.shadcn-testimonial--large        /* Large variant */
.shadcn-testimonial__rating       /* Star rating container */
.shadcn-testimonial__star         /* Individual star */
.shadcn-testimonial__star--filled /* Filled star */
.shadcn-testimonial__quote        /* Quote text */
.shadcn-testimonial__quote-mark   /* Decorative quote mark */
.shadcn-testimonial__author       /* Author container */
.shadcn-avatar                    /* Avatar container */
.shadcn-avatar__image             /* Avatar image */
.shadcn-testimonial__author-info  /* Author text info */
.shadcn-testimonial__author-name  /* Author name */
.shadcn-testimonial__author-role  /* Title & company */
```

## Usage Examples

### Customer Review

```
Variant: Card
Quote: "The support team went above and beyond to help us get started."
Author Name: Sarah Johnson
Author Title: Operations Manager
Author Company: Tech Solutions LLC
Author Image: sarah-johnson.jpg
Rating: 5
```

### Executive Endorsement

```
Variant: Large
Quote: "A game-changing solution that every enterprise should consider."
Author Name: Michael Chen
Author Title: CTO
Author Company: Fortune 500 Company
Rating: 5
```

### Simple Quote

```
Variant: Simple
Quote: "Fast, reliable, and easy to use."
Author Name: Alex Brown
Author Title: Freelance Developer
Rating: 4
```

## Customization

### Custom Star Color

```css
.shadcn-testimonial__star--filled {
    color: hsl(45 100% 50%); /* Gold */
}
```

### Quote Mark Styling

```css
.shadcn-testimonial__quote-mark {
    font-size: 6rem;
    color: hsl(var(--primary) / 0.15);
    font-family: Georgia, serif;
}
```

### Card Shadow Enhancement

```css
.shadcn-testimonial--card {
    box-shadow: 0 10px 40px hsl(var(--foreground) / 0.08);
}
```

### Avatar Ring

```css
.shadcn-avatar {
    border: 3px solid hsl(var(--primary));
}
```

### Gradient Background

```css
.shadcn-testimonial--large {
    background: linear-gradient(
        180deg,
        hsl(var(--muted)) 0%,
        transparent 100%
    );
    padding: 4rem 2rem;
    border-radius: var(--radius);
}
```

## Testimonial Slider

For displaying multiple testimonials in a slider, combine with JavaScript:

```html
<div class="testimonial-slider">
    <!-- Testimonial 1 -->
    <div class="shadcn-testimonial--card">...</div>
    <!-- Testimonial 2 -->
    <div class="shadcn-testimonial--card">...</div>
    <!-- Testimonial 3 -->
    <div class="shadcn-testimonial--card">...</div>
</div>
```

```css
.testimonial-slider {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 1.5rem;
    padding: 1rem;
}

.testimonial-slider > * {
    flex-shrink: 0;
    width: 350px;
    scroll-snap-align: center;
}
```

## Best Practices

1. **Authentic quotes** - Use real customer feedback
2. **Include context** - Add title and company for credibility
3. **Use photos** - Real faces increase trust
4. **Keep concise** - 2-3 sentences maximum
5. **Highlight results** - Specific outcomes are powerful

## Accessibility

- Proper quote semantics with `<blockquote>`
- Alt text for author images
- Star ratings include text alternatives
- Color contrast for rating stars
- Screen reader friendly structure

---

**Previous:** [Feature Grid](Features.md) | **Next:** [Text with Media](Textmedia.md)
