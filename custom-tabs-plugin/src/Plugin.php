<?php

namespace CustomTabsPlugin;

class Plugin {
	public function boot(): void {
		( new Admin\TabsOptionsPage() )->register();
		( new Shortcodes\TabsShortcode() )->register();
	}
}
