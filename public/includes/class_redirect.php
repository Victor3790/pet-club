<?php

if(!class_exists('Tpc_Redirect'))
{
    class Tpc_Redirect
    {
        public function check_registration() { 

            if( is_page( 'dashboard' ) ){
    
                $this->check_login();
    
                $complete_reg = $this->check_complete_form();
    
                if( empty($complete_reg) || (bool)$complete_reg !== true ){
                    wp_safe_redirect( home_url('/tpc_vendor_registration') );
                    exit();
                }

                $paid_membership = $this->check_membership();

                if( $paid_membership !== true ){
                    wp_safe_redirect( home_url('/payment') );
                    exit();
                }

            }
    
            if( is_page( 'tpc_vendor_registration' ) ){
    
                $this->check_login();
    
                $complete_reg = $this->check_complete_form();
                
                if( (bool)$complete_reg === true ){
                    wp_safe_redirect( home_url('/dashboard') );
                    exit();
                }
    
            }
    
            if( is_page( 'success' ) || is_page( 'failure' ) ) {
    
                $this->check_login();

            }

            if( is_page( 'payment' ) ) {

                $user_id = get_current_user_id();
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

        private function check_complete_form()
        {
            $user_id = get_current_user_id();
            $complete_reg = get_user_meta( $user_id, 'tpc_vendor_registration', true );

            return $complete_reg;
        }

        private function check_membership()
        {
            $user_id = get_current_user_id();
            $paid_membership = get_user_meta( $user_id, 'tpc_vendor_subscription', true );

            if( (int)$paid_membership['status'] === 103 )
                return true;
            else
                return false;
        }
    }
}