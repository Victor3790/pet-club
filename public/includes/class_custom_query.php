<?php

if(!class_exists('Custom_Query'))
{
    class Custom_Query
    {
        function search( $query )
        {
        
            if( is_admin() || !$query->is_main_query() )
                return;
            
            if( !is_post_type_archive( 'keeper' ) )
                return;

            $search_nonce = get_query_var( 'search_id' );
            
            if( empty( $search_nonce ) )
                return;

            if( !wp_verify_nonce( $search_nonce, 'search_for_keepers' ) )  
                return;  
        
            $meta_query = array();

            $service = get_query_var( 'service', null );
        
            if( !empty( $service ) ){
                $meta_query[] = array( 'key'=>$service, 'value'=>'true', 'compare'=>'=', 'type'=>'CHAR'  );
            }
        
        
          /*if( isset( $precio ) ){
            $precio_from      = get_query_var( 'precio' );
            $precio_to        = $precio_from + 100000;
            if($precio_from == 500000){
              $meta_query[] = array( 'key'=>'precio_data', 'value'=>$precio_from, 'compare'=>'>=', 'type'=>'NUMERIC'  );
            }else{
              $meta_query[] = array( 'key'=>'precio_data', 'value'=>array($precio_from, $precio_to), 'compare'=>'BETWEEN', 'type'=>'NUMERIC'  );
            }
          }
        
          if( count( $meta_query ) > 1 ){
            $meta_query['relation'] = 'AND';
            $meta_query['orderby']  = array('precio_data'=>'DESC');
          }
        
          if( count( $meta_query ) > 0 ){
            $query->set('meta_query', $meta_query);
          }*/
        }
    }
}