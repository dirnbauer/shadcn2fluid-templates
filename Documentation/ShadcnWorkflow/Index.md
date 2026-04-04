# Shadcn Workflow

This extension does not run the upstream shadcn CLI in production. TYPO3 renders pure Fluid templates and precompiled CSS. However, contributors should use the official shadcn tools as the source of truth when adding or rebuilding elements.

## Recommended contributor workflow

1. Use the official shadcn documentation and block directories to select the source component or block family.
2. Use the upstream shadcn CLI to inspect recipes and docs:

```bash
pnpm dlx shadcn@latest docs button
pnpm dlx shadcn@latest docs card
pnpm dlx shadcn@latest info
```

3. If working in an AI-assisted workflow, use the official shadcn skills as the reference layer for component structure, variants, and field patterns.
4. Translate the resulting React or registry recipe into:
   - TYPO3 Content Blocks YAML
   - Fluid templates
   - the shared shadcn-style primitive layer in `Resources/Public/Css/components.css`
5. Reuse shared Fluid partials such as `Components/Button`, `Components/Badge`, and `Components/Card` before introducing new primitives.

## What transfers cleanly

- visual hierarchy
- spacing and sizing recipes
- button, badge, card, separator, and typography primitives
- marketing block composition
- variant patterns

## What does not transfer directly

- React state logic
- Radix-only interaction APIs
- client-side form libraries
- build-time registry installation

## Rule of thumb

Use the official shadcn CLI and skills for **design and API reference**, then implement the final result as **TYPO3-native Content Blocks plus Fluid templates**.
