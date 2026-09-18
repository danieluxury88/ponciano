# Ponciano — Parroquia Transfiguración del Señor

Microsite for the parish's Bible study group ("Grupo de Biblia"). It currently features an interactive walkthrough of the First Letter to the Corinthians, a parish events calendar, and a placeholder page for a future study of the Second Letter.

## Overview

- Type: PHP micro-framework ([FlightPHP](https://flightphp.com/)) + Twig — static-content microsite
- Production URL: https://ponciano.seriousdesign.net

## Content

- Languages: es
- User roles: N/A — no CMS or authentication; content is defined directly in `public/index.php`
- Features:
  - Landing page listing the available letters ("Primera Carta a los Corintios" open, "Segunda Carta" marked próximamente)
  - `/1-corintios`: hero Bible verse, six interactive topic cards, a historical map + timeline of ancient Corinth, and a "takeaway message" card that auto-rotates every 10s through verses cited by chapter and verse
  - `/2-corintios`: coming-soon placeholder
  - Parish calendar (Sept–Dec 2026) on the homepage: single interactive month view, highlights the current day, marks liturgical feast days plus the first-Sunday-of-the-month Cáritas collection (computed automatically, not hardcoded per month)

## Branding

- Logo: `public/img/logo.png` (full lockup), `public/img/mark.png` (icon only — used in the header, footer, and hero badge)
- Main colors: `#0B4DB7` azul principal · `#1E88E5` azul secundario · `#4FC3F7` celeste · `#E3F2FD` fondo claro · `#1F2937` texto
- Typography: Fraunces (serif — headings and Bible quotes) + Manrope (sans — body and nav), loaded from Google Fonts

## Stack

- Backend: PHP 8.1+, FlightPHP (`flightphp/core ^3.19`)
- Frontend: Twig 3 templates (`twig/twig ^3.29`), vanilla JS (no build step), plain CSS (no preprocessor)
- Front end libraries: none — Google Fonts (Fraunces, Manrope) via CDN `<link>`
- Database: none
- Hosting / Runtime: Apache 2 on a VPS; `public/.htaccess` rewrites all non-file requests to `public/index.php`

## Requirements

- PHP 8.1 or newer
- Composer
- Apache with `mod_rewrite` enabled and `AllowOverride All` on the `public/` directory (or an equivalent catch-all rewrite to `index.php` on another web server)

## Quick Start

```bash
composer install
php -S localhost:8000 -t public
```

Then open http://localhost:8000.

## Common Commands

```bash
composer install                    # install/update PHP dependencies
php -S localhost:8000 -t public     # run locally with PHP's built-in server
```

There's no build step, test suite, or cache to clear — templates, CSS, and JS are served as-is.

## Project Layout

```txt
.
├── composer.json
├── composer.lock
├── public/                     # web root — DocumentRoot must point here
│   ├── .htaccess               # rewrites clean URLs to index.php
│   ├── index.php               # Flight routes, page data, Twig rendering
│   ├── css/app.css
│   ├── js/app.js
│   ├── img/                    # logo.png, mark.png
│   └── favicon.png
├── templates/                  # Twig templates
│   ├── base.html.twig          # header, footer, fonts, page shell
│   ├── landing.html.twig       # "/" — letter cards + calendar
│   ├── 1-corintios.html.twig
│   └── coming-soon.html.twig
└── vendor/                     # Composer dependencies (not committed)
```

## Configuration

There's no separate config file or CMS — routes and their page data (topics, calendar events, rotating messages) are defined directly as PHP arrays in `public/index.php`, passed to the matching Twig template.

- Main config: `public/index.php`
- Environment file: N/A — no environment variables are used
- Local overrides: N/A

## Usage

To add or edit content, edit the relevant `Flight::route(...)` block in `public/index.php` (e.g. the `messages`, `topics`, or calendar `liturgicalDates` arrays) and, if needed, the matching Twig template in `templates/`. Adding a new page means adding a new `Flight::route()` plus a new `.twig` template extending `base.html.twig`.

```bash
php -S localhost:8000 -t public
```

## Documentation

No additional docs beyond this README yet.

## Notes

- **Apache deployment**: the site needs `mod_rewrite` enabled and `AllowOverride All` on `public/` for `.htaccess` to take effect, and `DocumentRoot` must point at `public/`, not the project root — otherwise every route but `/` 404s.
- No database, no build tooling, no automated tests — this is intentionally a small, dependency-light site.
