# Content Elements

This chapter provides detailed documentation for the content elements currently covered by this guide.

## Overview

The documented content elements are available in the TYPO3 content element wizard and follow the same Content Blocks conventions used across the extension:

Additional blocks may exist in active development in the repository; this chapter tracks the ones that currently have dedicated documentation pages.

| Content Element | Description | Variants |
|-----------------|-------------|----------|
| [Hero Section](Hero.md) | Landing page hero with headline and CTAs | Centered, Split, Background |
| [Accordion / FAQ](Accordion.md) | Collapsible content sections | Single, Multiple open |
| [Alert / Callout](Alert.md) | Important messages and notifications | Default, Info, Success, Warning, Destructive |
| [Area Chart](Chart.md) | Interactive data visualization chart | Gradient, Solid fill |
| [Card](Card.md) | Versatile card component | Basic, Image, Horizontal |
| [Contact](Contact.md) | Contact section with info panel and form layout | Full Width, Two Columns, Stacked |
| [Call to Action](Cta.md) | Prominent CTA sections | Centered, Split, Banner, Inline |
| [Feature Grid](Features.md) | Grid of features with icons | Icon Top, Icon Left, Card |
| [Logo Cloud](LogoCloud.md) | Brand and customer logo showcase | 3, 4, 5, 6 columns |
| [Pricing](Pricing.md) | Pricing table with featured plan support | 2, 3, 4 columns |
| [Stats](Stats.md) | KPI and metrics cards | 2, 3, 4 columns |
| [Team](Team.md) | Team member grid with portraits and profile links | 2, 3, 4 columns |
| [Testimonial](Testimonial.md) | Customer quotes and reviews | Simple, Card, Large |
| [Text with Media](Textmedia.md) | Text and image/video layouts | Media Right/Left/Above/Below |
| [Timeline](Timeline.md) | Process and roadmap timeline | Full Width, Two Columns, Stacked |

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
Contact
Cta
Features
LogoCloud
Pricing
Stats
Team
Testimonial
Textmedia
Timeline
```

---

**Next:** [Hero Section](Hero.md)
*** Add File: /Users/dirnbauer/projects/shadcn2fluid-templates/Documentation/ContentElements/Contact.md
# Contact

**Content Block Name:** `shadcn2fluid/contact`

Contact combines editorial intro content, a structured contact-information panel, and a simple lead-form layout.

## Layouts

- `full-width`
- `two-columns`
- `stacked`

## Main fields

| Field | Type | Purpose |
|-------|------|---------|
| `eyebrow` | Text | Small section kicker |
| `headline` | Text | Main heading |
| `subheadline` | Textarea | Supporting copy |
| `info_title` | Text | Contact panel title |
| `info_text` | Textarea | Contact panel intro |
| `contact_items` | Collection | Label/value/link rows |
| `form_title` | Text | Form title |
| `form_description` | Textarea | Form helper text |
| `form_action` | Link | Optional target URL |
| `form_method` | Select | `post` or `get` |
| `submit_text` | Text | Submit button label |
| `privacy_text` | Textarea | Privacy notice |

## Notes

- the block renders a presentational form layout only
- form processing must be handled by the target URL or a dedicated form extension
- use workspace-safe file handling rules for any linked downloadable assets
*** Add File: /Users/dirnbauer/projects/shadcn2fluid-templates/Documentation/ContentElements/LogoCloud.md
# Logo Cloud

**Content Block Name:** `shadcn2fluid/logo-cloud`

Logo Cloud renders partner, customer, or press logos in a responsive proof grid.

## Layouts

- `full-width`
- `two-columns`
- `stacked`

## Main fields

| Field | Type | Purpose |
|-------|------|---------|
| `eyebrow` | Text | Small section kicker |
| `headline` | Text | Main heading |
| `subheadline` | Textarea | Supporting copy |
| `columns` | Select | 3, 4, 5, or 6 columns |
| `logos` | Collection | Image, name, and optional link |

## Notes

- use consistent logo proportions for the cleanest result
- upload new files instead of overwriting existing logos when working in a workspace
*** Add File: /Users/dirnbauer/projects/shadcn2fluid-templates/Documentation/ContentElements/Pricing.md
# Pricing

**Content Block Name:** `shadcn2fluid/pricing`

Pricing provides responsive plan cards with optional featured-state highlighting.

## Layouts

- `full-width`
- `two-columns`
- `stacked`

## Main fields

| Field | Type | Purpose |
|-------|------|---------|
| `eyebrow` | Text | Small section kicker |
| `headline` | Text | Main heading |
| `subheadline` | Textarea | Supporting copy |
| `columns` | Select | 2, 3, or 4 plan columns |
| `plans` | Collection | Badge, name, price, features, CTA |

## Notes

- plan features are entered one per line
- featured plans add stronger visual emphasis in the frontend output
*** Add File: /Users/dirnbauer/projects/shadcn2fluid-templates/Documentation/ContentElements/Stats.md
# Stats

**Content Block Name:** `shadcn2fluid/stats`

Stats renders KPI-style number cards for landing pages, reports, and summary sections.

## Layouts

- `full-width`
- `two-columns`
- `stacked`

## Main fields

| Field | Type | Purpose |
|-------|------|---------|
| `eyebrow` | Text | Small section kicker |
| `headline` | Text | Main heading |
| `subheadline` | Textarea | Supporting copy |
| `columns` | Select | 2, 3, or 4 stat columns |
| `stats` | Collection | Value, label, description |
*** Add File: /Users/dirnbauer/projects/shadcn2fluid-templates/Documentation/ContentElements/Team.md
# Team

**Content Block Name:** `shadcn2fluid/team`

Team renders member cards with portrait, role, bio, and optional profile links.

## Layouts

- `full-width`
- `two-columns`
- `stacked`

## Main fields

| Field | Type | Purpose |
|-------|------|---------|
| `eyebrow` | Text | Small section kicker |
| `headline` | Text | Main heading |
| `subheadline` | Textarea | Supporting copy |
| `columns` | Select | 2, 3, or 4 member columns |
| `members` | Collection | Image, name, role, bio, profile link |

## Notes

- use consistent portrait crops for the cleanest grid
- profile links can point to internal pages or external biographies
*** Add File: /Users/dirnbauer/projects/shadcn2fluid-templates/Documentation/ContentElements/Timeline.md
# Timeline

**Content Block Name:** `shadcn2fluid/timeline`

Timeline renders a vertical sequence for process steps, milestones, or roadmap entries.

## Layouts

- `full-width`
- `two-columns`
- `stacked`

## Main fields

| Field | Type | Purpose |
|-------|------|---------|
| `eyebrow` | Text | Small section kicker |
| `headline` | Text | Main heading |
| `subheadline` | Textarea | Supporting copy |
| `items` | Collection | Step/date, title, rich text, optional link |

## Notes

- timeline item content supports rich text
- use concise `step` values such as dates, sprint names, or phase labels
