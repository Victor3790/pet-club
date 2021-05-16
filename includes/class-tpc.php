<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       victorcrespo.net
 * @since      1.0.0
 *
 * @package    Tpc
 * @subpackage Tpc/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Tpc
 * @subpackage Tpc/includes
 * @author     Víctor Crespo <victor182@msn.com>
 */
class Tpc {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Tpc_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TPC_VERSION' ) ) {
			$this->version = TPC_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'tpc';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tpc_Loader. Orchestrates the hooks of the plugin.
	 * - Tpc_i18n. Defines internationalization functionality.
	 * - Tpc_Admin. Defines all hooks for the admin area.
	 * - Tpc_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tpc-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tpc-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tpc-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tpc-public.php';

		$this->loader = new Tpc_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tpc_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Tpc_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tpc_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_menu_page' );

		$this->loader->add_action( 'dokan_vendor_enabled', $plugin_admin, 'enable_keeper' );
		$this->loader->add_action( 'dokan_vendor_disabled', $plugin_admin, 'disable_keeper' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		require_once TPC_PLUGIN_PATH . 'includes/vk_forms/Data.php';
		require_once TPC_PLUGIN_PATH . 'includes/class_vk_html.php';
		require_once TPC_PLUGIN_PATH . 'includes/class_vk_user_meta.php';
		require_once TPC_PLUGIN_PATH . 'includes/class_vk_post_meta.php';

		require_once TPC_PLUGIN_PATH . 'public/includes/class_custom_query_vars.php';
		require_once TPC_PLUGIN_PATH . 'public/includes/class_custom_query.php';

		require_once TPC_PLUGIN_PATH . 'public/includes/class_redirect.php';
		require_once TPC_PLUGIN_PATH . 'public/includes/class_payment.php';

		$plugin_public = new Tpc_Public( $this->get_plugin_name(), $this->get_version() );
		$query_vars = new Custom_Query_Vars();
		$search = new Custom_Query();
		$redirect = new Tpc_Redirect();
		$payment = new Tpc_Payment();

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_media_uploader' );
		$this->loader->add_action( 'template_redirect', $redirect, 'check_registration' );
		$this->loader->add_action( 'elementor/query/tpc_keepers', $search, 'search' );
		$this->loader->add_action( 'woocommerce_order_status_processing', $payment, 'change_order_status' );
		$this->loader->add_action( 'woocommerce_order_status_on-hold', $payment, 'change_order_status' );
		$this->loader->add_action( 'woocommerce_thankyou', $payment, 'change_thank_you' );
		$this->loader->add_action( 'dokan_load_custom_template', $plugin_public, 'dokan_load_template');

		$this->loader->add_filter( 'dokan_get_dashboard_nav', $plugin_public, 'modify_dokan_dashboard', 12, 1 );
		$this->loader->add_filter( 'query_vars', $query_vars, 'set_vars' );

		$this->loader->add_filter( 'dokan_query_var_filter', $plugin_public, 'dokan_load_document_menu' );
		$this->loader->add_filter( 'dokan_get_dashboard_nav', $plugin_public, 'dokan_add_custom_menu' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tpc_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
