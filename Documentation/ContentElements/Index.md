# Content Elements

This chapter documents the current shipped content-element set and how it maps into the long-term 10-chapter TYPO3 create wizard.

## Overview

The extension now provides 46 content elements:

| Content Element | Description | Variants / Templates |
|-----------------|-------------|----------------------|
| [Hero Section](Hero.md) | Landing page hero with headline and CTAs | Centered, Split, Background |
| [Accordion / FAQ](Accordion.md) | Collapsible content sections | Single, Multiple open |
| [Announcement Bar](AnnouncementBar.md) | Top-of-page announcement and promo messaging | Default, Accent, Outline |
| [Alert / Callout](Alert.md) | Important messages and notifications | Default, Info, Success, Warning, Destructive |
| [Article Hero](ArticleHero.md) | Editorial article intro with metadata and cover image | Editorial Hero |
| [Article Grid](ArticleGrid.md) | Editorial card grid for article archives | Article Grid |
| [Breadcrumb](Breadcrumb.md) | Breadcrumb trail for inner pages | Breadcrumb |
| [Area Chart](Chart.md) | Interactive data visualization chart | Gradient, Solid fill |
| [Card](Card.md) | Versatile card component | Basic, Image, Horizontal |
| [Call to Action](Cta.md) | Prominent CTA sections | Centered, Split, Banner, Inline |
| [Category Cards](CategoryCards.md) | Topic navigation and content hub cards | Category Cards |
| [Centered Navbar](CenteredNavbar.md) | Balanced centered navigation layout | Centered Navbar |
| [Compare](Compare.md) | Side-by-side offer or product comparison | Full Width, Two Columns, Stacked |
| [Contact](Contact.md) | Contact section with info panel and form layout | Full Width, Two Columns, Stacked |
| [Feature Cards](FeatureCards.md) | Feature presentation as responsive cards | Feature Cards |
| [Feature Grid](Features.md) | Grid of features with icons | Icon Top, Icon Left, Card |
| [Feature Matrix](FeatureMatrix.md) | Side-by-side capability matrix | Feature Matrix |
| [Feature Checklist](FeatureChecklist.md) | Checklist of plan inclusions and guarantees | Checklist |
| [Feature List](FeatureList.md) | Editorial feature rows with icon markers | Full Width, Two Columns, Stacked |
| [Four Tier Pricing](FourTierPricing.md) | Pricing grid for four plans | Four Tier Pricing |
| [Footer](Footer.md) | Footer with brand text and link groups | Full Width, Two Columns, Stacked |
| [Gallery / Portfolio](Gallery.md) | Visual portfolio and media grid | Full Width, Two Columns, Stacked |
| [Hero Logo Cloud](HeroLogoCloud.md) | Hero with trust-building logo strip | Hero + Logos |
| [Hero Stats](HeroStats.md) | Hero with compact metric cards | Hero + Stats |
| [Hero Video](HeroVideo.md) | Hero with video panel | Hero + Video |
| [KPI Cards](KpiCards.md) | Metric and proof cards with trend emphasis | Full Width, Two Columns, Stacked |
| [Logo Cloud](LogoCloud.md) | Customer, partner, or press logos | Full Width, Two Columns, Stacked |
| [Mega Menu](MegaMenu.md) | Grouped navigation panel with CTA | Full Width, Two Columns |
| [Navbar](Navbar.md) | Marketing navigation bar with CTA buttons | Full Width, Two Columns, Stacked |
| [Newsletter Signup](NewsletterSignup.md) | Newsletter lead capture section | Full Width, Two Columns, Stacked |
| [Pricing Toggle](PricingToggle.md) | Pricing cards with monthly and yearly values | Pricing Toggle |
| [Pricing](Pricing.md) | Pricing plans with featured tier highlighting | Full Width, Two Columns, Stacked |
| [Resource Library](ResourceLibrary.md) | Resource-card library for guides and downloads | Resource Library |
| [Search Header](SearchHeader.md) | Headline plus inline search form | Search Header |
| [Sticky Navbar](StickyNavbar.md) | Sticky navigation header | Sticky Navbar |
| [Stats](Stats.md) | KPI and proof-point cards | Full Width, Two Columns, Stacked |
| [Team](Team.md) | Team member cards and portraits | Full Width, Two Columns, Stacked |
| [Testimonial](Testimonial.md) | Customer quotes and reviews | Simple, Card, Large |
| [Text with Media](Textmedia.md) | Text and image/video layouts | Media Right, Left, Above, Below |
| [Timeline](Timeline.md) | Process, roadmap, or milestone timeline | Full Width, Two Columns, Stacked |
| [Transparent Navbar](TransparentNavbar.md) | Hero-overlay navigation style | Transparent Navbar |
| [Two Tier Pricing](TwoTierPricing.md) | Two-plan pricing comparison | Two Tier Pricing |
| [Blog Teasers](BlogTeasers.md) | Article teaser cards for content hubs | Full Width, Two Columns, Stacked |
| [Use Case Grid](UseCaseGrid.md) | Audience and scenario card grid | Use Case Grid |
| [Usage Pricing](UsagePricing.md) | Usage-based pricing cards | Usage Pricing |
| [Utility Bar](UtilityBar.md) | Secondary top bar with support links | Utility Bar |

## TYPO3 wizard chapters

The rebuilt extension uses these 10 chapter groups in the TYPO3 create wizard:

1. `headers-navigation`
2. `hero-landing`
3. `features-storytelling`
4. `social-proof-trust`
5. `pricing-commerce`
6. `content-editorial`
7. `team-company`
8. `contact-conversion`
9. `data-utility`
10. `footers-legal`

## Current chapter mapping

| Wizard Chapter | Shipped content elements |
|----------------|--------------------------|
| Headers & Navigation | Navbar, Announcement Bar, Mega Menu, Utility Bar, Breadcrumb, Search Header, Centered Navbar, Sticky Navbar, Transparent Navbar |
| Hero & Landing | Hero, Hero Video, Hero Stats, Hero Logo Cloud |
| Features & Storytelling | Features, Feature Cards, Feature List, Feature Matrix, Use Case Grid, Text with Media, Timeline |
| Social Proof & Trust | Logo Cloud, Stats, Testimonial, KPI Cards |
| Pricing & Commerce | Pricing, Compare, Pricing Toggle, Feature Checklist, Two Tier Pricing, Four Tier Pricing, Usage Pricing |
| Content & Editorial | Accordion, Article Hero, Article Grid, Blog Teasers, Category Cards, Gallery, Resource Library |
| Team & Company | Team |
| Contact & Conversion | Contact, Call to Action, Newsletter Signup |
| Data & Utility | Alert, Card, Chart |
| Footers & Legal | Footer |

## Shared section templates

Most new marketing blocks use the same three outer templates:

- **Full Width**: centered intro with broad content area, useful for logo clouds and galleries
- **Two Columns**: intro on the left, content on the right, useful for stats and contact sections
- **Stacked**: intro above content, useful for pricing, team, comparison, and blog sections

## Content Element Details

```{toctree}
:maxdepth: 1

Hero
Accordion
AnnouncementBar
Alert
ArticleHero
ArticleGrid
Breadcrumb
Chart
Card
Cta
CategoryCards
CenteredNavbar
Compare
Contact
FeatureCards
Features
FeatureChecklist
FeatureMatrix
FeatureList
FourTierPricing
Footer
Gallery
HeroLogoCloud
HeroStats
HeroVideo
KpiCards
LogoCloud
MegaMenu
Navbar
NewsletterSignup
PricingToggle
Pricing
ResourceLibrary
SearchHeader
StickyNavbar
Stats
Team
Testimonial
Textmedia
Timeline
TransparentNavbar
TwoTierPricing
BlogTeasers
UseCaseGrid
UsagePricing
UtilityBar
```
