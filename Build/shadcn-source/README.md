# shadcn source workspace

Throwaway Vite+React project used only as a host for the shadcn CLI.
We run `npx shadcn@latest add <component>` here, then port the generated
JSX/TSX from `src/components/ui/` into TYPO3 Fluid templates under
`ContentBlocks/*/templates/frontend.html` (classes stay verbatim,
React event handlers → Alpine directives).

## First-time setup

```bash
cd Build/shadcn-source
npm install
npx shadcn@latest init
```

When the CLI prompts:
- Style: **Default**
- Base color: **Neutral**
- CSS variables: **Yes**
- Tailwind config: accept defaults

## Adding components

```bash
# Individual component
npx shadcn@latest add button

# Multiple at once
npx shadcn@latest add card button badge dialog tabs
```

Fetched files appear under `src/components/ui/`. Copy the JSX class lists
into the corresponding Fluid template; replace `className` with `class`,
replace React state hooks with Alpine `x-data`/`x-show`/`x-on:` bindings.

## Porting cheatsheet

| React pattern | Alpine equivalent |
|---|---|
| `const [open, setOpen] = useState(false)` | `x-data="{ open: false }"` |
| `onClick={() => setOpen(!open)}` | `x-on:click="open = !open"` |
| `{open && <div>...}` | `x-show="open"` |
| Radix `<Portal>` | native `<template x-teleport="body">` |
| `cn(...)` helper | string concat in Fluid, or `f:join` |

Not committed:
- `node_modules/`
- `.next/`
- `components.json` is gitignored while the workspace is still bootstrapped;
  check it in once stable.
