<?php
/*
*   Class to load the vendor dashboard
*
*/

require_once TPC_PLUGIN_PATH . 'public/includes/class_vk_dashboard.php';

if(!class_exists('Tpc_List_Widget'))
{
    class Tpc_List_Widget extends Vk_Dashboard
    {
        private $plugin_name;

        public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
        }

        public function load_view( $atts = [], $content = null, $tag = '' )
        {

            $styles = [
                '_fontawesome',
                '_fontawesome_solid'
            ];

            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            $list_atts = shortcode_atts(
                array(
                    'title' => 'Título de la lista',
                    'post_meta_key' => 'default'
                ), $atts, $tag
            );

            $list_items = array();

            if( $list_atts['post_meta_key'] === 'default' ) {

                $list_items = ['Elemento 1', 'Elemento 2', 'Elemento 3'];

            } else {

                $keeper = get_post();

                $list_items = get_post_meta( $keeper->ID, $list_atts['post_meta_key'], true );

            }

            $this->vk_enqueue_styles( $this->plugin_name, $styles );

            $dashboard_template = TPC_PLUGIN_PATH . 'public/views/list_widget.php';
            $dashboard_view     = $this->vk_load_view( $dashboard_template, 
                                                       [
                                                            'list_items'=>$list_items, 
                                                            'list_title'=>$list_atts['title']
                                                       ] 
                                                        );

            return $dashboard_view;
        }
    }
}
