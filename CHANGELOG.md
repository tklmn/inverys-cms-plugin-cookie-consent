# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

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
- Composer package support (`nioteq-plugin` type)
- ZIP upload support for manual installation
