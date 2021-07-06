<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       victorcrespo.net
 * @since      1.0.0
 *
 * @package    Tpc
 * @subpackage Tpc/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tpc
 * @subpackage Tpc/public
 * @author     Víctor Crespo <victor182@msn.com>
 */
class Tpc_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
        $this->version = $version;
        
        $this->load_dependencies();

    }
    
    /*
    *
    *   Load dependencies for the public view.
    *
    */
    private function load_dependencies() {

        require_once TPC_PLUGIN_PATH . 'public/controllers/class_vendor_dashboard.php';
		require_once TPC_PLUGIN_PATH . 'public/controllers/class_vendor_dashboard_action.php';
		
		require_once TPC_PLUGIN_PATH . 'public/controllers/class_search_dashboard.php';
		require_once TPC_PLUGIN_PATH . 'public/controllers/class_search_dashboard_action.php';
		
		require_once TPC_PLUGIN_PATH . 'public/controllers/class_list_widget.php';

		require_once TPC_PLUGIN_PATH . 'public/controllers/class_update_vendor_info.php';

    }

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		wp_register_style( $this->plugin_name . '_bootstrap_styles', 
			plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css', 
			array(), 
			$this->version, 
			'all' );

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tpc-public.css', array(), $this->version, 'all' );

		wp_register_style( $this->plugin_name . '_wizard_styles', 
			'https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css', 
			array(), 
			$this->version, 
			'all' );

		wp_register_style( $this->plugin_name . '_form_styles', 
			plugin_dir_url( __FILE__ ) . 'assets/css/tpc_form.css', 
			array(), 
			$this->version, 
			'all' );

		wp_register_style( $this->plugin_name . '_fontawesome', 
			plugin_dir_url( __FILE__ ) . 'assets/css/fontawesome/css/fontawesome.min.css', 
			array(), 
			$this->version, 
			'all' );

		wp_register_style( $this->plugin_name . '_fontawesome_solid', 
			plugin_dir_url( __FILE__ ) . 'assets/css/fontawesome/css/solid.min.css', 
			array($this->plugin_name . '_fontawesome'), 
			$this->version, 
			'all' );

		wp_register_style( $this->plugin_name . '_search', 
			plugin_dir_url( __FILE__ ) . 'assets/css/tpc_search.css', 
			array($this->plugin_name . '_bootstrap_styles'), 
			$this->version, 
			'all' );

		wp_register_style( $this->plugin_name . '_select2_styles', 
			plugin_dir_url( __FILE__ ) . 'assets/css/select2.min.css', 
			array($this->plugin_name . '_bootstrap_styles'), 
			$this->version, 
			'all' );

		wp_register_style( $this->plugin_name . '_pet_inputs_styles', 
			plugin_dir_url( __FILE__ ) . 'assets/css/pet_inputs.css', 
			array(), 
			$this->version, 
			'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tpc-public.js', array( 'jquery' ), $this->version, false );

		wp_register_script( $this->plugin_name . '_jquery_ajax', 
			plugin_dir_url( __FILE__ ) . 'assets/js/tpc_jquery_ajax.js', 
			array( 'jquery' ), 
			$this->version, 
			false );

		wp_localize_script(
			$this->plugin_name . '_jquery_ajax',
			'tpc_object',
			[
				'ajax_url' => admin_url( 'admin-ajax.php' )
			]);

		wp_register_script( $this->plugin_name . '_popper', 
			'https://unpkg.com/@popperjs/core@2', 
			array(), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_bootstrap', 
			plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.bundle.min.js', 
			array(
				'jquery',
				$this->plugin_name . '_popper'
			), 
			$this->version, 
			false );
		
		wp_register_script( $this->plugin_name . '_smart_wizard', 
			'https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js', 
			array( 'jquery' ), 
			$this->version, 
			false );
        
		wp_register_script( $this->plugin_name . '_validate', 
			plugin_dir_url( __FILE__ ) . 'assets/js/jquery.validate.min.js', 
			array( 'jquery' ), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_reg_form_wizard', 
			plugin_dir_url( __FILE__ ) . 'assets/js/tpc_reg_form_wizard.js', 
			array( 
				$this->plugin_name . '_smart_wizard', 
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_custom_wizard_process', 
			plugin_dir_url( __FILE__ ) . 'assets/js/tpc_custom_wizard_process.js', 
			array( 
				$this->plugin_name . '_tpc_reg_form_wizard', 
			), 
			$this->version, 
			false );

        wp_register_script( $this->plugin_name . '_tpc_reg_keeper_address', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_reg_keeper_address.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_reg_keeper_contact', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_reg_keeper_contact.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process',
				'jquery-ui-datepicker'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_reg_keeper_home', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_reg_keeper_home.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_reg_keeper_services', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_reg_keeper_services.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_wp_media_upload_image', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_wp_media_upload_image.js', 
			array( 
				'jquery'
			), 
			$this->version, 
			false );
		
		/*wp_register_script( $this->plugin_name . '_google_maps', 
            'https://maps.googleapis.com/maps/api/js?key=&libraries=places', 
			array(), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_map', 
			plugin_dir_url( __FILE__ ) . 'assets/js/tpc_map.js', 
			array('jquery', $this->plugin_name . '_google_maps'), 
			$this->version, 
			false );*/

		wp_register_script( $this->plugin_name . '_tpc_search_controls', 
			plugin_dir_url( __FILE__ ) . 'assets/js/tpc_search_controls.js', 
			array('jquery'), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_select2', 
			plugin_dir_url( __FILE__ ) . 'assets/js/select2.full.min.js', 
			array('jquery'), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_update_keeper_address', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_update_keeper_address.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_update_form_wizard', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_update_form_wizard.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_update_home_wizard', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_update_home_wizard.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_tpc_update_keeper_home', 
            plugin_dir_url( __FILE__ ) . 'assets/js/tpc_update_keeper_home.js', 
			array( 
				$this->plugin_name . '_validate',
				$this->plugin_name . '_tpc_custom_wizard_process'
			), 
			$this->version, 
			false );

		wp_register_script( $this->plugin_name . '_pet_inputs', 
            plugin_dir_url( __FILE__ ) . 'assets/js/pet_inputs.js', 
			array('jquery'), 
			$this->version, 
			false );

    }
    
     /**
	 * Register the shortcodes for the public area.
	 *
	 * @since    1.0.0
	 */

	public function register_shortcodes() { 

		$vendor_dashboard 	= new Tpc_Vendor_Dashboard($this->plugin_name);
		$search_dashboard 	= new Tpc_Search_Dashboard($this->plugin_name);
		$list_widget   		= new Tpc_List_Widget($this->plugin_name);

		$update_action = new Tpc_Update_Vendor_Info();

		add_shortcode('tpc_vendor_dashboard', array($vendor_dashboard, 'tpc_load_vendor_dashboard'));
		add_shortcode('tpc_search_dashboard', array($search_dashboard, 'tpc_load_search_dashboard'));
		add_shortcode('tpc_list_widget',   array($list_widget, 'load_view'));
		
	}
	
	/**
	 * Activate media uploader.
	 *
	 * @since    1.0.0
	 */

	public function enqueue_media_uploader() { 

		wp_enqueue_media();

	}

	/**
	 * Modify Dokan dashboard view.
	 *
	 * @since    1.0.0
	 */

	public function modify_dokan_dashboard( $urls ) { 

		unset( $urls['products'] );
		unset( $urls['settings']['sub']['seo'] );
		return $urls;

	}

	/**
	 * Add Dokan dashboard view.
	 *
	 * @since    1.0.0
	 */

	public function dokan_load_document_menu( $query_vars ) 
	{ 

		$query_vars['tpc_keeper_view'] = 'tpc_keeper_view';
		$query_vars['tpc_keeper_about'] = 'tpc_keeper_about';
		return $query_vars;

	}

	public function dokan_add_custom_menu( $urls ) 
	{ 

		$urls['tpc_keeper_view'] = array(
			'title'	=> __( 'Dirección', 'tpc' ),
			'icon'	=> '<i class="fa fa-building"></i>',
			'url'	=> dokan_get_navigation_url( 'tpc_keeper_view' ),
			'pos'	=> 10
		);
		$urls['tpc_keeper_about'] = array(
			'title'	=> __( 'Hogar', 'tpc' ),
			'icon'	=> '<i class="fa fa-home"></i>',
			'url'	=> dokan_get_navigation_url( 'tpc_keeper_about' ),
			'pos'	=> 11
		);

		return $urls;

	}

	public function dokan_load_template( $query_vars )
	{

		if( isset( $query_vars['tpc_keeper_view'] ) ) {

			wp_enqueue_script( $this->plugin_name . '_jquery_ajax' );
			wp_enqueue_script( $this->plugin_name . '_select2' );
			wp_enqueue_script( $this->plugin_name . '_tpc_update_keeper_address' );
			wp_enqueue_script( $this->plugin_name . '_smart_wizard' );
			wp_enqueue_script( $this->plugin_name . '_tpc_update_form_wizard' );

			wp_enqueue_style( $this->plugin_name . '_bootstrap_styles' );
			wp_enqueue_style( $this->plugin_name . '_form_styles' );
			wp_enqueue_style( $this->plugin_name . '_wizard_styles' );

			require_once TPC_PLUGIN_PATH . 'public/views/update_address.php';

		}

		if( isset( $query_vars['tpc_keeper_about'] ) ) {

			wp_enqueue_script( $this->plugin_name . '_jquery_ajax' );
			wp_enqueue_script( $this->plugin_name . '_tpc_update_keeper_home' );
			wp_enqueue_script( $this->plugin_name . '_smart_wizard' );
			wp_enqueue_script( $this->plugin_name . '_tpc_update_home_wizard' );

			wp_enqueue_style( $this->plugin_name . '_bootstrap_styles' );
			wp_enqueue_style( $this->plugin_name . '_form_styles' );
			wp_enqueue_style( $this->plugin_name . '_wizard_styles' );

			require_once TPC_PLUGIN_PATH . 'public/views/update_home.php';

		}

	}

	public function mail_test( $order, $sent_to_admin, $plain_text, $email )
	{

		if ( $email->id == 'customer_completed_order' ) {

			$current_order = new WC_Order( $order->id );
			$items = $current_order->get_items();

			foreach ( $items as $item ) {
				
				$product_factory = new WC_Product_Factory();
				$product_data = $item->get_data();
				$product_id = $product_data['product_id'];
				$product = $product_factory->get_product( $product_id );
				$class = get_class( $product );
				
				if( $class == 'WC_Product_Booking' ) {

					$author_id = get_post_field( 'post_author', $product_id );
					$keeper_post_id = get_user_meta( $author_id, 'kp_post_id', true );
					$street = get_post_meta( $keeper_post_id, 'kp_street', true );
					$zip_code = get_post_meta( $keeper_post_id, 'kp_zip', true );
					$colony = get_post_meta( $keeper_post_id, 'kp_colony', true );
					$home_phone = get_post_meta( $keeper_post_id, 'kp_home_phone', true );
					$cellphone = get_post_meta( $keeper_post_id, 'kp_cellphone', true );

					echo '<h2>Datos del cuidador</h2>';
					echo '<ul>';
					echo '<li>Calle: ' . $street . '</li>';
					echo '<li>Código postal: ' . $zip_code . '</li>';
					echo '<li>Colonia: ' . $colony . '</li>';
					echo '<li>Número de casa: ' . $home_phone . '</li>';
					echo '<li>Número de celular: ' .  $cellphone . '</li>';
					echo '</ul>';

				}

			}

		}

	}
}
