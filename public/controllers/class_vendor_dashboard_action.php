<?php
/*
*   This class manages ajax requests
*
*/

require_once TPC_PLUGIN_PATH . 'public/includes/class_vk_dashboard_action.php';
require_once TPC_PLUGIN_PATH . 'public/config/class_input_vars.php';

if(!class_exists('Tpc_Vendor_Dashboard_Action'))
{
    class Tpc_Vendor_Dashboard_Action extends Vk_Dashboard_Action
    {
        private $user_can = 'seller';
        private $input_vars;

        public function __construct()
        {
            add_action('wp_ajax_tpc_register_keeper_address', [$this, 'tpc_register_keeper_address']);
            add_action('wp_ajax_tpc_register_keeper_personal_info', [$this, 'tpc_register_keeper_personal_info']);
            add_action('wp_ajax_tpc_register_keeper_house_info', [$this, 'tpc_register_keeper_house_info']);
            add_action('wp_ajax_tpc_register_keeper_services', [$this, 'tpc_register_keeper_services']);

            parent::__construct();

            $this->input_vars =  new Tpc_Input_Vars();
        }

        public function tpc_register_keeper_address()
        {
            $this->vk_check_ajax(   'register_keeper_address', 
                                    'tpc_keeper_address_id', 
                                    $this->user_can);   

            $keeper_address = new vk_form_data\Data( new vk_form_data\input\Input );
            $keeper_address->set_options( $this->input_vars->address, 'post' );
            $keeper_addr_data = $keeper_address->get();
            $user_info = wp_get_current_user();
            $store_url = dokan_get_store_url( $user_info->ID );

            $postarr = [
                'post_title'    => $user_info->first_name . ' ' . $user_info->last_name,
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type'     => 'keeper',
                'meta_input'    =>  [
                                        'kp_street' => $keeper_addr_data['tpc_street'],
                                        'kp_zip'    => $keeper_addr_data['tpc_zip_code'],
                                        'kp_colony' => $keeper_addr_data['tpc_colony'],
                                        'kp_store_url' => $store_url
                                    ]
            ];

            $keeper_post = wp_insert_post( $postarr );

            if( $keeper_post == 0 ) {
                $result = false;
            } else {
                $keeper_post_data = [ 'kp_post_id' => $keeper_post ];
                $result = Vk_User_Meta::register_current_user_meta( $keeper_post_data );
            }

            $this->vk_send_result( $result );
        }
        

        public function tpc_register_keeper_personal_info()
        {
            $this->vk_check_ajax(   'register_keeper_personal_info', 
                                    'tpc_keeper_personal_info_id', 
                                    $this->user_can);   

            $keeper_pi = new vk_form_data\Data( new vk_form_data\input\Input );
            $keeper_pi->set_options( $this->input_vars->personal_info, 'post' );
            $keeper_pi_data = $keeper_pi->get();

            $occupation = array();

            foreach ($this->input_vars->occupation_keys as $occupation_key) {
                
                if( isset( $keeper_pi_data[ $occupation_key ] ) )
                    array_push( $occupation, $keeper_pi_data[ $occupation_key ] );

            }

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

            $post_data = [
                'kp_gender'         =>  $keeper_pi_data['tpc_gender'],
                'kp_birthdate'      =>  $keeper_pi_data['tpc_birthdate'],
                'kp_home_phone'     =>  $keeper_pi_data['tpc_home_phone'],
                'kp_cellphone'      =>  $keeper_pi_data['tpc_cellphone'],
                'kp_occupations'    =>  $occupation
            ];

            $result = Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );

            $this->vk_send_result( $result );
        }

        public function tpc_register_keeper_house_info()
        {
            $this->vk_check_ajax(   'register_keeper_home_info', 
                                    'tpc_keeper_house_id', 
                                    $this->user_can);   

            $keeper_house_info = new vk_form_data\Data( new vk_form_data\input\Input );
            $keeper_house_info->set_options( $this->input_vars->house_info, 'post' );
            $keeper_hi_data = $keeper_house_info->get();
            $free_spaces = array();

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

            if( isset( $keeper_hi_data['tpc_attachments'] ) ) {

                $attachments = json_decode($keeper_hi_data['tpc_attachments'],true);

                foreach ($attachments as $attachment) {

                    $args = get_post( $attachment, 'ARRAY_A' );
                    wp_insert_attachment( $args, null, $keeper_post_id );

                }

            }

            foreach ($this->input_vars->free_space_keys as $free_space_key) {
                
                if( isset( $keeper_hi_data[ $free_space_key ] ) )
                    array_push( $free_spaces, $keeper_hi_data[ $free_space_key ] );

            }

            $post_data = [
                'kp_house'          =>  $keeper_hi_data['tpc_home'],
                'kp_marital_status' =>  $keeper_hi_data['tpc_marital_status'],
                'kp_free_spaces'    =>  $free_spaces
            ];

            $result = Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );

            /*if( !$result )
                $this->vk_send_result( $result );*/

            /*if( isset( $keeper_hi_data['tpc_special_care'] ) )
                $post_data['kp_special_care'] = $keeper_hi_data['tpc_special_care'];*/

            /*if( isset( $keeper_hi_data['tpc_injection'] ) )
                $post_data['kp_injection'] = $keeper_hi_data['tpc_injection'];*/

            /*if( isset( $keeper_hi_data['tpc_kids'] ) )
                $post_data['kp_kids'] = $keeper_hi_data['tpc_kids'];

            if( isset( $keeper_hi_data['tpc_pets'] ) )
                $post_data['kp_pets'] = $keeper_hi_data['tpc_pets'];

            $result = Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );

            $post_data = null;

            $abilities = array();

            if( isset( $keeper_hi_data['tpc_special_care'] ) )
                array_push( $abilities, 'Cuidados especiales' );

            if( isset( $keeper_hi_data['tpc_injection'] ) )
                array_push( $abilities, 'Aplicación de injecciones' );

            $post_data = [ 'kp_abilities' => $abilities ];

            $result = Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );*/

            $this->vk_send_result( $result );
        }

        public function tpc_register_keeper_services()
        {
            $this->vk_check_ajax( 'register_keeper_services', 'tpc_keeper_services_id', $this->user_can);   

            $info = [
                        [
                            'input_name' => 'tpc_lodging', 
                            'type' => 'string', 
                            'min' => 4
                        ],
                        [
                            'input_name' => 'tpc_day_care', 
                            'type' => 'string', 
                            'min' => 4
                        ],
                        [
                            'input_name' => 'tpc_hour_walk', 
                            'type' => 'string', 
                            'min' => 4
                        ],
                        /*[
                            'input_name' => 'tpc_half_walk', 
                            'type' => 'string', 
                            'min' => 4
                        ],*/
                        [
                            'input_name' => 'tpc_description', 
                            'type' => 'string', 
                            'min' => 10,
                            'max' => 250
                        ],
                        [
                            'input_name' => 'tpc_thumbnail', 
                            'type' => 'numeric', 
                            'min' => 1,
                            'max' => 30
                        ],
                        [
                            'input_name' => 'tpc_dog', 
                            'type' => 'string', 
                            'min' => 4
                        ],
                        [
                            'input_name' => 'tpc_cat', 
                            'type' => 'string', 
                            'min' => 4
                        ]
                    ];

            $keeper_services = new Vk_Form_Data( $info );
            $keeper_serv_data = $keeper_services->get_data();

            $products = array();

            foreach ( $keeper_serv_data as $key => $value ) {
                
                if( $key != 'tpc_dog' && 
                    $key != 'tpc_cat' && 
                    $key != 'tpc_description' &&
                    $key != 'tpc_thumbnail'
                )
                    $products[$key] = $value;

            }

            $this->tpc_register_products( $products );

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

            $post_data = array();

            if( isset( $keeper_serv_data['tpc_lodging'] ) )
                $post_data['kp_lodging'] = $keeper_serv_data['tpc_lodging'];

            if( isset( $keeper_serv_data['tpc_day_care'] ) )
                $post_data['kp_day_care'] = $keeper_serv_data['tpc_day_care'];

            if( isset( $keeper_serv_data['tpc_hour_walk'] ) )
                $post_data['kp_hour_walk'] = $keeper_serv_data['tpc_hour_walk'];

            /*if( isset( $keeper_serv_data['tpc_half_walk'] ) )
                $post_data['kp_half_walk'] = $keeper_serv_data['tpc_half_walk'];*/

            if( isset( $keeper_serv_data['tpc_dog'] ) )
                $post_data['kp_dog'] = $keeper_serv_data['tpc_dog'];
            
            if( isset( $keeper_serv_data['tpc_cat'] ) )
                $post_data['kp_cat'] = $keeper_serv_data['tpc_cat'];

            if( isset( $keeper_serv_data['tpc_thumbnail'] ) )
                $thumbnail_id = $keeper_serv_data['tpc_thumbnail'];

            Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );

            $postarr = [
                'ID'    => $keeper_post_id,
                'post_content' => $keeper_serv_data['tpc_description']
            ];
    
            wp_update_post( $postarr );
            set_post_thumbnail( $keeper_post_id, $thumbnail_id );

            $meta = [
                'tpc_vendor_registration' => true
            ];

            $result = Vk_User_Meta::register_current_user_meta( $meta );

            $this->vk_send_result( $result );
        }

        private function tpc_register_products( $services )
        {
            $user_id = get_current_user_id();
            $service_name = '';
            $service_id = 0;

            foreach ($services as $key => $value) {

                switch ($key) {
                    case 'tpc_lodging':
                        $service_id = 729;
                        $service_name = 'Alojamiento';
                    break;

                    case 'tpc_day_care':
                        $service_id = 731;
                        $service_name = 'Guardería';
                    break;

                    case 'tpc_hour_walk':
                        $service_id = 730;
                        $service_name = 'Paseo de una hora para perro.';
                    break;

                    /*case 'tpc_half_walk':
                        $service_id = 883;
                        $service_name = 'Paseo de media hora para perro.';
                    break;*/
                    
                    default:
                        throw new Exception(
                            'TPC service registration price error.' , 
                            1
                        );
                    break;
                }

                $product = WC_Admin_Duplicate_Product::product_duplicate( wc_get_product( $service_id ) );

                $post_id = $product->get_id();

                $product_name = [
                    'ID' => $post_id,
                    'post_title' => $user_id . ' ' . $service_name,
                    'post_name' => $service_name . '-' . $user_id,
                    'post_status' => 'publish'
                ];

                wp_update_post( $product_name );
            }

            return;

            /*$post_id = wp_insert_post( array(
                'post_title' => 'Bartosz\'s product',
                'post_content' => 'Product for Bartosz and Torvi.',
                'post_status' => 'publish',
                'post_type' => 'product',
                'meta_input' => array( 
                                        '_price' => '180',
                                        '_virtual' => 'yes',
                                        '_downloadable' => 'no',
                                        '_wc_booking_duration_unit' => 'hour',
                                        '_wc_booking_duration' => '1',
                                        '_wc_booking_block_cost' => '180',
                                        '_wc_booking_max_duration' => '2',
                                    )
                ) 
            );

            wp_set_object_terms( $post_id, 'booking', 'product_type' );*/
            //set_post_thumbnail( $post_id,  );

        }
    }
}
