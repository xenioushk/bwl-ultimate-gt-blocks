<?php

/**
 * @package BwlLpgtb
 */

namespace Xenioushk\BwlLpgtb\Base;

class BaseController
{

	public $app_url;
	public $plugin_version;
	public $pluginInstallationTag;
	public $pluginPurchaseStatus;
	public $plugin_title; // plugin name e.g. BWL Knowledge Base Manager
	public $plugin_short_title; // plugin name e.g. BWL Knowledge Base Manager
	public $plugin_slug;
	public $plugin_path; // plugin relative url. (use for template or files.)
	public $plugin_url; // plugin absolute url (use for style)
	public $plugin; // plugin base file path.
	public $pluginRootFile; // plugin base file path.
	public $allowed_domains;
	public $default_scripts_dependency;
	public $jobHashTag;
	public $jobDateFormat;
	public $envatoAccessToken;
	public $table_bwl_purchase_verify;
	public $thirdPartyAssetsDir;
	public $pluginAssetsDir;
	public $pluginScriptsDir;
	public $pluginStylesDir;
	public $plugin_text_domain;
	public $plugin_template_path;
	public $plugin_folder_name;
	public $plugin_renew_url;

	// CPT
	public $plugin_post_type;
	public $plugin_query_var;
	public $plugin_cpt_tax_category;
	public $plugin_cpt_tax_category_prefix;
	public $plugin_cpt_tax_category_level;
	public $plugin_cpt_tax_tags;
	public $plugin_cpt_tax_tags_prefix;
	public $plugin_cpt_tax_tags_level;
	public $plugin_cpt_menu_name;
	public $plugin_cpt_label_title;
	public $plugin_cpt_label_singular_name;
	public $plugin_cpt_custom_slug; // this slug will be used in the URL.
	public $plugin_tax_cat_custom_slug; // this slug will be used in the URL.
	public $plugin_tax_tag_custom_slug; // this slug will be used in the URL.
	public $plugin_cpt_show_in_rest;

	// BKBM OPTIONS
	public $bkb_data;
	public $loadFaAssets;
	public $load_remodal_assets;

	// Email settings.
	public $no_reply_email = 'no-reply@yourdomain.com';
	public $kbAdminEmail;

	// Updater Settings.
	public $pluginItemId; // codecanyonid
	public $codeCanYonUrl;
	public $codeCanYonUser;
	public $pluginDownloadUrl;
	public $pluginAuthorProfile;
	public $pluginUpdateXmlFileUrl;
	public $pluginUpdaterRemoteUrl;

	// Meta Info

	public $pluginDocLink;
	public $pluginSupportLink;
	public $pluginYouTubeLink;
	public $pluginAddonsLink;
	public $pluginActiveLicenseLink;

	// API

	public $apiUrl;
	public $apiVersion;

	// Addons.
	public $pluginAddonsStatus;

	// Bundle

	public $kdeskBundle;

	public function __construct()
	{
		// global $wpdb;
		// $this->bkb_data = get_option('bkb_options');
		// $this->app_url = esc_url(get_site_url());
		// $this->pluginPurchaseStatus = Helpers::getPluginPurchaseInfo();
		// $this->plugin_title = "BWL Knowledge Base Manager";
		// $this->plugin_short_title = "BWL KB Manager";
		// $this->plugin_version = Helpers::pluginVersionManager();
		// $this->pluginInstallationTag = 'bkbm_installation_' . str_replace('.', '_', BKBM_PLUGIN_VER);
		// $this->plugin_slug = "bkbm"; // use for the admin notice tag.
		$this->plugin_path      = plugin_dir_path(dirname(__DIR__, 1)); // D:\xampp\htdocs\dev.plugin\bkbm\wp-content\plugins\bwl-kb-manager/
		$this->plugin_url       = plugin_dir_url(dirname(__DIR__, 1)); // http://localhost/dev.plugin/bkbm/wp-content/plugins/bwl-kb-manager/
		$this->pluginAssetsDir  = $this->plugin_url . 'build/';
		$this->pluginScriptsDir = $this->pluginAssetsDir . 'scripts/';
		$this->pluginStylesDir  = $this->pluginAssetsDir . 'styles/';
		// $this->pluginRootFile = "bwl-knowledge-base-manager.php"; // bwl-kb-manager/bwl-knowledge-base-manager.php
		// $this->plugin = plugin_basename(dirname(__FILE__, 3)) . "/{$this->pluginRootFile}"; // bwl-kb-manager/bwl-knowledge-base-manager.php
		// $this->plugin_template_path = $this->plugin_path . '/includes/templates';
		// $this->default_scripts_dependency = "jquery";
		// $this->allowed_domains = ['http://localhost:9000', 'http://localhost:3000', 'http://localhost:3001', 'http://localhost', $this->app_url];
		// $this->table_bwl_purchase_verify = $wpdb->prefix . "bwl_purchase_verify";
		// $this->thirdPartyAssetsDir = $this->plugin_url . "libs/";
		// $this->loadFaAssets = (!isset($this->bkb_data['bkb_fontawesome_status']) || $this->bkb_data['bkb_fontawesome_status'] == 1) ? 1 : 0;
		// $this->load_remodal_assets = (!isset($this->bkb_data['bkb_display_sticky_button']) || $this->bkb_data['bkb_display_sticky_button'] != "") ? 1 : 0;
		$this->plugin_text_domain = 'bwllpgtb';
		// $this->plugin_folder_name = "bwl-kb-manager";
		// $this->plugin_renew_url = "https://1.envato.market/bkbm-wp";

		// // CPT
		// $this->plugin_post_type = "bwl_kb";
		// $this->plugin_query_var = $this->plugin_post_type; // some plugin uses own query var. But for KB it's the same.
		// $this->plugin_cpt_tax_category_level = 5; // It can handle up to 5 level of sub category. (1 main cat + 4 sub cat). Increase the value for more level up and flush the rewrite rules.
		// $this->plugin_cpt_tax_tags_level = 5; // It can handle up to 5 level of sub category. (1 main cat + 4 sub cat). Increase the value for more level up and flush the rewrite rules.
		// $this->plugin_cpt_tax_category = "bkb_category";
		// $this->plugin_cpt_tax_category_prefix = "bkb_cat_";
		// $this->plugin_cpt_tax_tags = "bkb_tags";
		// $this->plugin_cpt_tax_tags_prefix = "bkb_tag_";
		// $this->plugin_cpt_menu_name = 'BWL KB';
		// $this->plugin_cpt_label_title = "Knowledge Base";
		// $this->plugin_cpt_label_singular_name = "KB";
		// $this->plugin_cpt_custom_slug = $this->bkb_data['bkb_custom_slug'] ?? "bwl-knowledge-base";
		// $this->plugin_tax_cat_custom_slug = $this->bkb_data['bkb_custom_cat_slug'] ?? $this->plugin_cpt_custom_slug . '-category';
		// $this->plugin_tax_tag_custom_slug = $this->bkb_data['bkb_custom_tag_slug'] ?? $this->plugin_cpt_custom_slug . '-tags';
		// $this->plugin_cpt_show_in_rest = (isset($this->bkb_data['bkb_gutenberg_status']) && $this->bkb_data['bkb_gutenberg_status'] == 1) ? true : false;
		// // $this->plugin_cpt_show_in_rest =  true;

		// // KB Admin Email

		// $this->kbAdminEmail = (isset($this->bkb_data['bkb_feedback_admin_email']) && $this->bkb_data['bkb_feedback_admin_email'] != "") ? $this->bkb_data['bkb_feedback_admin_email'] : get_bloginfo('admin_email');

		// // Kdesk Bundle.

		// $currentTheme = trim(wp_get_theme()); // Check current theme status.
		// $this->kdeskBundle = (($currentTheme == "knowledgedesk" || $currentTheme == "knowledgedesk Child")) ? 1 : 0;

		// // Updater Settings.

		// $this->pluginItemId = "7972812";
		// $this->pluginUpdateXmlFileUrl = "https://projects.bluewindlab.net/wpplugin/notify/bkb/notifier.xml";
		// $this->codeCanYonUrl = "https://1.envato.market/ccy";
		// $this->pluginDownloadUrl = "https://1.envato.market/bwl-update";
		// $this->pluginAuthorProfile = "https://1.envato.market/xenioushk";
		// $this->codeCanYonUser = "xenioushk";
		// $this->pluginUpdaterRemoteUrl = "https://projects.bluewindlab.net/wpplugin/zipped/plugins/bkbm/notifier_bkbm.php";

		// // Meta Info and it will display the WP plugins page.
		// $this->pluginDocLink = [
		// 'title' => __('Docs', $this->plugin_text_domain),
		// 'url' => "https://projects.bluewindlab.net/wpplugin/bkbm/doc/"
		// ];
		// $this->pluginSupportLink = [
		// 'title' => __('Support', $this->plugin_text_domain),
		// 'url' => "https://codecanyon.net/item/bwl-knowledge-base-manager/7972812/support/contact"
		// ];
		// $this->pluginYouTubeLink = [
		// 'title' => __('Tutorial', $this->plugin_text_domain),
		// 'url' => "https://www.youtube.com/playlist?list=PLxYTuQlgnCLpLvZLHdSUPt5dgRDGVRhxe"
		// ];
		// $this->pluginAddonsLink = [
		// 'title' => __('Addons', $this->plugin_text_domain),
		// 'url' => get_admin_url() . "edit.php?post_type=bwl_kb&page=bkb-addons"
		// ];

		// $this->pluginActiveLicenseLink = [
		// 'title' => __('Active License', $this->plugin_text_domain),
		// 'url' => get_admin_url() . "edit.php?post_type=bwl_kb&page=bkb-license"
		// ];

		// // API.
		// $this->apiUrl = Helpers::getApiUrl();
		// $this->apiVersion = "bkbm/v1";

		// // Plugin Addons.

		// $this->pluginAddonsStatus = [
		// 'kbtpl' => [
		// 'status' => Helpers::getAddonStatus("bkbm-template-manager/bkbm-template-manager.php")
		// ],
		// 'kafvc' => [
		// 'status' => Helpers::getAddonStatus("kb-addon-for-visual-composer/kb-addon-for-visual-composer.php")
		// ],
		// 'kdabp' => [
		// 'status' => Helpers::getAddonStatus("kb-display-as-blog-post/kb-display-as-blog-post.php")
		// ],
		// 'ktfwc' => [
		// 'status' => Helpers::getAddonStatus("kb-tab-for-woocommerce/kb-tab-for-woocommerce.php")
		// ],
		// 'rkbur' => [
		// 'status' => Helpers::getAddonStatus("restrict-kb-by-user-role/restrict-kb-by-user-role.php")
		// ]
		// ];
	}
}
