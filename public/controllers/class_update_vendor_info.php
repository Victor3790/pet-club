<?php
/*
*   This class manages ajax requests
*
*/

require_once TPC_PLUGIN_PATH . 'includes/class_vk_dashboard_action.php';
require_once TPC_PLUGIN_PATH . 'public/config/class_input_vars.php';

if(!class_exists('Tpc_Update_Vendor_Info'))
{
    class Tpc_Update_Vendor_Info extends Vk_Dashboard_Action
    {
        private $user_can = 'seller';
        private $input_vars;

        public function __construct()
        {
            add_action('wp_ajax_tpc_update_keeper_address', [$this, 'tpc_update_keeper_address']);
            add_action('wp_ajax_tpc_update_keeper_house_info', [$this, 'tpc_update_keeper_house_info']);

            parent::__construct();

            $this->input_vars =  new Tpc_Input_Vars();
        }

        public function tpc_update_keeper_address()
        {
            $this->vk_check_ajax(   'register_keeper_address', 
                                    'tpc_keeper_address_id', 
                                    $this->user_can);   

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

            $keeper_address = new vk_form_data\Data( new vk_form_data\input\Input );
            $keeper_address->set_options( $this->input_vars->address, 'post' );
            $keeper_addr_data = $keeper_address->get();

            $post_data = [
                'kp_street' => $keeper_addr_data['tpc_street'],
                'kp_zip'    => $keeper_addr_data['tpc_zip_code']
            ];

            if( isset( $keeper_addr_data['tpc_colony'] ) )
                $post_data = [ 'kp_colony' => $keeper_addr_data['tpc_colony'] ];

            $result = Vk_Post_Meta::register_meta( $keeper_post_id, $post_data );

            $this->vk_send_result( $result );
        }

        public function tpc_update_keeper_house_info()
        {
            $this->vk_check_ajax(   'update_keeper_home_info', 
                                    'tpc_keeper_house_id', 
                                    $this->user_can);   

            $keeper_house_info = new vk_form_data\Data( new vk_form_data\input\Input );
            $keeper_house_info->set_options( $this->input_vars->update_house_info, 'post' );
            $keeper_hi_data = $keeper_house_info->get();

            $user_id = get_current_user_id();
            $keeper_post_id = get_user_meta( $user_id, 'kp_post_id', true );

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
    }
}
