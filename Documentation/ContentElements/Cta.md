# Call to Action

**Content Block Name:** `shadcn2fluid/cta`

The Call to Action (CTA) component creates prominent sections designed to drive user action. Perfect for newsletter signups, contact prompts, or any conversion-focused content.

## Variants

### Centered

Classic centered CTA with headline, description, and buttons.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│                         [Badge]                             │
│                                                             │
│                Ready to Get Started?                        │
│                                                             │
│     Join thousands of happy customers using our product.    │
│                                                             │
│           [Primary CTA]    [Secondary CTA]                  │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Split

Two-column layout with text and image.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│   [Badge]                      │                            │
│                                │     ┌───────────────┐      │
│   Ready to Get Started?        │     │               │      │
│                                │     │    Image      │      │
│   Join thousands of happy      │     │               │      │
│   customers using our product. │     └───────────────┘      │
│                                │                            │
│   [Primary]  [Secondary]       │                            │
│                                │                            │
└─────────────────────────────────────────────────────────────┘
```

### Banner

Compact horizontal banner, ideal for page-wide promotion.

```
┌─────────────────────────────────────────────────────────────┐
│     🎉 Limited Time Offer - Get 20% Off!    [Shop Now]      │
└─────────────────────────────────────────────────────────────┘
```

### Inline

Compact inline layout for embedding within content.

```
┌─────────────────────────────────────────────────────────────┐
│   Ready to transform your business?        [Get Started]   │
└─────────────────────────────────────────────────────────────┘
```

## Field Reference

| Field | Type | Description |
|-------|------|-------------|
| `variant` | Select | Style: centered, split, banner, inline |
| `badge_text` | Text | Optional badge above headline |
| `headline` | Text | Main headline (required) |
| `description` | Textarea | Supporting description text |
| `primary_button_text` | Text | Primary CTA button label |
| `primary_button_link` | Link | Primary CTA destination |
| `secondary_button_text` | Text | Secondary CTA button label |
| `secondary_button_link` | Link | Secondary CTA destination |
| `image` | File | Image for split variant only |
| `background_color` | Select | Background style: default, muted, primary, gradient |

## Background Styles

| Style | Description |
|-------|-------------|
| **Default** | Standard page background |
| **Muted** | Subtle muted background color |
| **Primary** | Bold primary color background with inverted text |
| **Gradient** | Gradient from primary color |

## CSS Classes

```css
.shadcn-cta                     /* Base CTA container */
.shadcn-cta--centered           /* Centered variant */
.shadcn-cta--split              /* Split variant */
.shadcn-cta--banner             /* Banner variant */
.shadcn-cta--inline             /* Inline variant */
.shadcn-cta--bg-muted           /* Muted background */
.shadcn-cta--bg-primary         /* Primary background */
.shadcn-cta--bg-gradient        /* Gradient background */
.shadcn-cta__container          /* Content container */
.shadcn-cta__grid               /* Grid for split layout */
.shadcn-cta__content            /* Text content wrapper */
.shadcn-cta__headline           /* Headline text */
.shadcn-cta__description        /* Description text */
.shadcn-cta__actions            /* Button container */
.shadcn-cta__image-wrapper      /* Image container (split) */
```

## Usage Examples

### Newsletter Signup

```
Variant: Centered
Background: Muted
Headline: Stay Updated
Description: Subscribe to our newsletter for the latest updates and tips.
Primary Button: Subscribe Now → /newsletter
Secondary Button: Learn More → /about-newsletter
```

### Contact Prompt

```
Variant: Split
Headline: Let's Work Together
Description: Ready to start your next project? Get in touch with our team.
Primary Button: Contact Us → /contact
Image: team-collaboration.jpg
```

### Sale Banner

```
Variant: Banner
Background: Primary
Badge: Limited Time
Headline: Summer Sale - Up to 50% Off!
Primary Button: Shop Now → /sale
```

### In-Content CTA

```
Variant: Inline
Background: Muted
Headline: Want to learn more?
Primary Button: Read the Guide → /guide
```

## Customization

### Custom Gradient Background

```css
.shadcn-cta--custom-gradient {
    background: linear-gradient(
        135deg,
        hsl(var(--primary)) 0%,
        hsl(var(--accent)) 50%,
        hsl(var(--secondary)) 100%
    );
}
```

### Animated Banner

```css
.shadcn-cta--banner {
    animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
```

### Full-Width Section

```css
.shadcn-cta--fullwidth {
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    padding-left: 1rem;
    padding-right: 1rem;
}
```

### Rounded Container

```css
.shadcn-cta--rounded .shadcn-cta__container {
    border-radius: var(--radius);
    overflow: hidden;
}
```

## Best Practices

1. **One primary action** - Focus on a single main CTA
2. **Action-oriented text** - Use verbs: "Get Started", "Try Free"
3. **Create urgency** - "Limited time", "Join now"
4. **Contrast matters** - Ensure buttons stand out
5. **Position strategically** - After value proposition, before footer

## A/B Testing Ideas

- Test different headlines
- Compare button colors
- Try different badge texts
- Test with/without images
- Compare background styles

## Accessibility

- High contrast button colors
- Clear, descriptive link text
- Keyboard navigable buttons
- Focus indicators
- Screen reader friendly structure

---

**Previous:** [Card](Card.md) | **Next:** [Feature Grid](Features.md)
