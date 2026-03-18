# Feature Grid

**Content Block Name:** `shadcn2fluid/features`

The Feature Grid displays a collection of features, benefits, or services in a responsive grid layout with icons, titles, and descriptions.

## Variants

### Icon Top

Icons centered above the text content.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│                     Features Headline                       │
│                   Features description                      │
│                                                             │
│   ┌─────────────┐  ┌─────────────┐  ┌─────────────┐        │
│   │     ⭐      │  │     ⚡      │  │     🛡️      │        │
│   │             │  │             │  │             │        │
│   │  Feature 1  │  │  Feature 2  │  │  Feature 3  │        │
│   │             │  │             │  │             │        │
│   │ Description │  │ Description │  │ Description │        │
│   └─────────────┘  └─────────────┘  └─────────────┘        │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Icon Left

Icons aligned to the left of the text content.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  ⭐  Feature Title                                         │
│      Feature description text goes here with details.       │
│                                                             │
│  ⚡  Another Feature                                        │
│      Another description with more information.             │
│                                                             │
│  🛡️  Third Feature                                          │
│      Third feature description here.                        │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Card Style

Features displayed in elevated card containers.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│   ┌─────────────────┐  ┌─────────────────┐                 │
│   │  ⭐             │  │  ⚡             │                 │
│   │                 │  │                 │                 │
│   │  Feature 1      │  │  Feature 2      │                 │
│   │                 │  │                 │                 │
│   │  Description    │  │  Description    │                 │
│   └─────────────────┘  └─────────────────┘                 │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

## Field Reference

### Section Fields

| Field | Type | Description |
|-------|------|-------------|
| `headline` | Text | Section headline |
| `subheadline` | Textarea | Section subheadline |
| `columns` | Select | Grid columns: 2, 3, or 4 |
| `variant` | Select | Feature style: icon-top, icon-left, card |

### Feature Item Fields (Collection)

| Field | Type | Description |
|-------|------|-------------|
| `icon` | Select | Icon selection (see available icons below) |
| `title` | Text | Feature title (required) |
| `description` | Textarea | Feature description |
| `link` | Link | Optional link for the feature |

## Available Icons

| Icon | Value | Use Case |
|------|-------|----------|
| ⭐ Star | `star` | Highlights, favorites |
| ✓ Check | `check` | Completed, included |
| ♥ Heart | `heart` | Favorites, love |
| ⚡ Lightning | `lightning` | Speed, performance |
| 🛡️ Shield | `shield` | Security, protection |
| 🚀 Rocket | `rocket` | Launch, growth |
| 👥 Users | `users` | Community, team |
| ⚙️ Settings | `settings` | Configuration |
| 🌐 Globe | `globe` | Global, international |
| 🔒 Lock | `lock` | Security, privacy |

## CSS Classes

```css
.shadcn-features                    /* Main container */
.shadcn-features__header            /* Section header */
.shadcn-features__headline          /* Section headline */
.shadcn-features__subheadline       /* Section subheadline */
.shadcn-features__grid              /* Features grid */
.shadcn-features__grid--cols-2      /* 2 columns */
.shadcn-features__grid--cols-3      /* 3 columns */
.shadcn-features__grid--cols-4      /* 4 columns */
.shadcn-features__grid--icon-left   /* Icon left layout */
.shadcn-features__grid--card        /* Card style */
.shadcn-feature                     /* Individual feature */
.shadcn-feature__icon               /* Icon container */
.shadcn-feature__content            /* Text content */
.shadcn-feature__title              /* Feature title */
.shadcn-feature__description        /* Feature description */
```

## Usage Examples

### Product Features

```
Headline: Why Choose Us
Subheadline: Everything you need to succeed
Columns: 3
Variant: Icon Top

Features:
1. Icon: Rocket, Title: Fast Performance, Description: Blazing fast load times
2. Icon: Shield, Title: Secure, Description: Enterprise-grade security
3. Icon: Users, Title: Team Collaboration, Description: Work together seamlessly
```

### Service Offerings

```
Headline: Our Services
Columns: 2
Variant: Card

Features:
1. Icon: Settings, Title: Consulting, Description: Expert guidance for your project
2. Icon: Lightning, Title: Development, Description: Custom solutions built for you
```

### Pricing Features

```
Variant: Icon Left
Columns: 2

Features:
1. Icon: Check, Title: Unlimited Users, Description: No per-user pricing
2. Icon: Check, Title: 24/7 Support, Description: We're always here to help
3. Icon: Check, Title: Free Updates, Description: Always get the latest features
```

## Customization

### Custom Icon Colors

```css
.shadcn-feature__icon {
    background-color: hsl(var(--accent) / 0.2);
    color: hsl(var(--accent));
}
```

### Gradient Icon Background

```css
.shadcn-feature__icon {
    background: linear-gradient(135deg, hsl(var(--primary)), hsl(var(--accent)));
    color: hsl(var(--primary-foreground));
}
```

### Hover Effects

```css
.shadcn-feature {
    transition: transform 0.2s ease;
}

.shadcn-feature:hover {
    transform: translateY(-4px);
}

.shadcn-features__grid--card .shadcn-feature:hover {
    box-shadow: 0 10px 30px hsl(var(--foreground) / 0.1);
}
```

### Custom Grid Gap

```css
.shadcn-features__grid {
    gap: 3rem;
}
```

### Alternating Colors

```css
.shadcn-feature:nth-child(odd) .shadcn-feature__icon {
    background-color: hsl(var(--primary) / 0.1);
    color: hsl(var(--primary));
}

.shadcn-feature:nth-child(even) .shadcn-feature__icon {
    background-color: hsl(var(--accent) / 0.1);
    color: hsl(var(--accent));
}
```

## Responsive Behavior

The grid automatically adapts to screen size:

| Screen Size | 2 Columns | 3 Columns | 4 Columns |
|-------------|-----------|-----------|-----------|
| Mobile (<640px) | 1 col | 1 col | 1 col |
| Tablet (640-768px) | 2 col | 2 col | 2 col |
| Desktop (768-1024px) | 2 col | 2 col | 2 col |
| Large (>1024px) | 2 col | 3 col | 4 col |

## Best Practices

1. **Consistent icon style** - Use related icons
2. **Brief descriptions** - 1-2 sentences max
3. **Scannable titles** - Clear, descriptive
4. **Balanced content** - Similar length descriptions
5. **Visual hierarchy** - Icon → Title → Description

## Accessibility

- Semantic heading structure
- Descriptive link text
- Color not sole indicator
- Keyboard navigation for links
- Screen reader friendly icons

---

**Previous:** [Call to Action](Cta.md) | **Next:** [Testimonial](Testimonial.md)
