<?php
/*
*   Class to load the vendor dashboard
*
*/

require_once TPC_PLUGIN_PATH . 'includes/class_vk_dashboard.php';

if(!class_exists('Tpc_Vendor_Dashboard'))
{
    class Tpc_Vendor_Dashboard extends Vk_Dashboard
    {
        private $plugin_name;
        private $current_user_id;
        private $vendor_dashboard_action;
        private $user_can = 'seller';

        public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
            $this->current_user_id = get_current_user_id();
            $this->admin_dashboard_action = new Tpc_Vendor_Dashboard_Action();
        }

        public function tpc_load_vendor_dashboard()
        {
            try {

                $this->vk_check_permission($this->user_can);

            } catch (Exception $e) {

                exit();

            }

            $scripts = [
                '_jquery_ajax',
                '_popper',
                '_bootstrap',
                '_smart_wizard',
                '_validate',
                '_tpc_reg_form_wizard',
                '_tpc_custom_wizard_process',
                '_tpc_reg_keeper_address',
                '_tpc_reg_keeper_contact',
                '_tpc_reg_keeper_home',
                '_tpc_reg_keeper_services',
                '_tpc_wp_media_upload_image',
                '_select2'
            ];

            $styles = [
                '_bootstrap_styles',
                '_wizard_styles',
                '_form_styles',
                '_select2_styles'
            ];

            $this->vk_enqueue_styles( $this->plugin_name, $styles );
            $this->vk_enqueue_scripts( $this->plugin_name, $scripts );

            $user_obj = get_userdata( $this->current_user_id );
            $user_name = $user_obj->first_name . ' ' . $user_obj->last_name;

            $colonias = include TPC_PLUGIN_PATH . 'public/config/colonias.php';

            $dashboard_template = TPC_PLUGIN_PATH . 'public/views/vendor_dashboard.php';
            $dashboard_view     = $this->vk_load_view(  $dashboard_template, 
                                                        [
                                                            'user_name'=>$user_name,
                                                            'colonias'=>$colonias
                                                        ] 
                                                    );

            return $dashboard_view;
        }
    }
}
