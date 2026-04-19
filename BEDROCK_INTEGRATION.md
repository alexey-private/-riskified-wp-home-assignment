# Bedrock Integration Guide

## Installation into Bedrock Project

To use the `custom-tabs-plugin` in your Bedrock WordPress installation:

### Step 1: Copy Plugin Directory

Copy the `custom-tabs-plugin` directory to your Bedrock project's plugins folder:

```bash
cp -r custom-tabs-plugin /path/to/bedrock/web/app/plugins/
```

### Step 2: Register Plugin Autoload (Optional but Recommended)

Add the plugin's PSR-4 autoload to your Bedrock root `composer.json`:

```json
{
  "autoload": {
    "psr-4": {
      "CustomTabsPlugin\\": "web/app/plugins/custom-tabs-plugin/src/"
    }
  }
}
```

Then run:

```bash
composer dump-autoload
```

This ensures the plugin classes are autoloaded alongside your theme and other plugins.

### Step 3: Install Plugin Dependencies

Navigate to the plugin directory and install Composer dependencies:

```bash
cd web/app/plugins/custom-tabs-plugin
composer install
```

### Step 4: Build Assets

Compile SCSS to CSS:

```bash
npm install
npm run build
```

### Step 5: Activate Plugin

1. Log into WordPress Admin
2. Navigate to **Plugins**
3. Find **Custom Tabs Plugin** and click **Activate**

## Configuration

After activation, you'll see a **Custom Tabs** menu item in the WordPress Admin sidebar.

- Go to **Custom Tabs** to add and configure tabs
- Use the **Upload** buttons to add images from the WP Media Library
- Fill in tab content: labels, quotes, author info, statistics, and CTAs
- Add company logos to the "Trusted By" section

## Usage

Add the shortcode to any page or post:

```
[custom_tabs]
```

The tabs will render with the data you configured in the admin panel.

## Development

### Watch SCSS Changes

During development, watch for SCSS changes and auto-compile:

```bash
cd web/app/plugins/custom-tabs-plugin
npm run watch
```

### Directory Structure

```
web/app/plugins/custom-tabs-plugin/
├── src/
│   ├── Plugin.php                    (Main plugin class)
│   ├── Admin/TabsOptionsPage.php     (Admin settings page)
│   └── Shortcodes/TabsShortcode.php  (Shortcode handler)
├── templates/
│   └── tabs.php                      (HTML template)
├── assets/
│   ├── scss/tabs.scss                (SCSS source)
│   ├── css/tabs.css                  (Compiled CSS)
│   └── js/
│       ├── tabs.js                   (Frontend tab switching)
│       └── admin.js                  (Admin media uploader)
├── composer.json
├── package.json
├── README.md
└── .gitignore
```

## Notes

- The plugin uses vanilla JavaScript (no jQuery dependency)
- CSS uses Proxima Nova font from Typekit CDN
- All data is stored in WordPress options (no custom tables)
- Images are managed through the WordPress Media Library

For more information, see the plugin's [README.md](./custom-tabs-plugin/README.md).
