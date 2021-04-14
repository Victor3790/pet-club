<?php
/*
*   Class to load the vendor dashboard
*
*/

require_once TPC_PLUGIN_PATH . 'includes/class_vk_dashboard.php';

if(!class_exists('Tpc_Search_Dashboard'))
{
    class Tpc_Search_Dashboard extends Vk_Dashboard
    {
        private $plugin_name;
        //private $current_user_id;
        private $search_dashboard_action;
        //private $user_can = 'vendor';

        public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
            //$this->current_user_id = get_current_user_id();
            //$this->admin_dashboard_action = new Tpc_Search_Dashboard_Action();
        }

        public function tpc_load_search_dashboard()
        {
            //$this->vk_check_permission($this->user_can);

            $scripts = [
                /*'_google_maps',
                '_tpc_map',*/
                '_tpc_search_controls',
                '_select2'
            ];

            $styles = [
                '_bootstrap_styles',
                '_fontawesome',
                '_fontawesome_solid',
                '_form_styles',
                '_search',
                '_select2_styles'
            ];

            $this->vk_enqueue_styles( $this->plugin_name, $styles );
            $this->vk_enqueue_scripts( $this->plugin_name, $scripts );

            $colonias = include TPC_PLUGIN_PATH . 'public/config/colonias.php';

            $dashboard_template = TPC_PLUGIN_PATH . 'public/views/search_dashboard.php';
            $dashboard_view     = $this->vk_load_view( $dashboard_template, ['colonias'=>$colonias] );

            return $dashboard_view;
        }
    }
}
