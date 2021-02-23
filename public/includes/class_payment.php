<?php

if(!class_exists('Tpc_Payment'))
{
    class Tpc_Payment
    {
       function register_payment( $order_id )
       {
            if( !$this->is_subscription( $order_id ) )
                return;

            $today = new DateTime('now', new DateTimeZone('America/Mazatlan'));
            $payment_date = $today->format('Y-m-d');
            $month_period = new DateInterval('P1M');
            $due_date = $today->add( $month_period )->format('Y-m-d');

            $payment_info = [
                'tpc_vendor_subscription' => ['status' => 103, 'message' => 'Paid'],
                'tpc_payment_date' => ['last' => $payment_date, 'due' => $due_date]
            ];
    
            Vk_User_Meta::register_current_user_meta( $payment_info );
       }

       function change_thank_you()
       {
            $order_id = wc_get_order_id_by_order_key( $_GET['key'] );

            if( !$this->is_subscription( $order_id ) )
                return;

            echo (  '<a href="' . 
                    home_url('dashboard') . 
                    '" style="font-size:18px;"' .
                    ' class="button" ' .
                    '>Ir a mi dashboard</a>'
                );
       }

       private function is_subscription( $order_id )
       {
            $order = wc_get_order( $order_id );
            $items = $order->get_items();
        
            if( count( $items ) != 1 )
                return false;

            $item = reset( $items );

            $product_id = $item->get_product_id();

            $options = get_option( 'tpc_settings' );
            $subscription_id = $options['tpc_subscription_id'];

            if( $product_id != $subscription_id )
                return false;

            return true;
       }
    }
}
