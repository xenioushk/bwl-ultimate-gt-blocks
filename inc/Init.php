<?php

/**
 * @package bwllpgtb
 */

namespace Xenioushk\Bwllpgtb;

class Init
{

	public static function getServices()
	{

		return [
			// Posts\BlogPosts::class, // loads all the frontend styles and scripts.
			// Base\Enqueue::class, // loads all the frontend styles and scripts.
			// Base\AdminEnqueue::class, // loads all the backend styles and scripts.
			Blocks\LatestPosts\LatestPosts::class,
			// Base\Language::class, // loads the translation file.
			// Base\LoadRequiredFiles::class, // load the required helper files.
			// Base\PluginFilterHandlers::class, // Frontend filters like - search, theme, post view count, attachment, rewrite
			// Base\PluginAdminFilterHandlers::class,
			// Base\PluginActionHandlers::class,
			// Base\PluginAdminActionHandlers::class,
			// Base\PluginAjaxHandlers::class,
			// Base\PluginRewriteRulesHandlers::class,
			// Pages\PluginCpt::class,
			// Pages\CustomColumns::class,
			// Pages\CustomQuickBulkEdit::class,
			// Pages\PluginPages::class,
			// Pages\PluginCustomTaxonomy::class,
			// Pages\PluginOptionsPanel::class,
			// Pages\PluginShortcodes::class,
			// Pages\PluginWidgets::class,
			// Base\PluginUpdater::class,
			// Base\PluginAdminNotices::class,
		];
	}

	// Register all services.

	public static function registerServices()
	{

		foreach (self::getServices() as $service) {

			$service = self::instantiate($service);

			if (method_exists($service, 'register')) {
				$service->register();
			}
		}
	}

	private static function instantiate($class)
	{

		return new $class();
	}
}
