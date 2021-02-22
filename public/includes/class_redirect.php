<?php

if(!class_exists('Tpc_Redirect'))
{
    class Tpc_Redirect
    {
        public function check_registration() { 

            $user_id = get_current_user_id();

            if( is_page( 'dashboard' ) ){
    
                $this->check_login();
    
                $complete_reg = $this->check_complete_form( $user_id );
    
                if( empty($complete_reg) || (bool)$complete_reg !== true ){
                    wp_safe_redirect( home_url('/tpc_vendor_registration') );
                    exit();
                }

                $payment_due_date = new DateTime(
                    $this->get_payment_due_date( $user_id ), 
                    new DateTimeZone('America/Mazatlan')
                );
                $today = new DateTime('now', new DateTimeZone('America/Mazatlan'));

                if( $payment_due_date < $today ) {
                    $registered = [
                        'tpc_vendor_subscription' => ['status' => 101, 'message' => 'Pending'],
                    ];
        
                    Vk_User_Meta::register_current_user_meta( $registered );
                }

                $paid_membership = $this->check_membership( $user_id );

                if( $paid_membership !== true ) {

                    $options = get_option( 'tpc_settings' );
                    $subscription_id = $options['tpc_subscription_id'];

                    WC()->cart->empty_cart();
                    WC()->cart->add_to_cart( $subscription_id ); 
                    wp_safe_redirect( wc_get_checkout_url() );
                    exit();
                    
                }

            }
    
            if( is_page( 'tpc_vendor_registration' ) ){
    
                $this->check_login();
    
                $complete_reg = $this->check_complete_form( $user_id );
                
                if( (bool)$complete_reg === true ){
                    wp_safe_redirect( home_url('/dashboard') );
                    exit();
                }
    
            }
    
            if( is_page( 'success' ) || is_page( 'failure' ) ) {
    
                $this->check_login();

            }

            if( is_page( 'payment' ) ) {

                $subscription_status = get_user_meta( $user_id, 'tpc_vendor_subscription', true );

                if( (int)$subscription_status['status'] === 102 ) {

                    $registered = [
                        'tpc_vendor_subscription' => ['status' => 101, 'message' => 'Pending']
                    ];
        
                    $result = Vk_User_Meta::register_current_user_meta( $registered );
                }

            }
    
            return;
    
        }

        private function check_login()
        {
            if( !is_user_logged_in() ) {
                wp_safe_redirect( home_url() );
                exit();
            }
        }

        private function check_complete_form( $user_id )
        {
            $complete_reg = get_user_meta( $user_id, 'tpc_vendor_registration', true );

            return $complete_reg;
        }

        private function check_membership( $user_id )
        {
            $paid_membership = get_user_meta( $user_id, 'tpc_vendor_subscription', true );

            if( (int)$paid_membership['status'] === 103 )
                return true;
            else
                return false;
        }

        private function get_payment_due_date( $user_id )
        {
            $payment_date = get_user_meta( $user_id, 'tpc_payment_date', true );

            return $payment_date['due'];
        }
    }
}
