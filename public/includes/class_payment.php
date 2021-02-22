<?php

if(!class_exists('Tpc_Payment'))
{
    class Tpc_Payment
    {
       function register_payment( $order_id )
       {
            $order = wc_get_order( $order_id );
            $items = $order->get_items();
        
            if( count( $items ) != 1 )
                return;

            $item = reset( $items );

            $product_id = $item->get_product_id();

            if( $product_id != 1464 )
                return;

            $dumb = 1+1;
       }
    }
}
