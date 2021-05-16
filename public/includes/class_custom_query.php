<?php

if(!class_exists('Custom_Query'))
{
    class Custom_Query
    {
        function search( $query )
        {
            
            if( !is_post_type_archive( 'keeper' ) )
                return;

            $search_nonce = get_query_var( 'tpc_search_id' );
            
            if( empty( $search_nonce ) )
                return;

            if( !wp_verify_nonce( $search_nonce, 'search_for_keepers' ) )  
                return;  

            $services = array(
                'kp_lodging',
                'kp_day_care',
                'kp_hour_walk'
            );
        
            $meta_query = array();

            $service        = get_query_var( 'tpc_service', null );
            $dog            = get_query_var( 'tpc_dog', null );
            $cat            = get_query_var( 'tpc_cat', null );
            $other          = get_query_var( 'tpc_other', null );
            $small          = get_query_var( 'tpc_small', null );
            $medium_sized   = get_query_var( 'tpc_medium-sized', null );
            $big            = get_query_var( 'tpc_big', null );
            $extra_big      = get_query_var( 'tpc_extra-big', null );
            $region         = get_query_var( 'tpc_region', null );
        
            if( !empty( $service ) && in_array( $service, $services ) ){
                $meta_query[] = array( 'key'=>$service, 'compare'=>'EXISTS' );
            }

            if( $dog == 1 ){
                $meta_query[] = array( 'key'=>'kp_dog', 'compare'=>'EXISTS' );
            }
        
            if( $cat == 1 ){
                $meta_query[] = array( 'key'=>'kp_cat', 'compare'=>'EXISTS' );
            }

            if( $other == 1 ){
                $meta_query[] = array( 'key'=>'kp_other', 'compare'=>'EXISTS' );
            }

            if( $small == 1 ){
                $meta_query[] = array( 'key'=>'kp_small', 'compare'=>'EXISTS' );
            }

            if( $medium_sized == 1 ){
                $meta_query[] = array( 'key'=>'kp_medium_sized', 'compare'=>'EXISTS' );
            }

            if( $big == 1 ){
                $meta_query[] = array( 'key'=>'kp_big', 'compare'=>'EXISTS' );
            }

            if( $extra_big == 1 ){
                $meta_query[] = array( 'key'=>'kp_extra_big', 'compare'=>'EXISTS' );
            }

            if( !empty( $region ) ){
                $sanitized_region = sanitize_text_field( $region );
                $meta_query[] = array( 'key'=>'kp_colony', 'value'=>$sanitized_region, 'compare'=>'=', 'type'=>'CHAR'  );
            }
        
        
            if( count( $meta_query ) > 1 ){
              $meta_query['relation'] = 'AND';
            }
        
            if( count( $meta_query ) > 0 ){
              $query->set('meta_query', $meta_query);
            }
        }
    }
}