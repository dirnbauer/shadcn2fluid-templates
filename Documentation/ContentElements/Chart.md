# Area Chart

**Content Block Name:** `shadcn2fluid/chart`

The Area Chart component displays data as a filled area chart with interactive tooltips, grid lines, and gradient fills. It uses Alpine.js for dynamic SVG rendering while keeping all data configuration in the TYPO3 backend.

## Features

- **Gradient or solid fill** - Signature shadcn/ui gradient look
- **Interactive tooltips** - Hover over data points to see values
- **Grid lines** - Optional horizontal and vertical grid lines
- **Axis labels** - Customizable X and Y axis labels
- **Color variants** - Multiple color schemes using CSS custom properties
- **Responsive** - Adapts to container width

## Visual Layout

```
┌─────────────────────────────────────────────────────┐
│  Chart Title                                        │
│  Chart description text                             │
│                                                     │
│  300 ┼────────────────────────────────────────────  │
│      │                    ╭──╮                      │
│  200 ┼───────────────────╯    ╰────╮                │
│      │          ╭────────╯          ╰───            │
│  100 ┼─────────╯                                    │
│      │    ╭────╯                                    │
│    0 ┼────┴─────────────────────────────────────    │
│       Jan   Feb   Mar   Apr   May   Jun             │
│                                                     │
└─────────────────────────────────────────────────────┘
```

## Field Reference

| Field | Type | Description |
|-------|------|-------------|
| `title` | Text | Chart card title |
| `description` | Text | Subtitle or description below the title |
| `chart_data` | Textarea | JSON array of data points (required) |
| `x_axis_label` | Text | Optional label for the horizontal axis |
| `y_axis_label` | Text | Optional label for the vertical axis |
| `color_variant` | Select | Chart color: primary, blue, green, orange, red |
| `show_grid` | Checkbox | Toggle grid lines visibility |
| `fill_type` | Select | Gradient (default) or solid fill |
| `chart_height` | Select | Small (200px), Medium (300px), Large (400px) |

## Data Format

Enter chart data as a JSON array in the textarea field. Each object must have a `label` and `value`:

```json
[
  {"label": "January", "value": 186},
  {"label": "February", "value": 305},
  {"label": "March", "value": 237},
  {"label": "April", "value": 273},
  {"label": "May", "value": 209},
  {"label": "June", "value": 314}
]
```

### Data Format Examples

**Monthly Revenue:**

```json
[
  {"label": "Jan", "value": 4200},
  {"label": "Feb", "value": 3800},
  {"label": "Mar", "value": 5100},
  {"label": "Apr", "value": 4700},
  {"label": "May", "value": 5800},
  {"label": "Jun", "value": 6200}
]
```

**Weekly Statistics:**

```json
[
  {"label": "Mon", "value": 120},
  {"label": "Tue", "value": 145},
  {"label": "Wed", "value": 132},
  {"label": "Thu", "value": 178},
  {"label": "Fri", "value": 165},
  {"label": "Sat", "value": 89},
  {"label": "Sun", "value": 67}
]
```

## CSS Classes

```css
.shadcn-chart                    /* Main container */
.shadcn-chart--primary           /* Primary color variant */
.shadcn-chart--blue              /* Blue color variant */
.shadcn-chart--green             /* Green color variant */
.shadcn-chart--orange            /* Orange color variant */
.shadcn-chart--red               /* Red color variant */
.shadcn-chart__card              /* Card wrapper */
.shadcn-chart__header            /* Title/description area */
.shadcn-chart__wrapper           /* Chart area wrapper */
.shadcn-chart__canvas-wrapper    /* SVG container */
.shadcn-chart__canvas            /* SVG element */
.shadcn-chart__canvas--small     /* 200px height */
.shadcn-chart__canvas--medium    /* 300px height */
.shadcn-chart__canvas--large     /* 400px height */
.shadcn-chart__grid-line         /* Grid line */
.shadcn-chart__axis-label        /* Axis label text */
.shadcn-chart__area              /* Filled area path */
.shadcn-chart__line              /* Line stroke path */
.shadcn-chart__point             /* Data point circle */
.shadcn-chart__tooltip           /* Hover tooltip */
.shadcn-chart__x-label           /* X-axis label */
.shadcn-chart__y-label           /* Y-axis label */
```

## Usage Examples

### Basic Revenue Chart

```
Title: Monthly Revenue
Description: Revenue trends for the first half of 2024
Chart Data: [{"label": "Jan", "value": 4200}, {"label": "Feb", "value": 3800}, ...]
Color Variant: Primary
Fill Type: Gradient
Show Grid: Yes
Chart Height: Medium
```

### Performance Metrics

```
Title: Website Performance
Description: Page load times in milliseconds
X-Axis Label: Day of Week
Y-Axis Label: Load Time (ms)
Chart Data: [{"label": "Mon", "value": 245}, {"label": "Tue", "value": 198}, ...]
Color Variant: Green
Fill Type: Gradient
Show Grid: Yes
Chart Height: Small
```

### Simple Statistics

```
Title: User Signups
Chart Data: [{"label": "Q1", "value": 1200}, {"label": "Q2", "value": 1850}, ...]
Color Variant: Blue
Fill Type: Solid
Show Grid: No
Chart Height: Small
```

## Customization

### Custom Chart Colors

Override the chart color using CSS custom properties:

```css
.my-custom-chart {
    --chart-color: 280 65% 60%; /* Purple */
}
```

### Adjust Grid Opacity

```css
.shadcn-chart__grid-line {
    opacity: 0.3;
}
```

### Thicker Line Stroke

```css
.shadcn-chart__line {
    stroke-width: 3;
}
```

### Larger Data Points

```css
.shadcn-chart__point {
    r: 5;
}

.shadcn-chart__point:hover {
    r: 8;
}
```

### Custom Tooltip Styling

```css
.shadcn-chart__tooltip {
    background-color: hsl(var(--primary));
    color: hsl(var(--primary-foreground));
    border: none;
}

.shadcn-chart__tooltip-label {
    color: hsl(var(--primary-foreground) / 0.8);
}
```

## Requirements

This component requires **Alpine.js** to be loaded on the page. If Alpine.js is not already included in your site, add it to your TypoScript setup:

```typoscript
page.includeJSFooterlibs.alpinejs = https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js
page.includeJSFooterlibs.alpinejs.external = 1
```

Or include it via your build process.

## Accessibility

- SVG uses proper `viewBox` for screen reader compatibility
- Tooltips provide text alternatives for visual data
- Interactive points are keyboard-focusable
- Color is not the only means of conveying information

## Best Practices

1. **Limit data points** - 6-12 points work best visually
2. **Use meaningful labels** - Keep X-axis labels short and clear
3. **Consistent data** - Ensure values are in the same unit
4. **Add context** - Use title and description to explain what the chart shows
5. **Choose appropriate height** - Match chart height to data complexity

## Troubleshooting

### Chart not rendering

1. Check that Alpine.js is loaded on the page
2. Verify the JSON data format is valid
3. Check browser console for errors

### Invalid data format

The chart will display "Error" if the JSON is malformed. Validate your JSON at [jsonlint.com](https://jsonlint.com).

### Tooltip position incorrect

This can happen with complex page layouts. Ensure the chart wrapper has `position: relative`.

---

**Previous:** [Text with Media](Textmedia.md) | **Next:** [Hero Section](Hero.md)
