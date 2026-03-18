# Content Elements

This chapter provides detailed documentation for all content elements included in the ShadCN to Fluid Templates extension.

## Overview

The extension provides 9 content elements, all available in the "Common" tab of the content element wizard:

| Content Element | Description | Variants |
|-----------------|-------------|----------|
| [Hero Section](Hero.md) | Landing page hero with headline and CTAs | Centered, Split, Background |
| [Accordion / FAQ](Accordion.md) | Collapsible content sections | Single, Multiple open |
| [Alert / Callout](Alert.md) | Important messages and notifications | Default, Info, Success, Warning, Destructive |
| [Area Chart](Chart.md) | Interactive data visualization chart | Gradient, Solid fill |
| [Card](Card.md) | Versatile card component | Basic, Image, Horizontal |
| [Call to Action](Cta.md) | Prominent CTA sections | Centered, Split, Banner, Inline |
| [Feature Grid](Features.md) | Grid of features with icons | Icon Top, Icon Left, Card |
| [Testimonial](Testimonial.md) | Customer quotes and reviews | Simple, Card, Large |
| [Text with Media](Textmedia.md) | Text and image/video layouts | Media Right/Left/Above/Below |

## Common Features

All content elements share these features:

### Variant System

Most content elements support multiple layout variants, selectable via dropdown in the backend. Variants can:
- Change the visual layout
- Show/hide specific fields
- Alter styling and behavior

### CSS Custom Properties

All components use CSS custom properties for theming:

```css
/* Colors automatically adapt to your theme */
.shadcn-btn--default {
    background-color: hsl(var(--primary));
    color: hsl(var(--primary-foreground));
}
```

### Responsive Design

All content elements are mobile-first and fully responsive:

- **Mobile**: Single column, stacked layouts
- **Tablet**: Two-column layouts where appropriate
- **Desktop**: Full multi-column layouts with optimal spacing

### Accessibility

Every content element includes:

- Semantic HTML structure
- ARIA attributes where needed
- Keyboard navigation support
- Focus indicators
- Color contrast compliance

## Content Element Details

```{toctree}
:maxdepth: 1

Hero
Accordion
Alert
Chart
Card
Cta
Features
Testimonial
Textmedia
```

---

**Next:** [Hero Section](Hero.md)
