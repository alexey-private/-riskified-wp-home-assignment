# Custom Tabs Plugin

A WordPress plugin implementing a case study industry tabs component with multiple tabs, quote cards, statistics, and trusted by logos.

## Installation

1. Copy the `custom-tabs-plugin` directory to `wp-content/plugins/`
2. Run `composer install` in the plugin directory
3. Run `npm install && npm run build` to compile SCSS
4. Activate the plugin in WordPress Admin

## Usage

Add the shortcode to any page or post:

```
[custom_tabs]
```

## Configuration

Configure tabs and their content via the **Custom Tabs** admin page (WP Admin > Custom Tabs).

## Build

- `npm run build` — Compile SCSS to CSS
- `npm run watch` — Watch SCSS changes and recompile automatically

## License

MIT
