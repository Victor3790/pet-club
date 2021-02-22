<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       victorcrespo.net
 * @since      1.0.0
 *
 * @package    Tpc
 * @subpackage Tpc/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tpc
 * @subpackage Tpc/admin
 * @author     Víctor Crespo <victor182@msn.com>
 */
class Tpc_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->load_dependencies();

	}

	/*
    *
    *   Load dependencies for the admin view.
    *
    */

	private function load_dependencies() {

        require_once TPC_PLUGIN_PATH . 'admin/controllers/class_options_dashboard.php';

    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tpc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tpc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tpc-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tpc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tpc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tpc-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_settings()
	{
		register_setting(
			'tpc_settings_group',
			'tpc_settings',
			[
				'sanitize_callback' => [$this, 'sanitize_ids'],
				'default' => '0'
			]
		);

		add_settings_section(
			'tpc_settings_section',
			'Opciones de productos y suscripción.',
			[$this, 'section_text'],
			'pet_club_options'
		);

		add_settings_field(
			'tpc_walk_id',
			'Paseo:',
			[$this, 'tpc_walk_id_callback'],
			'pet_club_options',
			'tpc_settings_section'
		);

		add_settings_field(
			'tpc_lodging_id',
			'Hospedaje:',
			[$this, 'tpc_lodging_id_callback'],
			'pet_club_options',
			'tpc_settings_section'
		);

		add_settings_field(
			'tpc_day_care_id',
			'Guardería:',
			[$this, 'tpc_day_care_id_callback'],
			'pet_club_options',
			'tpc_settings_section'
		);

		add_settings_field(
			'tpc_subscription_id',
			'Suscripción:',
			[$this, 'tpc_subscription_id_callback'],
			'pet_club_options',
			'tpc_settings_section'
		);
	}

	public function register_menu_page()
	{
		$options_dashboard = new Tpc_Options_Dashboard( $this->plugin_name );

		add_menu_page(
			'Pet Club Options',
			'Pet Club Options',
			'manage_options',
			'pet_club_options',
			[$options_dashboard, 'load'],
			'',
			6
		);
	}

	public function section_text()
	{
		echo '<p>Productos:</p>';
	}

	public function sanitize_ids( $input )
	{
		foreach ( $input as $key => $value ) {

			if ( !($value == (string)(int)$value) )
				unset( $input[$key] );

		}

		return $input;
	}

	public function tpc_walk_id_callback()
	{
		$options = get_option( 'tpc_settings' );

		if( !$options || !isset($options['tpc_walk_id']) )
			echo '<input type="number" name="tpc_settings[tpc_walk_id]" placeholder="Id del producto paseo">';
		else
			echo '<input type="number" name="tpc_settings[tpc_walk_id]" value="' . $options['tpc_walk_id'] . '">';
	}

	public function tpc_lodging_id_callback()
	{
		$options = get_option( 'tpc_settings' );

		if( !$options || !isset($options['tpc_lodging_id']) )
			echo '<input type="number" name="tpc_settings[tpc_lodging_id]" placeholder="Id del producto hospedaje">';
		else
			echo '<input type="number" name="tpc_settings[tpc_lodging_id]" value="' . $options['tpc_lodging_id'] . '">';
	}

	public function tpc_day_care_id_callback()
	{
		$options = get_option( 'tpc_settings' );

		if( !$options || !isset($options['tpc_day_care_id']) )
			echo '<input type="number" name="tpc_settings[tpc_day_care_id]" placeholder="Id del producto guardería">';
		else
			echo '<input type="number" name="tpc_settings[tpc_day_care_id]" value="' . $options['tpc_day_care_id'] . '">';
	}

	public function tpc_subscription_id_callback()
	{
		$options = get_option( 'tpc_settings' );

		if( !$options || !isset($options['tpc_subscription_id']) )
			echo '<input type="number" name="tpc_settings[tpc_subscription_id]" placeholder="Id del producto suscripción">';
		else
			echo '<input type="number" name="tpc_settings[tpc_subscription_id]" value="' . $options['tpc_subscription_id'] . '">';
	}

}
