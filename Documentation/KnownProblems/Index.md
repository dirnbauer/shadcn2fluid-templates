# Known Problems & Troubleshooting

This chapter covers known issues and their solutions.

## Installation Issues

### Content Elements Not Appearing

**Symptom:** ShadCN content elements don't appear in the content element wizard.

**Solutions:**

1. **Verify content_blocks is installed:**
   ```bash
   vendor/bin/typo3 extension:list | grep content_blocks
   ```

2. **Clear all caches:**
   ```bash
   vendor/bin/typo3 cache:flush
   vendor/bin/typo3 cache:flush -g system
   ```

3. **Rebuild content block registration:**
   ```bash
   vendor/bin/typo3 cache:warmup
   ```

4. **Check extension is active:**
   ```bash
   vendor/bin/typo3 extension:list | grep shadcn
   ```

### Database Errors After Installation

**Symptom:** Errors about missing columns or tables.

**Solution:**

```bash
vendor/bin/typo3 database:updateschema
```

### Composer Dependency Conflicts

**Symptom:** Composer fails to resolve dependencies.

**Solution:**

Ensure your TYPO3 version matches the extension requirements:

```json
{
    "require": {
        "typo3/cms-core": "^13.4 || ^14.0",
        "friendsoftypo3/content-blocks": "^1.0 || ^2.0"
    }
}
```

## Styling Issues

### CSS Not Loading

**Symptom:** Content elements appear unstyled.

**Solutions:**

1. **Check TypoScript is included:**
   - Go to Template module
   - Verify setup.typoscript is included

2. **Check browser DevTools:**
   - Network tab: Look for 404 errors on CSS files
   - Console: Check for loading errors

3. **Verify CSS paths:**
   ```typoscript
   page.includeCSS {
       shadcnTheme = EXT:shadcn2fluid_templates/Resources/Public/Css/shadcn-theme.css
       shadcnComponents = EXT:shadcn2fluid_templates/Resources/Public/Css/components.css
   }
   ```

### Theme Variables Not Working

**Symptom:** Colors don't match theme settings.

**Solutions:**

1. **Check CSS load order:**
   - Theme CSS must load before component CSS
   - Custom theme must load after default theme

2. **Verify variable syntax:**
   ```css
   /* Correct */
   color: hsl(var(--primary));
   
   /* Incorrect */
   color: var(--primary);  /* Missing hsl() wrapper */
   ```

3. **Check for CSS specificity issues:**
   - Your custom CSS may be overridden by more specific selectors

### Dark Mode Not Switching

**Symptom:** Dark mode class doesn't change appearance.

**Solutions:**

1. **Verify class placement:**
   ```html
   <!-- Correct -->
   <html class="dark">
   
   <!-- Also correct -->
   <body class="dark">
   ```

2. **Check dark mode variables exist:**
   ```css
   .dark {
       --background: /* dark value */;
       --foreground: /* dark value */;
       /* ... */
   }
   ```

3. **Clear browser cache** - Old CSS may be cached

### OKLCH Colors Not Rendering

**Symptom:** Colors appear as fallback or broken in older browsers.

**Solution:** Add HSL fallbacks:

```css
:root {
    /* HSL fallback for older browsers */
    --primary: 262 83% 58%;
    
    /* OKLCH for modern browsers (will override if supported) */
    --primary: oklch(0.6056 0.2189 292.7172);
}
```

## Content Element Issues

### Accordion Not Collapsing

**Symptom:** Multiple items stay open when they shouldn't.

**Explanation:** The native `<details>` element doesn't support single-item-only behavior without JavaScript.

**Solution:** Add this JavaScript:

```javascript
document.querySelectorAll('.shadcn-accordion[data-allow-multiple="false"]').forEach(acc => {
    acc.querySelectorAll('details').forEach(detail => {
        detail.addEventListener('toggle', () => {
            if (detail.open) {
                acc.querySelectorAll('details').forEach(other => {
                    if (other !== detail) other.open = false;
                });
            }
        });
    });
});
```

### Hero Image Not Displaying

**Symptom:** Split or Background hero shows no image.

**Solutions:**

1. **Check image is uploaded:**
   - Edit the content element
   - Verify image is attached to the field

2. **Check FAL references:**
   - Clear caches after uploading

3. **Verify variant selection:**
   - Image only shows for `split` and `background` variants

### Alert Not Dismissible

**Symptom:** Close button doesn't remove alert.

**Explanation:** The dismiss functionality requires JavaScript.

**Solution:**

```javascript
document.querySelectorAll('.shadcn-alert__close').forEach(btn => {
    btn.addEventListener('click', () => {
        btn.closest('.shadcn-alert').remove();
    });
});
```

## Performance Issues

### Slow Page Load

**Symptom:** Pages with many content elements load slowly.

**Solutions:**

1. **Optimize images:**
   - Use appropriate image sizes
   - Enable TYPO3's image processing

2. **Enable caching:**
   ```typoscript
   config.no_cache = 0
   ```

3. **Minify CSS:**
   ```typoscript
   page.includeCSS.shadcnTheme.compress = 1
   page.includeCSS.shadcnComponents.compress = 1
   ```

### Large CSS File Size

**Symptom:** CSS files are larger than expected.

**Solutions:**

1. **Only include what you need:**
   - Create a custom CSS file with only used components

2. **Enable compression:**
   - Use TYPO3's built-in CSS compression
   - Enable gzip compression on server

## Compatibility Issues

### Content Blocks Version Mismatch

**Symptom:** Errors related to content_blocks extension.

**Solution:**

| TYPO3 Version | content_blocks Version |
|---------------|------------------------|
| 13.4 LTS | 1.x |
| 14.x | 2.x |

Update your composer.json accordingly:

```json
{
    "require": {
        "friendsoftypo3/content-blocks": "^1.0"  // for TYPO3 13
        // or
        "friendsoftypo3/content-blocks": "^2.0"  // for TYPO3 14
    }
}
```

### PHP Version Compatibility

**Symptom:** PHP errors during installation.

**Solution:** Ensure PHP 8.2 or higher:

```bash
php -v
```

## Reporting Issues

If you encounter issues not covered here:

1. **Search existing issues:**
   - Check GitHub issues for similar problems

2. **Gather information:**
   - TYPO3 version
   - PHP version
   - content_blocks version
   - Error messages
   - Steps to reproduce

3. **Create a detailed issue:**
   - Include all gathered information
   - Add screenshots if helpful
   - Describe expected vs actual behavior

---

**Previous:** [Extending](../Extending/Index.md) | **Back to:** [Index](../Index.md)
