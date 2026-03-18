# Hero Section

**Content Block Name:** `shadcn2fluid/hero`

The Hero Section is a versatile, eye-catching component perfect for landing pages, product showcases, and page headers. It supports three distinct layout variants with configurable CTAs.

## Variants

### Centered Variant

A classic centered hero layout with text content and call-to-action buttons.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│                         [Badge]                             │
│                                                             │
│                   Large Headline Text                       │
│                                                             │
│          Subheadline with supporting text that              │
│              explains your value proposition                │
│                                                             │
│           [Primary CTA]    [Secondary CTA]                  │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

**Best for:**
- Landing pages
- Product launches
- App homepages
- Marketing sites

**Configuration:**
- Badge text (optional)
- Headline (required)
- Subheadline
- Primary and secondary CTA buttons

### Split Variant

Two-column layout with text content on one side and an image on the other.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│   [Badge]                      │                            │
│                                │      ┌─────────────┐       │
│   Large Headline               │      │             │       │
│                                │      │   Image     │       │
│   Subheadline text goes        │      │             │       │
│   here with more details...    │      └─────────────┘       │
│                                │                            │
│   [Primary]  [Secondary]       │                            │
│                                │                            │
└─────────────────────────────────────────────────────────────┘
```

**Best for:**
- Feature showcases
- Product introductions
- About sections
- Service pages

**Configuration:**
- All centered variant fields, plus:
- Hero image (with crop variants)
- Image position: Left or Right

### Background Image Variant

Full-width background image with text overlay and configurable opacity.

```
┌─────────────────────────────────────────────────────────────┐
│░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░│
│░░                                                         ░░│
│░░   [Badge]                                               ░░│
│░░                                                         ░░│
│░░   Large Headline                                        ░░│
│░░                                                         ░░│
│░░   Subheadline text                                      ░░│
│░░                                                         ░░│
│░░   [Primary CTA]    [Secondary CTA]                      ░░│
│░░                                                         ░░│
│░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░│
└─────────────────────────────────────────────────────────────┘
              (░ = Background image with overlay)
```

**Best for:**
- Immersive headers
- Photography sites
- Event pages
- Dramatic page entrances

**Configuration:**
- All centered variant fields, plus:
- Background image
- Overlay opacity: None (0%), Light (30%), Medium (50%), Heavy (70%), Dark (85%)
- Text alignment: Left or Center

## Field Reference

| Field | Type | Availability | Description |
|-------|------|--------------|-------------|
| `variant` | Select | All | Layout variant selector |
| `badge_text` | Text | All | Optional badge above headline |
| `headline` | Text | All | Main headline (required) |
| `subheadline` | Textarea | All | Supporting descriptive text |
| `primary_button_text` | Text | All | Primary CTA button label |
| `primary_button_link` | Link | All | Primary CTA destination |
| `primary_button_variant` | Select | All | Button style: default, secondary, outline |
| `secondary_button_text` | Text | All | Secondary CTA button label |
| `secondary_button_link` | Link | All | Secondary CTA destination |
| `secondary_button_variant` | Select | All | Button style: default, secondary, outline, ghost |
| `hero_image` | File | Split, Background | Hero image with crop variants |
| `image_position` | Select | Split only | Image position: left, right |
| `overlay_opacity` | Select | Background only | Overlay darkness level |
| `text_alignment` | Select | Background only | Text alignment: left, center |

## Button Variants

### Primary Button Styles

| Style | CSS Class | Appearance |
|-------|-----------|------------|
| Default | `shadcn-btn--default` | Solid primary color |
| Secondary | `shadcn-btn--secondary` | Muted background |
| Outline | `shadcn-btn--outline` | Border only |

### Secondary Button Styles

| Style | CSS Class | Appearance |
|-------|-----------|------------|
| Default | `shadcn-btn--default` | Solid primary color |
| Secondary | `shadcn-btn--secondary` | Muted background |
| Outline | `shadcn-btn--outline` | Border only |
| Ghost | `shadcn-btn--ghost` | Transparent, text only |

## CSS Classes

The Hero section uses these main CSS classes:

```css
.shadcn-hero                    /* Main container */
.shadcn-hero--centered          /* Centered variant */
.shadcn-hero--split             /* Split variant */
.shadcn-hero--background        /* Background variant */
.shadcn-hero--image-left        /* Image on left (split) */
.shadcn-hero--align-center      /* Center text (background) */
.shadcn-hero__container         /* Content container */
.shadcn-hero__content           /* Text content wrapper */
.shadcn-hero__headline          /* Headline text */
.shadcn-hero__subheadline       /* Subheadline text */
.shadcn-hero__actions           /* Button container */
.shadcn-hero__image-wrapper     /* Image container */
.shadcn-hero__bg                /* Background image container */
.shadcn-hero__overlay           /* Background overlay */
```

## Customization Examples

### Custom Hero Spacing

```css
.shadcn-hero--centered {
    padding-top: 8rem;
    padding-bottom: 8rem;
}

@media (min-width: 1024px) {
    .shadcn-hero--centered {
        padding-top: 12rem;
        padding-bottom: 12rem;
    }
}
```

### Custom Headline Size

```css
.shadcn-hero__headline {
    font-size: 3rem;
}

@media (min-width: 1024px) {
    .shadcn-hero__headline {
        font-size: 5rem;
    }
}
```

### Gradient Background Overlay

```css
.shadcn-hero--background .shadcn-hero__overlay {
    background: linear-gradient(
        135deg,
        hsl(var(--primary) / 0.8) 0%,
        hsl(var(--background) / 0.6) 100%
    );
}
```

## Usage Tips

1. **Keep headlines short and impactful** - Aim for 5-8 words
2. **Use high-quality images** - At least 1920px wide for background variants
3. **Test overlay opacity** - Ensure text remains readable
4. **Mobile preview** - Always check how the hero looks on mobile devices
5. **CTA contrast** - Ensure buttons are visible against the background

---

**Previous:** [Content Elements Overview](Index.md) | **Next:** [Accordion](Accordion.md)
