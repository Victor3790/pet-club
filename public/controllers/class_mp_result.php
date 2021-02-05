<?php
/*
*   Class to load the success or failure page
*
*/

require_once TPC_PLUGIN_PATH . 'public/includes/class_vk_dashboard.php';

if(!class_exists('Tpc_MP_Result'))
{
    class Tpc_MP_Result extends Vk_Dashboard
    {
        private $plugin_name;

        public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
        }

        public function success_page()
        {
            try {

                $this->get_payment();

                $dashboard_template = TPC_PLUGIN_PATH . 'public/views/mp_success.php';

                $dashboard_view = $this->vk_load_view( $dashboard_template );

                return $dashboard_view;

            } catch (\Throwable $th) {
                
                $dashboard_template = TPC_PLUGIN_PATH . 'public/views/mp_error.php';

                $dashboard_view = $this->vk_load_view( $dashboard_template, 
                                    ['error_message' => $th->getCode()]
                                );

                return $dashboard_view;

            }

        }

        public function failure_page()
        {
            try {

                $this->check_subscription_status();

                $dashboard_template = TPC_PLUGIN_PATH . 'public/views/mp_failure.php';

                $dashboard_view = $this->vk_load_view( $dashboard_template );

                return $dashboard_view;

            } catch (\Throwable $th) {
                
                $dashboard_template = TPC_PLUGIN_PATH . 'public/views/mp_error.php';

                $dashboard_view = $this->vk_load_view( $dashboard_template, 
                                    ['error_message' => $th->getCode()]
                                );

                return $dashboard_view;

            }
        }

        private function get_payment()
        {   
            if( !isset( $_GET['payment_id'] ) )
                throw new Exception("Id not set", 101);

            if( empty( $_GET['payment_id'] ) )
                throw new Exception("Id is empty", 102);

            if( !is_numeric( $_GET['payment_id'] ) )
                throw new Exception("Id is not numeric", 103);

            $this->check_subscription_status();

            $payment_id = sanitize_text_field( $_GET['payment_id'] );

            $payment = wp_remote_get('https://api.mercadopago.com/v1/payments/' . $payment_id,
                [
                    'headers' => [
                        'authorization' => 'Bearer ' . TPC_MP_ACCESS_TOKEN
                    ]
                ]
            );

            $response = $payment['response']['code'];

            if( $response !== 200 )
                throw new Exception("Payment error", 105);

            $payment_body = json_decode( $payment['body'], true );

            $status = $payment_body['status'];

            if( !isset( $payment_body['status'] ) || $payment_body['status'] !== 'approved' )
                throw new Exception("Payment not approved", 106);

            return;
                
        }

        private function check_subscription_status()
        {
            $user_id = get_current_user_id();
            $subscription = get_user_meta( $user_id, 'tpc_vendor_subscription', true );

            if( empty( $subscription ) || $subscription['status'] !== 101 )
                throw new Exception("Not waiting for payment", 104);
            
            return;
        }
    }
}
