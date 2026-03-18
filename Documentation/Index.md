# ShadCN to Fluid Templates

> **Extension Key:** shadcn2fluid_templates
>
> **Version:** 1.0.0
>
> **Language:** en
>
> **Author:** webconsulting studio
>
> **License:** GPL-2.0-or-later

## What Does This Extension Do?

**ShadCN to Fluid Templates** brings the acclaimed [shadcn/ui](https://ui.shadcn.com/) design system to TYPO3 CMS — without requiring React, JavaScript frameworks, or complex build tooling. All components render as pure, semantic HTML with modern CSS.

### Key Benefits

| Feature | Description |
|---------|-------------|
| **Zero JavaScript** | All components are server-side rendered Fluid templates |
| **Modern Design** | Beautiful, accessible UI patterns from shadcn/ui |
| **Full Theming** | CSS Custom Properties with [tweakcn](https://tweakcn.com) compatibility |
| **Content Blocks** | Built on TYPO3's modern Content Blocks API |
| **Dark Mode** | Complete dark mode support out of the box |
| **Responsive** | Mobile-first, fully responsive components |
| **Accessible** | ARIA attributes and semantic HTML throughout |

---

## TL;DR — Quick Reference

### How Do I Add Content Elements to My Page?

1. Go to **Page Module** in TYPO3 backend
2. Click **"+ Content"** or **"Create new content element"**
3. Look in the **"Common"** tab — all ShadCN elements are there:
   - ShadCN Hero Section
   - ShadCN Accordion / FAQ
   - ShadCN Alert / Callout
   - ShadCN Area Chart
   - ShadCN Card
   - ShadCN Call to Action
   - ShadCN Feature Grid
   - ShadCN Testimonial
   - ShadCN Text with Media

### How Do I Create NEW Content Elements?

**Option 1: Ask Cursor AI with a prompt:**

```
Create a new ShadCN content element for [COMPONENT NAME] in the shadcn2fluid_templates extension.

It should have:
- [describe the fields you want]
- [describe the variants/layouts]
- [any specific features]

Follow the same style as the existing content elements.
```

**Example prompts:**

```
Create a new ShadCN content element for a Pricing Table with 
3 plan columns and featured plan highlight.
```

```
Create a new ShadCN content element for a Team Members grid 
with photo, name, role, bio, and social links.
```

```
Create a new ShadCN content element for a Stats/Counter section 
showing numbers with labels.
```

**Option 2: Browse [ui.shadcn.com](https://ui.shadcn.com/) and request:**

```
Create a TYPO3 content element based on the shadcn/ui [COMPONENT] component.
Implement it as a Fluid template without JavaScript.
```

### How Do I Choose/Create a Theme?

**Option 1: Visual Editor (tweakcn.com)**

1. Go to [tweakcn.com/editor/theme](https://tweakcn.com/editor/theme)
2. Customize colors, fonts, radius visually
3. Click "Code" → copy the CSS
4. Save to `fileadmin/css/my-theme.css`
5. Configure in TypoScript:
   ```typoscript
   plugin.tx_shadcn2fluid_templates.settings.customThemeCss = fileadmin/css/my-theme.css
   ```

**Option 2: Ask Cursor AI:**

```
Create a custom theme for shadcn2fluid_templates with:
- Primary color: [YOUR COLOR]
- Accent color: [YOUR COLOR]
- Border radius: [e.g., 0.5rem]
- Dark mode support
```

### What Will Cursor Create for Each New Element?

| File | Purpose |
|------|---------|
| `config.yaml` | Field definitions for the backend |
| `assets/icon.svg` | Icon for the content element wizard |
| `templates/frontend.html` | Main Fluid template |
| `templates/partials/*.html` | Variant-specific partials (if needed) |
| CSS styles | Added to `components.css` |
| Documentation | Added to `Documentation/ContentElements/` |

---

## Quick Navigation

```{toctree}
:maxdepth: 2
:titlesonly:

Installation/Index
Configuration/Index
ContentElements/Index
Theming/Index
Partials/Index
Extending/Index
KnownProblems/Index
```

## Compatibility

| Requirement | Version |
|-------------|---------|
| **TYPO3** | 13.4 LTS, 14.x |
| **PHP** | 8.2+ |
| **content_blocks** | 1.x (TYPO3 13) or 2.x (TYPO3 14) |

## Screenshots

### Hero Section Variants

The Hero content element supports three distinct layout variants:

- **Centered**: Classic centered hero for landing pages
- **Split**: Two-column layout with text and image
- **Background**: Full-width background image with overlay

### Content Element Wizard

All ShadCN content elements appear in the "Common" tab of the TYPO3 content element wizard, making them easy to find and use.

## Support

- **Issue Tracker**: [GitHub Issues](https://github.com/webconsulting/shadcn2fluid-templates/issues)
- **Documentation**: You are reading it!

---

*This extension is not affiliated with shadcn/ui but implements its design patterns for TYPO3.*
