<?php
/*
*   This class manages ajax requests
*
*/

require_once TPC_PLUGIN_PATH . 'includes/class_vk_dashboard_action.php';
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

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

            $post_data = [
                'kp_gender'         =>  $keeper_pi_data['tpc_gender'],
                'kp_marital_status' =>  $keeper_pi_data['tpc_marital_status'],
                'kp_occupations'    =>  $keeper_pi_data['tpc_occupation'],
                'kp_birthdate'      =>  $keeper_pi_data['tpc_birthdate'],
                'kp_home_phone'     =>  $keeper_pi_data['tpc_home_phone'],
                'kp_cellphone'      =>  $keeper_pi_data['tpc_cellphone'],
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

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

            if( isset( $keeper_hi_data['tpc_attachments'] ) ) {

                $attachments = json_decode($keeper_hi_data['tpc_attachments'],true);

                foreach ($attachments as $attachment) {

                    $args = get_post( $attachment, 'ARRAY_A' );
                    wp_insert_attachment( $args, null, $keeper_post_id );

                }

            }

            $post_data = [
                'kp_house'          =>  $keeper_hi_data['tpc_home'],
                'kp_free_spaces'    =>  $keeper_hi_data['tpc_free_spaces'],
                'kp_kids'           =>  $keeper_hi_data['tpc_kids'],
                'kp_pets'           =>  $keeper_hi_data['tpc_pets'],
                'kp_furniture'      =>  $keeper_hi_data['tpc_furniture'],
                'kp_smoking'        =>  $keeper_hi_data['tpc_smoking']
            ];

            $result = Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );

            $this->vk_send_result( $result );
        }

        public function tpc_register_keeper_services()
        {
            $this->vk_check_ajax(   'register_keeper_services', 
                                    'tpc_keeper_services_id', 
                                    $this->user_can);   

            $keeper_services_info = new vk_form_data\Data( new vk_form_data\input\Input );
            $keeper_services_info->set_options( $this->input_vars->service_info, 'post' );
            $keeper_services_data = $keeper_services_info->get();

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

            $services = $keeper_services_data['tpc_service'];

            $this->create_products( $services );

            $this->register_split_data( $keeper_post_id, $services );

            $pets = $keeper_services_data['tpc_pet_client'];

            $this->register_split_data( $keeper_post_id, $pets );

            $post_data = [
                'kp_experience'     => $keeper_services_data['tpc_experience'],
                'kp_abilities'      => $keeper_services_data['tpc_abilities']
            ];

            $result = Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );

            $post_content = [
                'ID'    => $keeper_post_id,
                'post_content' => $keeper_services_data['tpc_description']
            ];

            $thumbnail_id = $keeper_services_data['tpc_thumbnail'];
    
            wp_update_post( $post_content );
            set_post_thumbnail( $keeper_post_id, $thumbnail_id );

            $registered = [
                'tpc_vendor_registration' => true,
                'tpc_vendor_subscription' => ['status' => 101, 'message' => 'Pending']
            ];

            $result = Vk_User_Meta::register_current_user_meta( $registered );

            $this->vk_send_result( $result );
        }

        private function register_split_data( $post_id, $data )
        {
            $post_keys = str_replace( 'tpc', 'kp', $data ); 
            $post_data = array();

            foreach ( $post_keys as $key ) {
                
                $post_data[$key] = true;

            }

            Vk_Post_Meta::register_meta( $post_id, $post_data );
        }

        private function create_products( $services )
        {
            $user_id = get_current_user_id();
            $service_name = '';
            $service_id = 0;
            $options = get_option( 'tpc_settings' );

            foreach ($services as $service) {

                switch ($service) {
                    case 'tpc_lodging':
                        $service_id = $options['tpc_lodging_id'];
                        $service_name = 'Alojamiento';
                    break;

                    case 'tpc_day_care':
                        $service_id = $options['tpc_day_care_id'];
                        $service_name = 'Guardería';
                    break;

                    case 'tpc_walk':
                        $service_id = $options['tpc_walk_id'];
                        $service_name = 'Paseo de una hora para perro.';
                    break;
                    
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
