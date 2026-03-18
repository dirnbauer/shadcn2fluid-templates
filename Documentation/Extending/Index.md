# Extending the Extension

This chapter explains how to extend ShadCN to Fluid Templates with your own content elements and customizations.

## Adding New Content Elements

The extension uses TYPO3's Content Blocks system. You can add new content elements following the same pattern.

### Content Block Structure

Each content element follows this structure:

```
ContentBlocks/ContentElements/shadcn-{element-name}/
├── assets/
│   └── icon.svg              # Element icon for backend
├── config.yaml               # Field definitions
└── templates/
    ├── frontend.html         # Main template
    └── partials/             # Optional partials
        └── Variant.html
```

### Step 1: Create the Directory Structure

```bash
mkdir -p packages/shadcn2fluid_templates/ContentBlocks/ContentElements/shadcn-pricing
mkdir -p packages/shadcn2fluid_templates/ContentBlocks/ContentElements/shadcn-pricing/assets
mkdir -p packages/shadcn2fluid_templates/ContentBlocks/ContentElements/shadcn-pricing/templates
```

### Step 2: Create the Icon

Create `assets/icon.svg`:

```xml
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" 
     stroke="currentColor" stroke-width="2">
    <rect x="3" y="4" width="18" height="16" rx="2"/>
    <path d="M3 10h18"/>
    <path d="M12 4v16"/>
</svg>
```

### Step 3: Define Fields in config.yaml

Create `config.yaml`:

```yaml
name: shadcn2fluid/pricing
title: ShadCN Pricing Table
description: Pricing table with multiple plans
group: common
prefixFields: false
fields:
  - identifier: headline
    type: Text
    label: Section Headline
    
  - identifier: subheadline
    type: Textarea
    label: Section Subheadline
    rows: 2
    
  - identifier: plans
    type: Collection
    label: Pricing Plans
    minItems: 1
    maxItems: 4
    fields:
      - identifier: name
        type: Text
        label: Plan Name
        required: true
        
      - identifier: price
        type: Text
        label: Price
        required: true
        description: e.g., "$29/month" or "Free"
        
      - identifier: description
        type: Textarea
        label: Plan Description
        rows: 2
        
      - identifier: features
        type: Textarea
        label: Features (one per line)
        rows: 5
        
      - identifier: is_featured
        type: Checkbox
        label: Featured Plan
        description: Highlight this plan
        default: 0
        
      - identifier: button_text
        type: Text
        label: Button Text
        default: Get Started
        
      - identifier: button_link
        type: Link
        label: Button Link
```

### Step 4: Create the Frontend Template

Create `templates/frontend.html`:

```html
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
      data-namespace-typo3-fluid="true">

<section class="shadcn-pricing">
    <div class="shadcn-pricing__container">
        <f:if condition="{data.headline}">
            <div class="shadcn-pricing__header">
                <h2 class="shadcn-pricing__headline">{data.headline}</h2>
                <f:if condition="{data.subheadline}">
                    <p class="shadcn-pricing__subheadline">{data.subheadline}</p>
                </f:if>
            </div>
        </f:if>
        
        <div class="shadcn-pricing__grid">
            <f:for each="{data.plans}" as="plan">
                <div class="shadcn-pricing__plan {f:if(condition: plan.is_featured, then: 'shadcn-pricing__plan--featured')}">
                    <div class="shadcn-pricing__plan-header">
                        <h3 class="shadcn-pricing__plan-name">{plan.name}</h3>
                        <div class="shadcn-pricing__plan-price">{plan.price}</div>
                        <f:if condition="{plan.description}">
                            <p class="shadcn-pricing__plan-description">{plan.description}</p>
                        </f:if>
                    </div>
                    
                    <f:if condition="{plan.features}">
                        <ul class="shadcn-pricing__features">
                            <f:for each="{plan.features -> f:split(separator: '\n')}" as="feature">
                                <f:if condition="{feature}">
                                    <li class="shadcn-pricing__feature">
                                        <svg class="shadcn-pricing__check" viewBox="0 0 24 24">
                                            <polyline points="20,6 9,17 4,12"/>
                                        </svg>
                                        {feature}
                                    </li>
                                </f:if>
                            </f:for>
                        </ul>
                    </f:if>
                    
                    <f:if condition="{plan.button_link}">
                        <div class="shadcn-pricing__plan-footer">
                            <f:render partial="Components/Button" arguments="{
                                link: plan.button_link,
                                text: plan.button_text,
                                variant: '{f:if(condition: plan.is_featured, then: \"default\", else: \"outline\")}',
                                class: 'shadcn-pricing__button'
                            }"/>
                        </div>
                    </f:if>
                </div>
            </f:for>
        </div>
    </div>
</section>

</html>
```

### Step 5: Add CSS Styles

Add to `Resources/Public/Css/components.css`:

```css
/* Pricing Table */
.shadcn-pricing {
    padding: 4rem 0;
}

.shadcn-pricing__container {
    max-width: 80rem;
    margin: 0 auto;
    padding: 0 1rem;
}

.shadcn-pricing__header {
    text-align: center;
    margin-bottom: 3rem;
}

.shadcn-pricing__headline {
    font-size: 2.25rem;
    font-weight: 700;
    margin: 0 0 1rem;
}

.shadcn-pricing__subheadline {
    font-size: 1.125rem;
    color: hsl(var(--muted-foreground));
}

.shadcn-pricing__grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}

.shadcn-pricing__plan {
    background: hsl(var(--card));
    border: 1px solid hsl(var(--border));
    border-radius: var(--radius);
    padding: 2rem;
    display: flex;
    flex-direction: column;
}

.shadcn-pricing__plan--featured {
    border-color: hsl(var(--primary));
    box-shadow: 0 0 0 1px hsl(var(--primary));
    position: relative;
}

.shadcn-pricing__plan-name {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0 0 0.5rem;
}

.shadcn-pricing__plan-price {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.shadcn-pricing__features {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem;
    flex-grow: 1;
}

.shadcn-pricing__feature {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0;
}

.shadcn-pricing__check {
    width: 1rem;
    height: 1rem;
    stroke: hsl(var(--primary));
    fill: none;
    stroke-width: 2;
}

.shadcn-pricing__button {
    width: 100%;
}
```

### Step 6: Clear Cache

```bash
vendor/bin/typo3 cache:flush
```

## Customizing Existing Elements

### Override Templates

Copy a template to your site package and modify:

```
EXT:your_site_package/Resources/Private/ContentBlocks/
└── shadcn2fluid/
    └── hero/
        └── Source/
            └── Frontend.html   # Your customized version
```

Configure the template path:

```typoscript
plugin.tx_content_blocks {
    templateRootPaths {
        100 = EXT:your_site_package/Resources/Private/ContentBlocks/
    }
}
```

### Extend Field Configuration

Add fields via TCA override:

```php
// EXT:your_site_package/Configuration/TCA/Overrides/tt_content.php

$GLOBALS['TCA']['tt_content']['columns']['shadcn2fluid_hero_custom_field'] = [
    'label' => 'Custom Field',
    'config' => [
        'type' => 'input',
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'shadcn2fluid_hero_custom_field',
    'shadcn2fluid_hero',
    'after:headline'
);
```

## Creating Component Partials

### Basic Partial Structure

```html
<!-- Resources/Private/Partials/Components/MyComponent.html -->
<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
      data-namespace-typo3-fluid="true">
<!--
    My Component Partial
    
    Arguments:
    - title: string - Component title
    - variant: string - Style variant (default, highlight)
    - class: string - Additional CSS classes
-->

<f:variable name="variantClass" value="{f:switch(expression: variant, cases: {
    'default': 'my-component--default',
    'highlight': 'my-component--highlight'
}, default: 'my-component--default')}"/>

<div class="my-component {variantClass} {class}">
    <f:if condition="{title}">
        <h3 class="my-component__title">{title}</h3>
    </f:if>
    
    <div class="my-component__content">
        <f:if condition="{children}">
            {children -> f:format.raw()}
        </f:if>
    </div>
</div>

</html>
```

### Usage

```html
<f:render partial="Components/MyComponent" arguments="{
    title: 'My Title',
    variant: 'highlight',
    children: '<p>Content here</p>'
}"/>
```

## Best Practices

### Naming Conventions

- Content blocks: `shadcn-{element-name}` (kebab-case)
- CSS classes: `shadcn-{element}__child` (BEM)
- Partials: `{ComponentName}.html` (PascalCase)

### Consistent Styling

Always use CSS custom properties:

```css
/* Good */
.my-element {
    color: hsl(var(--foreground));
    background: hsl(var(--background));
    border-radius: var(--radius);
}

/* Avoid */
.my-element {
    color: #333;
    background: white;
    border-radius: 8px;
}
```

### Responsive Design

Use mobile-first approach:

```css
.my-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: 1fr;
}

@media (min-width: 768px) {
    .my-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .my-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
```

### Accessibility

Always include:

- Semantic HTML elements
- ARIA attributes where needed
- Keyboard navigation support
- Sufficient color contrast
- Alt text for images

---

**Previous:** [Partials](../Partials/Index.md) | **Next:** [Known Problems](../KnownProblems/Index.md)
