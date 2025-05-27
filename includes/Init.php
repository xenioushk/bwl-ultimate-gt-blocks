<?php

namespace BUGTB;

/**
 * Class for Initialize plugin required searvices.
 *
 * @since: 1.1.0
 * @package BUGTB
 */
class Init {

	/**
	 * Get all the services.
	 */
	public static function get_services() {

		/**
		 * Add plugin required classes.
        *
		 * @since 1.1.0
		 */

		$services = [];

		$service_classes = [
			'helpers'    => self::get_helper_classes(),
			'base'       => self::get_base_classes(),
			// 'meta'             => self::get_meta_classes(),
			// 'actions'          => self::get_action_classes(),
			'filters'    => self::get_filter_classes(),
			'gtb_blocks' => self::get_gtb_blocks_classes(),
			// 'cpt'              => self::get_cpt_classes(),
			// 'cmb'              => self::get_cmb_classes(),
			// 'shortcode'        => self::get_shortcode_classes(),
			// 'wpbakery'         => self::get_wpbakery_classes(),
			// 'notices'          => self::get_notices_classes(),
			// 'options_panel'    => self::get_options_panel_classes(),
			// 'role_manager'     => self::get_role_manager_classes(),
			// 'template_manager' => self::get_template_manager_classes(),
		];

		foreach ( $service_classes as $service_class ) {
			$services = array_merge( $services, $service_class );
		}

		return $services;

	}

	/**
	 * Registered all the classes.
     *
	 * @since 1.0.0
	 */
	public static function register_services() {

		if ( empty( self::get_services() ) ) {
			return;
		}

		foreach ( self::get_services() as $service ) {

			$service = self::instantiate( $service );

			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Instantiate all the registered service classes.
     *
     * @param   class $service The class to instantiate.
     * @author   Md Mahbub Alam Khan
     * @return  object
     * @since   1.1.0
	 */
	private static function instantiate( $service ) {
		return new $service();
	}

	/**
	 * Get Base classes.
	 *
	 * @return array
	 */
	private static function get_base_classes() {
		$classes = [
			Base\EnqueueBlockAssets::class,
			Base\Enqueue::class,
			Base\RestApiSupport::class,
			// Base\IncludePluginFiles::class,
			// Base\ThumbHelper::class,
			// Base\AdminEnqueue::class,
			// Base\Language::class,
			// Base\FrontendAjaxHandlers::class,
			// Base\AdminAjaxHandlers::class,
			// Base\FrontendInlineJs::class,
			// Base\AboutPluginRedirect::class,
			// Base\CustomTheme::class,
			// Base\PluginUpdate::class,
			// Base\PetitionsDefaultSignCount::class,
		];
		return $classes;
	}

	/**
	 * Get GTB Blocks classes.
	 *
	 * @return array
	 */
	private static function get_gtb_blocks_classes() {
		$classes = [
			Blocks\Button\Button::class,
			Blocks\Heading\Heading::class,
			Blocks\Banner\Banner::class,
			Blocks\Slide\Slide::class,
			Blocks\SlideShow\SlideShow::class,
			// Blocks\PetitionForm\PetitionForm::class,
			Controllers\Blocks\Petitions\PetitionBlocks::class,
			// Blocks\LatestPosts\LatestPosts::class,
			// Blocks\Testimonial\Testimonial::class,
			// Blocks\Team\Team::class,
		];
		return $classes;
	}

	/**
	 * Get Helper classes.
	 *
	 * @return array
	 */
	private static function get_helper_classes() {
		$classes = [
			Helpers\PluginConstants::class,
		];
		return $classes;
	}

	/**
	 * Get Meta classes.
	 *
	 * @return array
	 */
	private static function get_meta_classes() {
		$classes = [
			Controllers\PluginMeta\MetaInfo::class,
		];
		return $classes;
	}

	/**
	 * Get Action classes.
	 *
	 * @return array
	 */
	private static function get_action_classes() {
		$classes = [
			Controllers\Actions\PetitionActions::class,
			Controllers\Actions\RoleManager\AccessActions::class,
			Controllers\Actions\RoleManager\PostsActions::class,
		];
		return $classes;
	}

	/**
	 * Get Filter classes.
	 *
	 * @return array
	 */
	private static function get_filter_classes() {

		$classes = [
			Controllers\Filters\Admin\BlockCategory::class,
		];
		return $classes;
	}
	/**
	 * Get CPT classes.
	 *
	 * @return array
	 */
	private static function get_cpt_classes() {
		$classes = [
			Controllers\Cpt\PluginCpt::class,
			Controllers\Cpt\CustomColumns::class,
			Controllers\Cpt\TaxonomyFilters::class,
		];
		return $classes;
	}

	/**
	 * Get CMB classes.
	 *
	 * @return array
	 */
	private static function get_cmb_classes() {
		$classes = [
			Controllers\Cmb\PetitionsIntroCmb::class,
			Controllers\Cmb\PetitionsAboutCmb::class,
			Controllers\Cmb\PetitionsLetterCmb::class,
			Controllers\Cmb\PetitionsFormCmb::class,
			Controllers\Cmb\PetitionsTargetCmb::class,
			Controllers\Cmb\PetitionsLetterSubmitCmb::class,
			Controllers\Cmb\PetitionsShareCmb::class,
			Controllers\Cmb\PetitionsStatsCmb::class,
		];

		return $classes;
	}

	/**
	 * Get shortcode classes.
	 *
	 * @return array
	 */
	private static function get_shortcode_classes() {
		$classes = [
			Controllers\Shortcodes\PetitionBlocks\PetitionLists::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionIntro::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionAbout::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionDetail::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionProgressBar::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionResult::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionResultFeed::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionLetter::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionSignCounter::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionSubmitTo::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionFeaturedImage::class,
			Controllers\Shortcodes\PetitionBlocks\PetitionShare::class,
			Controllers\Shortcodes\PetitionSignForm\CountryLists::class,
			Controllers\Shortcodes\PetitionSignForm\FormFields::class,
			Controllers\Shortcodes\PetitionSignForm\LoginForm::class,
			Controllers\Shortcodes\PetitionSignForm\SignVerify::class,
			Controllers\Shortcodes\ExternalForm\PetitionCreateForm::class,
		];

		return $classes;
	}

	/**
	 * Get WPBakery classes.
	 *
	 * @return array
	 */
    private static function get_wpbakery_classes() {
			$classes = [
				Controllers\WPBakery\Shortcodes\PetitionTitle::class,
				Controllers\WPBakery\Elements\Intro::class,
				Controllers\WPBakery\Elements\About::class,
				Controllers\WPBakery\Elements\Details::class,
				Controllers\WPBakery\Elements\Letter::class,
				Controllers\WPBakery\Elements\SignForm::class,
				Controllers\WPBakery\Elements\Result::class,
				Controllers\WPBakery\Elements\SignCounter::class,
				Controllers\WPBakery\Elements\ResultFeed::class,
				Controllers\WPBakery\Elements\FeaturedImage::class,
				Controllers\WPBakery\Elements\SubmittedTo::class,
				Controllers\WPBakery\Elements\ProgressBar::class,
				Controllers\WPBakery\Elements\Share::class,
			];

			return $classes;
	}

	/**
	 * Get Notices classes.
	 *
	 * @return array
	 */
	private static function get_notices_classes() {
		$classes = [
			Controllers\Notices\PluginNotices::class,
			Controllers\Notices\PluginNoticesAjaxHandler::class,
		];
		return $classes;
	}

	/**
	 * Get Options Panel classes.
	 *
	 * @return array
	 */
	private static function get_options_panel_classes() {

		$classes = [
			Controllers\Pages\PluginPages::class,
			Controllers\Pages\OptionsPanel\CoreOptionsPanel::class,
			Controllers\Pages\OptionsPanel\EmailTemplate::class,
			Controllers\Pages\OptionsPanel\SignFormTemplate::class,
			Controllers\Pages\OptionsPanel\ReportDownload::class,
		];
		return $classes;
	}

	/**
	 * Get Role Manager classes.
	 *
	 * @return array
	 */
	private static function get_role_manager_classes() {
		$classes = [
			Controllers\RoleManager\PetitionCreator::class,
		];
		return $classes;
	}

	/**
	 * Get Template Manager classes.
	 *
	 * @return array
	 */
	private static function get_template_manager_classes() {
		$classes = [
			Controllers\TemplatesManager\PetitionTemplates::class,
		];
		return $classes;
	}
}
