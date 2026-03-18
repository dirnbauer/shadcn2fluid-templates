# Text with Media

**Content Block Name:** `shadcn2fluid/textmedia`

The Text with Media component combines text content with images or videos in various layouts, styled with modern shadcn aesthetics.

## Layouts

### Media Right

Text on the left, media on the right.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│   SUBHEADLINE                      ┌───────────────────┐    │
│                                    │                   │    │
│   Main Headline                    │                   │    │
│                                    │      Image        │    │
│   Body text content goes here      │       or          │    │
│   with supporting information...   │      Video        │    │
│                                    │                   │    │
│   [Button]                         └───────────────────┘    │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Media Left

Media on the left, text on the right.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│   ┌───────────────────┐    SUBHEADLINE                      │
│   │                   │                                     │
│   │                   │    Main Headline                    │
│   │      Image        │                                     │
│   │       or          │    Body text content goes here      │
│   │      Video        │    with supporting information...   │
│   │                   │                                     │
│   └───────────────────┘    [Button]                         │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Media Above

Media stacked above text content.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│   ┌───────────────────────────────────────────────────┐     │
│   │                                                   │     │
│   │              Image or Video                       │     │
│   │                                                   │     │
│   └───────────────────────────────────────────────────┘     │
│                                                             │
│                      SUBHEADLINE                            │
│                      Main Headline                          │
│                                                             │
│             Body text content centered here.                │
│                                                             │
│                        [Button]                             │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### Media Below

Text content stacked above media.

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│                      SUBHEADLINE                            │
│                      Main Headline                          │
│                                                             │
│             Body text content centered here.                │
│                                                             │
│                        [Button]                             │
│                                                             │
│   ┌───────────────────────────────────────────────────┐     │
│   │                                                   │     │
│   │              Image or Video                       │     │
│   │                                                   │     │
│   └───────────────────────────────────────────────────┘     │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

## Field Reference

| Field | Type | Description |
|-------|------|-------------|
| `layout` | Select | Layout: media-right, media-left, media-above, media-below |
| `headline` | Text | Main headline |
| `subheadline` | Textarea | Subheadline or overline text |
| `content` | Textarea (RTE) | Rich text body content |
| `media` | File | Image or video file |
| `media_rounded` | Checkbox | Apply rounded corners to media (default: on) |
| `media_shadow` | Checkbox | Apply shadow to media |
| `button_text` | Text | Optional button label |
| `button_link` | Link | Button destination |
| `button_variant` | Select | Button style: default, outline, ghost |

## CSS Classes

```css
.shadcn-textmedia                    /* Main container */
.shadcn-textmedia--media-right       /* Media right layout */
.shadcn-textmedia--media-left        /* Media left layout */
.shadcn-textmedia--media-above       /* Media above layout */
.shadcn-textmedia--media-below       /* Media below layout */
.shadcn-textmedia__container         /* Content container */
.shadcn-textmedia__grid              /* Grid layout */
.shadcn-textmedia__content           /* Text content wrapper */
.shadcn-textmedia__subheadline       /* Subheadline text */
.shadcn-textmedia__headline          /* Headline text */
.shadcn-textmedia__text              /* Body text */
.shadcn-textmedia__actions           /* Button container */
.shadcn-textmedia__media-wrapper     /* Media container */
.shadcn-textmedia__media             /* Media element */
.shadcn-textmedia__media--rounded    /* Rounded corners */
.shadcn-textmedia__media--shadow     /* Shadow effect */
```

## Usage Examples

### Product Feature

```
Layout: Media Right
Subheadline: Powerful Analytics
Headline: Understand Your Data
Content: Our analytics dashboard provides real-time insights into...
Media: analytics-dashboard.png
Media Rounded: ✓
Media Shadow: ✓
Button Text: Learn More
Button Link: /features/analytics
```

### About Section

```
Layout: Media Left
Headline: Our Story
Content: Founded in 2020, we set out to revolutionize...
Media: team-photo.jpg
Media Rounded: ✓
```

### Video Tutorial

```
Layout: Media Above
Headline: Getting Started
Subheadline: Quick Tutorial
Content: Watch our 5-minute tutorial to get up and running...
Media: tutorial-video.mp4
```

## Rich Text Content

The content field supports full rich text editing:

- **Bold** and *italic* text
- Bullet and numbered lists
- Links
- Headings (use sparingly)
- Tables

```html
<!-- Example rendered content -->
<div class="shadcn-textmedia__text shadcn-prose">
    <p>Our product offers three key benefits:</p>
    <ul>
        <li><strong>Speed</strong> - Load times under 1 second</li>
        <li><strong>Security</strong> - Enterprise-grade protection</li>
        <li><strong>Simplicity</strong> - Intuitive interface</li>
    </ul>
</div>
```

## Customization

### Custom Media Aspect Ratio

```css
.shadcn-textmedia__media {
    aspect-ratio: 16 / 9;
    object-fit: cover;
}
```

### Enhanced Shadow

```css
.shadcn-textmedia__media--shadow {
    box-shadow: 
        0 25px 50px -12px hsl(var(--foreground) / 0.15),
        0 10px 20px -5px hsl(var(--foreground) / 0.1);
}
```

### Parallax Effect

```css
.shadcn-textmedia__media-wrapper {
    overflow: hidden;
}

.shadcn-textmedia__media {
    transition: transform 0.3s ease;
}

.shadcn-textmedia:hover .shadcn-textmedia__media {
    transform: scale(1.03);
}
```

### Gradient Overlay on Media

```css
.shadcn-textmedia__media-wrapper::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        hsl(var(--primary) / 0.1),
        transparent
    );
    pointer-events: none;
}
```

### Alternating Layout

For multiple textmedia blocks alternating layouts:

```css
.textmedia-alternating .shadcn-textmedia:nth-child(even) {
    /* Override to media-left */
}

.textmedia-alternating .shadcn-textmedia:nth-child(even) .shadcn-textmedia__media-wrapper {
    order: -1;
}
```

## Video Support

When using video files, the component renders a video element:

```html
<video class="shadcn-textmedia__media" controls>
    <source src="video.mp4" type="video/mp4">
</video>
```

### Autoplay Background Video

For decorative background videos:

```css
.shadcn-textmedia__media[autoplay] {
    object-fit: cover;
}
```

## Responsive Behavior

| Screen Size | Side-by-Side Layouts | Stacked Layouts |
|-------------|---------------------|-----------------|
| Mobile | Single column, media above text | Single column |
| Tablet | Single column, media above text | Single column |
| Desktop | Two columns side by side | Single column |

## Best Practices

1. **Optimize images** - Use appropriate sizes and formats
2. **Alt text** - Always provide descriptive alt text
3. **Balance content** - Match text length to image size
4. **Consistent layouts** - Use alternating patterns
5. **Mobile preview** - Check text readability on small screens

## Accessibility

- Alt text for images
- Captions/transcripts for videos
- Semantic heading structure
- High contrast text
- Keyboard accessible buttons

---

**Previous:** [Testimonial](Testimonial.md) | **Next:** [Theming](../Theming/Index.md)
