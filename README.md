<p align="center">
  <img src="https://ui.shadcn.com/og.jpg" alt="ShadCN to Fluid Templates" width="600">
</p>

<h1 align="center">🎨 ShadCN to Fluid Templates</h1>

<p align="center">
  <strong>The most beautiful UI components for TYPO3 — pure Fluid templates, zero frameworks.</strong>
</p>

<p align="center">
  <a href="#-why-this-extension">Why This Extension</a> •
  <a href="#-features">Features</a> •
  <a href="#-quick-start">Quick Start</a> •
  <a href="#-content-elements">Content Elements</a> •
  <a href="#-theming-with-tweakcn">Theming</a> •
  <a href="#-documentation">Documentation</a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/TYPO3-13%20%7C%2014-orange" alt="TYPO3 13 | 14">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-blue" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/License-GPL--2.0--or--later-green" alt="License GPL-2.0-or-later">
  <img src="https://img.shields.io/badge/shadcn%2Fui-inspired-black" alt="shadcn/ui inspired">
</p>

---

## ✨ Why This Extension?

**Stop compromising between beautiful design and TYPO3 simplicity.**

You've seen those stunning React sites built with shadcn/ui. Clean typography. Smooth animations. Perfect dark mode. And you thought: *"I wish I could have this in TYPO3."*

Now you can.

**ShadCN to Fluid Templates** brings the acclaimed [shadcn/ui](https://ui.shadcn.com/) design system to TYPO3 — as pure, server-rendered Fluid templates. No React. No build tools. No JavaScript frameworks.

| ❌ What You Don't Need | ✅ What You Get |
|------------------------|-----------------|
| React/Vue/Alpine | Pure HTML + vanilla JS |
| npm/webpack/vite | Zero build step |
| JavaScript frameworks | Server-side rendering |
| Complex toolchains | Just install and use |
| Framework knowledge | Standard TYPO3 workflow |

### The Result?

Your editors get beautiful, modern content elements. Your developers get clean, extensible code. Your visitors get blazing-fast, accessible pages.

---

## 🚀 Features

### 🎯 9 Production-Ready Content Elements

Every content element you need for a modern website:

- **Hero Sections** — 3 variants: Centered, Split, Background
- **Accordion / FAQ** — Pure CSS with `<details>`/`<summary>`, no JS required
- **Alert / Callout** — 5 styles: Default, Info, Success, Warning, Destructive
- **Cards** — 3 layouts: Basic, Image, Horizontal
- **Call to Action** — 4 variants: Centered, Split, Banner, Inline
- **Area Chart** — SVG charts with gradient fill, grid lines, and tooltips (vanilla JS)
- **Feature Grid** — Showcase features with icons in 2/3/4-column grids
- **Testimonials** — Customer quotes with star ratings and author photos
- **Text with Media** — 4 layouts: Media Right, Left, Above, Below

### 🎨 Full Theming with tweakcn

Use [tweakcn.com](https://tweakcn.com/editor/theme) to visually design your theme, then paste the CSS. Done.

```css
:root {
  --primary: oklch(0.6056 0.2189 292.7172);  /* Your brand color */
  --radius: 0.5rem;                           /* Your corner style */
}
```

### 🌙 Dark Mode Built-In

Just add `class="dark"` to your HTML element. Every component automatically adapts.

### ♿ Accessible by Default

- Semantic HTML
- ARIA attributes
- Keyboard navigation
- High contrast colors
- Screen reader friendly

### 📱 Fully Responsive

Mobile-first design. Every component looks perfect from 320px to 4K.

### 🧩 Content Blocks Powered

Built on [TYPO3 Content Blocks](https://github.com/friendsoftypo3/content-blocks) for the best editor experience.

---

## ⚡ Quick Start

### Installation

```bash
composer require webconsulting/shadcn2fluid-templates
```

### Activation

```bash
# TYPO3 CLI
vendor/bin/typo3 extension:setup
vendor/bin/typo3 cache:flush

# With DDEV
ddev exec vendor/bin/typo3 extension:setup
ddev exec vendor/bin/typo3 cache:flush
```

### Start Creating

1. Open TYPO3 Backend
2. Go to any page
3. Add new content element
4. Find **ShadCN Hero Section** in the "Common" tab
5. Done! Your first beautiful component is live.

---

## 📦 Content Elements

### Hero Section

The star of your landing page. Three layouts to choose from:

**Centered** — Perfect for product launches
```
┌─────────────────────────────────────────┐
│              [Badge]                    │
│         Big Bold Headline               │
│      Supporting text goes here          │
│    [Primary CTA]  [Secondary CTA]       │
└─────────────────────────────────────────┘
```

**Split** — Text + image side by side
**Background** — Full-width background with overlay

### Accordion / FAQ

Collapsible sections using pure HTML/CSS. No JavaScript needed.

### Alert / Callout

Draw attention to important information. Five styles for every situation.

### Card

Versatile containers for any content. Basic, with image, or horizontal layout.

### Call to Action

Convert visitors into customers. Four attention-grabbing layouts.

### Feature Grid

Showcase your benefits. Icons + titles + descriptions in a responsive grid.

### Testimonial

Social proof that builds trust. With star ratings and author photos.

### Area Chart

Interactive SVG area chart with gradient fills, grid lines, and hover tooltips. Data is entered as JSON — no external charting library needed, just vanilla JavaScript.

```json
[
  {"label": "Jan", "value": 186},
  {"label": "Feb", "value": 305},
  {"label": "Mar", "value": 237}
]
```

5 color themes (Primary, Blue, Green, Orange, Red), optional grid lines, gradient or solid fill, and 3 height presets.

### Text with Media

The workhorse of content pages. Flexible text and media combinations.

---

## 🎨 Theming with tweakcn

### Visual Theme Editor

1. Visit [tweakcn.com/editor/theme](https://tweakcn.com/editor/theme)
2. Customize colors, typography, and spacing visually
3. Click **"Code"** and copy the CSS
4. Save to `fileadmin/css/my-theme.css`
5. Configure in TypoScript:

```typoscript
plugin.tx_shadcn2fluid_templates.settings.customThemeCss = fileadmin/css/my-theme.css
```

### CSS Variables

Full control over every aspect:

```css
:root {
  /* Colors */
  --primary: oklch(0.6 0.2 290);
  --background: oklch(1 0 0);
  --foreground: oklch(0.15 0 0);
  
  /* Typography */
  --font-sans: 'Inter', sans-serif;
  
  /* Spacing */
  --radius: 0.5rem;
  
  /* And 30+ more variables... */
}
```

### Dark Mode

```html
<html class="dark">
  <!-- Everything adapts automatically -->
</html>
```

---

## 📚 Documentation

Full documentation is included in the `/Documentation` folder:

- **[Installation Guide](Documentation/Installation/Index.md)** — Get up and running
- **[Configuration](Documentation/Configuration/Index.md)** — TypoScript and settings
- **[Content Elements](Documentation/ContentElements/Index.md)** — All 9 elements explained
- **[Theming Guide](Documentation/Theming/Index.md)** — Complete theming reference
- **[Component Partials](Documentation/Partials/Index.md)** — Reusable Fluid components
- **[Extending](Documentation/Extending/Index.md)** — Create your own elements
- **[Troubleshooting](Documentation/KnownProblems/Index.md)** — Common issues solved

---

## 🧱 Reusable Component Partials

Use the same components in your own templates:

```html
<!-- Button -->
<f:render partial="Components/Button" arguments="{
    link: '/signup',
    text: 'Get Started',
    variant: 'default',
    size: 'lg'
}"/>

<!-- Badge -->
<f:render partial="Components/Badge" arguments="{
    text: 'New Feature',
    variant: 'secondary'
}"/>

<!-- Typography -->
<f:render partial="Components/Typography" arguments="{
    text: 'Welcome',
    tag: 'h1',
    variant: 'h1'
}"/>
```

Available partials:
- **Button** — 6 variants, 4 sizes
- **Badge** — 4 variants
- **Typography** — 9 text styles
- **Card** — Container component
- **Separator** — Horizontal/vertical dividers

---

## 🔧 Requirements

| Requirement | Version |
|-------------|---------|
| TYPO3 | 13.4 LTS or 14.x |
| PHP | 8.2 or higher |
| content_blocks | 1.x (TYPO3 13) or 2.x (TYPO3 14) |

---

## 🙏 Credits

Built with love, inspired by:

- **[shadcn/ui](https://ui.shadcn.com/)** — The original React component library
- **[tweakcn](https://tweakcn.com/)** — Visual theme editor
- **[TYPO3 Content Blocks](https://github.com/friendsoftypo3/content-blocks)** — Modern content elements for TYPO3

---

## 📄 License

GPL-2.0-or-later — Use it freely in your TYPO3 projects.

---

## 🤝 Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch
3. Submit a pull request

For major changes, open an issue first.

---

## 💬 Support

- **Issues:** [GitHub Issues](https://github.com/dirnbauer/shadcn2fluid-templates/issues)

---

<p align="center">
  <strong>Ready to build beautiful TYPO3 sites?</strong><br>
  <code>composer require webconsulting/shadcn2fluid-templates</code>
</p>

<p align="center">
  Made with ❤️ for the TYPO3 community
</p>
