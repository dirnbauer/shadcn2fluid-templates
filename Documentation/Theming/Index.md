# Theming

This chapter covers the theming system used by ShadCN to Fluid Templates, including integration with [ui.shadcn.com/create](https://ui.shadcn.com/create) for visual theme customization.

## Overview

The extension uses **CSS Custom Properties** (CSS Variables) for complete theme control. This approach:

- Enables real-time theme switching
- Supports dark mode out of the box
- Is compatible with shadcn/ui's theme creator
- Requires no build tools or preprocessing

## Default Theme

The default theme is defined in `Resources/Public/Css/shadcn-theme.css` and provides a purple-accented professional color scheme using the modern **OKLCH** color space.

### Color System

The theme uses semantic color tokens:

| Token | Purpose |
|-------|---------|
| `--background` | Page background |
| `--foreground` | Primary text color |
| `--card` | Card/surface background |
| `--card-foreground` | Card text color |
| `--primary` | Primary action color |
| `--primary-foreground` | Text on primary |
| `--secondary` | Secondary action color |
| `--secondary-foreground` | Text on secondary |
| `--muted` | Muted/disabled background |
| `--muted-foreground` | Muted text |
| `--accent` | Accent/highlight color |
| `--accent-foreground` | Text on accent |
| `--destructive` | Error/danger color |
| `--destructive-foreground` | Text on destructive |
| `--border` | Border color |
| `--input` | Input border color |
| `--ring` | Focus ring color |

### Additional Tokens

| Token | Purpose |
|-------|---------|
| `--radius` | Border radius base value |
| `--font-sans` | Sans-serif font stack |
| `--font-serif` | Serif font stack |
| `--font-mono` | Monospace font stack |
| `--shadow-*` | Shadow definitions (2xs to 2xl) |

## Using shadcn/ui Theme Creator

[ui.shadcn.com/create](https://ui.shadcn.com/create) is the official theme creator for shadcn/ui. It generates CSS custom properties that are fully compatible with this extension.

### Step-by-Step Guide

#### 1. Open the Theme Creator

Visit [ui.shadcn.com/create](https://ui.shadcn.com/create)

#### 2. Customize Your Theme

Use the visual controls to adjust:

- **Colors**: Primary, secondary, accent, destructive
- **Typography**: Font families, sizes
- **Border Radius**: Corner rounding
- **Shadows**: Shadow definitions
- **Dark Mode**: Automatic dark variant

#### 3. Export CSS

1. Click the **"Code"** button
2. Select **"CSS Variables"** format
3. Copy the generated CSS

#### 4. Save to Your Project

Create a new file in your TYPO3 project:

```
fileadmin/css/custom-shadcn-theme.css
```

Paste the copied CSS:

```css
:root {
  --background: oklch(1.0000 0 0);
  --foreground: oklch(0.1450 0.0000 0);
  --card: oklch(1.0000 0 0);
  --card-foreground: oklch(0.1450 0.0000 0);
  --primary: oklch(0.6056 0.2189 292.7172);
  --primary-foreground: oklch(1.0000 0 0);
  /* ... more variables ... */
}

.dark {
  --background: oklch(0.1450 0.0000 0);
  --foreground: oklch(0.9850 0.0000 0);
  /* ... dark mode variables ... */
}
```

#### 5. Configure the TYPO3 Site

Store the exported CSS path and optional reference URL in your site `config.yaml`:

```yaml
settings:
  'shadcn2fluid.themeCss': 'fileadmin/css/custom-shadcn-theme.css'
  'shadcn2fluid.themeSourceUrl': 'https://ui.shadcn.com/create#yourPresetId'
```

#### 6. Clear Cache

```bash
vendor/bin/typo3 cache:flush
```

### Example: Brand Colors

Transform your brand colors to a shadcn theme:

**Brand Colors:**
- Primary: #3B82F6 (Blue)
- Accent: #10B981 (Green)
- Destructive: #EF4444 (Red)

**In the theme creator:**
1. Set Primary color to your brand blue
2. Set Accent to your brand green
3. Adjust other colors to complement

**Result CSS:**
```css
:root {
  --primary: oklch(0.6230 0.2270 264.0520);
  --accent: oklch(0.6560 0.1780 163.4680);
  --destructive: oklch(0.5770 0.2450 27.3250);
  /* ... */
}
```

### Sharing Presets

The theme creator supports shareable preset URLs. Save your preset ID in the site configuration for traceability:

```yaml
settings:
  'shadcn2fluid.themeSourceUrl': 'https://ui.shadcn.com/create#b2D0wqNxT'
```

This does not affect rendering — it is stored for reference so your team knows which preset was used.

## Manual Theme Customization

### Creating a Custom Theme

Without the theme creator, create a manual theme file:

```css
/* fileadmin/css/my-brand-theme.css */

:root {
  /* Core colors using OKLCH (recommended) */
  --background: oklch(1.0000 0 0);
  --foreground: oklch(0.1450 0.0000 0);

  /* Primary brand color */
  --primary: oklch(0.6056 0.2189 292.7172);
  --primary-foreground: oklch(1.0000 0 0);

  /* ... all other tokens ... */

  --radius: 0.5rem;
}

.dark {
  --background: oklch(0.1450 0.0000 0);
  --foreground: oklch(0.9850 0.0000 0);
  /* ... dark mode overrides ... */
}
```

### HSL vs OKLCH Color Spaces

The extension supports both color spaces:

**HSL (Legacy):**
```css
--primary: 221.2 83.2% 53.3%;
```

**OKLCH (Modern - Recommended):**
```css
--primary: oklch(0.6056 0.2189 292.7172);
```

OKLCH provides:
- More perceptually uniform colors
- Better color interpolation
- Wider color gamut support

## Dark Mode

Dark mode is handled by the `.dark` CSS class on the `<html>` element. The `s2f.js` script included with this extension provides:

- A `data-s2f-theme-toggle` attribute for toggle buttons
- `localStorage` persistence of the user's preference

The [Desiderio](https://github.com/dirnbauer/desiderio) theme extension includes a sun/moon toggle in the header. If you build your own theme, add a button with `data-s2f-theme-toggle="true"` and the JS handles the rest.

## Styling and Page Templates

Visual styling of page layouts — headers, footers, content frames, sidebar layouts — is the responsibility of the theme extension, not this component library.

Use [Desiderio](https://github.com/dirnbauer/desiderio) for a ready-made theme with 5 swappable design styles, or build your own theme extension that depends on `webconsulting/shadcn2fluid-templates`.

## CSS Variable Reference

### Full Variable List

```css
:root {
  /* Core */
  --background: ...;
  --foreground: ...;

  /* Surfaces */
  --card: ...;
  --card-foreground: ...;
  --popover: ...;
  --popover-foreground: ...;

  /* Actions */
  --primary: ...;
  --primary-foreground: ...;
  --secondary: ...;
  --secondary-foreground: ...;
  --accent: ...;
  --accent-foreground: ...;
  --destructive: ...;
  --destructive-foreground: ...;

  /* States */
  --muted: ...;
  --muted-foreground: ...;

  /* Borders & Inputs */
  --border: ...;
  --input: ...;
  --ring: ...;

  /* Charts */
  --chart-1 through --chart-5: ...;

  /* Sidebar */
  --sidebar: ...;
  --sidebar-foreground: ...;
  --sidebar-primary: ...;
  --sidebar-primary-foreground: ...;
  --sidebar-accent: ...;
  --sidebar-accent-foreground: ...;
  --sidebar-border: ...;
  --sidebar-ring: ...;

  /* Typography */
  --font-sans: ...;
  --font-serif: ...;
  --font-mono: ...;

  /* Radius */
  --radius: 0.5rem;

  /* Shadows */
  --shadow-2xs through --shadow-2xl: ...;
}
```

## Troubleshooting

### Theme Not Applying

1. Verify CSS file path is correct
2. Check browser DevTools for 404 errors
3. Clear TYPO3 cache
4. Verify site set setting is set

### Dark Mode Not Working

1. Ensure `dark` class is on `<html>`
2. Check CSS specificity isn't overriding
3. Verify dark mode variables are defined in your theme CSS

### Colors Look Wrong

1. Check color space compatibility (HSL vs OKLCH)
2. Ensure browser supports OKLCH
3. Provide HSL fallbacks for older browsers

---

**Previous:** [Content Elements](../ContentElements/Index.md) | **Next:** [Extending](../Extending/Index.md)
