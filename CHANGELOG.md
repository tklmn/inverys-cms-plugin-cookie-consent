# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [2.0.0] - 2026-10-05

### Changed
- **Breaking:** renamed for Inverys CMS. The package is now `inverys/cookie-consent` with the Composer type `inverys-plugin`, and its settings live under `extra.inverys`. Requires Inverys CMS; for older CMS versions stay on 1.x.

## [1.1.0] - 2026-03-21

### Added
- Two-step banner UX: initial view with Accept All / Necessary Only / Options buttons; Options reveals category toggles with Save button
- Configurable reopen button position (left / right, default left)
- Banner text reset-to-default button in admin settings
- Animated banner entrance with backdrop blur and slide-in transition
- Smooth toggle switch animations with cubic-bezier easing
- Cookie icon in banner header
- Consistent back button styling in admin views (matches CMS design)

### Changed
- Banner buttons restructured: Alle / Nur Notwendige / Optionen (initial) → Speichern / Optionen (expanded)
- Reopen button uses rounded-square shape with shield SVG instead of Bootstrap icon
- Categories panel uses CSS grid animation for expand/collapse

## [1.0.0] - 2026-03-21

### :tada: Initial Release

#### Added
- GDPR-compliant cookie consent banner with opt-in model
- Four cookie categories: Necessary, Functional, Statistics, Marketing
- External service management (CRUD) in admin backend
- Server-side conditional script injection based on consent cookie
- Three banner layouts: bottom bar, centered modal, corner box
- Customizable colors for banner and buttons
- Configurable cookie lifetime
- Privacy policy and imprint page linking
- Floating re-open button for consent changes
- Category detail view showing services per category
- Full English and German translations
- Head hook support for script injection in `<head>`
- Composer package support (`inverys-plugin` type)
- ZIP upload support for manual installation
