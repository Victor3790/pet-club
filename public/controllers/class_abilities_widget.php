<?php
/*
*   Class to load the vendor dashboard
*
*/

require_once TPC_PLUGIN_PATH . 'public/includes/class_vk_dashboard.php';

if(!class_exists('Tpc_Abilities_Widget'))
{
    class Tpc_Abilities_Widget extends Vk_Dashboard
    {
        private $plugin_name;
        private $search_dashboard_action;

        public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
        }

        public function load_view()
        {

            $styles = [
                '_fontawesome',
                '_fontawesome_solid'
            ];

            $keeper = get_post();

            $abilities = get_post_meta( $keeper->ID, 'kp_abilities', true );

            $this->vk_enqueue_styles( $this->plugin_name, $styles );

            $dashboard_template = TPC_PLUGIN_PATH . 'public/views/abilities_widget.php';
            $dashboard_view     = $this->vk_load_view( $dashboard_template, ['abilities'=>$abilities] );

            return $dashboard_view;
        }
    }
}
