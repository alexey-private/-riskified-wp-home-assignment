# Custom Tabs Plugin

A professional WordPress plugin implementing a case study industry tabs component with configurable tabs, quote cards, statistics, call-to-action buttons, and trusted company logos.

## Features

- **Dynamic Tab Navigation** — Horizontal tab navigation with purple active state and smooth transitions
- **Quote Cards** — Display customer testimonials with author details and background images
- **Statistics** — Highlight key metrics (e.g., "50% reduction in costs")
- **Call-to-Action Cards** — Navy blue CTA buttons with arrow icons linking to case study content
- **Trusted By Section** — Showcase company logos that trust your service
- **Responsive Design** — Fully responsive layout for desktop and mobile devices
- **Admin Interface** — Easy-to-use WordPress Admin settings page to manage all content
- **Media Integration** — Use WordPress Media Library to upload and manage images
- **Keyboard Navigation** — Full accessibility support with arrow keys and tab navigation
- **Vanilla JavaScript** — No jQuery dependency; lightweight and fast
- **SCSS Architecture** — Clean, maintainable styling with SCSS variables and modern CSS

## Quick Start

### Installation

1. Copy the `custom-tabs-plugin` directory to your WordPress installation:
   ```bash
   wp-content/plugins/custom-tabs-plugin/
   ```

2. Install dependencies:
   ```bash
   cd custom-tabs-plugin
   composer install
   npm install
   npm run build
   ```

3. Activate the plugin in WordPress Admin → Plugins

### Configuration

1. Go to WordPress Admin → **Custom Tabs** menu
2. Add tabs with:
   - Tab label (e.g., "Retail", "Luxury fashion")
   - Quote text
   - Author name and title
   - Author avatar, company logo, and background image
   - Statistic number and label
   - CTA text and link
3. Add company logos to the "Trusted By" section
4. Click **Save Changes**

### Usage

Add the shortcode to any page or post:

```
[custom_tabs]
```

## Design & Styling

- **Font**: Proxima Nova (loaded via Typekit CDN)
- **Colors**:
  - Primary accent: `#6B4EFF` (purple)
  - CTA background: `#1B2340` (navy)
  - Card backgrounds: white and light gray
- **Breakpoints**: Mobile-first design with tablet and desktop layouts
- **CSS Compilation**: SCSS compiled with Dart Sass

### Customize Styling

Edit `assets/scss/tabs.scss` and recompile:

```bash
npm run build
```

Or watch for changes:

```bash
npm run watch
```

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- iOS Safari 12+
- Chrome Android 80+

## Accessibility

- ARIA labels and roles for screen readers
- Keyboard navigation (arrow keys, Home/End)
- Color contrast compliant with WCAG AA standards
- Semantic HTML structure

## File Structure

```
custom-tabs-plugin/
├── custom-tabs-plugin.php       Main plugin file
├── README.md                    This file
├── composer.json                PHP dependencies
├── package.json                 npm scripts
├── .gitignore                   Git ignore rules
├── src/
│   ├── Plugin.php               Main plugin class
│   ├── Admin/
│   │   └── TabsOptionsPage.php  Admin settings page
│   └── Shortcodes/
│       └── TabsShortcode.php    Shortcode handler
├── templates/
│   └── tabs.php                 Frontend HTML template
└── assets/
    ├── scss/
    │   └── tabs.scss            SCSS styles
    ├── css/
    │   └── tabs.css             Compiled CSS (auto-generated)
    └── js/
        ├── tabs.js              Frontend tab switching
        └── admin.js             Admin media uploader
```

## Development

### Build Process

```bash
# Install dependencies
npm install
composer install

# Compile SCSS
npm run build

# Watch SCSS changes
npm run watch
```

### Code Quality

- PHP follows WordPress coding standards
- JavaScript uses vanilla ES6+ syntax
- All escaping and sanitization follows WordPress best practices
- All admin content is properly escaped (`esc_html()`, `esc_url()`, etc.)

## Requirements

- WordPress 5.0+
- PHP 8.1+
- npm and Node.js (for SCSS compilation)
- Composer (optional, for autoloading in Bedrock)

## Notes

- All tab data is stored in WordPress options (`custom_tabs_data`)
- No custom database tables are created
- Images are managed through the WordPress Media Library
- The plugin is lightweight with minimal dependencies

## Support & Documentation

For integration with Bedrock projects, see [BEDROCK_INTEGRATION.md](../BEDROCK_INTEGRATION.md).

## License

MIT License. See LICENSE file for details.

## Author

Developed as a WordPress interview assignment.
