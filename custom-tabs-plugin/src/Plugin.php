<?php

namespace CustomTabsPlugin;

use CustomTabsPlugin\Admin\TabsOptionsPage;
use CustomTabsPlugin\Shortcodes\TabsShortcode;

class Plugin {
	public function boot(): void {
		( new TabsOptionsPage() )->register();
		( new TabsShortcode() )->register();
	}
}
