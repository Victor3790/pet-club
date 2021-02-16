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
        //private $plugin_name;
        private $user_can = 'seller';

        /*public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
        }*/

        public function success_page()
        {
            $this->vk_check_permission($this->user_can);

            try {

                $this->get_payment();

                $today_object = new DateTime('now', new DateTimeZone('America/Mazatlan'));
                $today = $today_object->format('Y-m-d');

                $one_month = new DateInterval('P1M');
                $today_object->add($one_month);
                $payment_due = $today_object->format('Y-m-d');

                $registered = [
                    'tpc_vendor_subscription' => ['status' => 103, 'message' => 'Paid'],
                    'tpc_payment_date' => [
                            'last' => $today, 
                            'due' => $payment_due,
                        ]
                ];
    
                $result = Vk_User_Meta::register_current_user_meta( $registered );

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
            $this->vk_check_permission($this->user_can);

            try {

                $this->check_subscription_status();

                $registered = [
                    'tpc_vendor_subscription' => ['status' => 101, 'message' => 'waiting']
                ];
    
                $result = Vk_User_Meta::register_current_user_meta( $registered );

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

            if( empty( $subscription ) || $subscription['status'] !== 102 )
                throw new Exception("Not a pending payment", 104);
            
            return;
        }
    }
}
