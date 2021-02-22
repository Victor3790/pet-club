<?php
/*
*   Class to load the options dashboard
*
*/

require_once TPC_PLUGIN_PATH . 'includes/class_vk_dashboard.php';

if(!class_exists('Tpc_Options_Dashboard'))
{
    class Tpc_Options_Dashboard extends Vk_Dashboard
    {
        private $plugin_name;

        public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
        }

        public function load()
        {

            $dashboard_template = TPC_PLUGIN_PATH . 'admin/views/options_dashboard.php';
            $dashboard_view     = $this->vk_load_view( $dashboard_template );

            echo $dashboard_view;
        }
    }
}
