<?php
/*
*   Class to load the vendor dashboard
*
*/

require_once TPC_PLUGIN_PATH . 'public/includes/class_vk_dashboard.php';

// SDK de Mercado Pago
require_once TPC_PLUGIN_PATH .  'vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken(TPC_MP_ACCESS_TOKEN);

if(!class_exists('Tpc_Payment_Dashboard'))
{
    class Tpc_Payment_Dashboard extends Vk_Dashboard
    {
        private $plugin_name;
        //private $current_user_id;
        //private $vendor_dashboard_action;
        private $user_can = 'seller';

        public function __construct($plugin_name_param)
        {
            $this->plugin_name = $plugin_name_param;
            //$this->current_user_id = get_current_user_id();
            //$this->admin_dashboard_action = new Tpc_Vendor_Dashboard_Action();
        }

        public function tpc_load_payment_dashboard()
        {
            try {

                $this->check_subscription_status();

                $dashboard_template = TPC_PLUGIN_PATH . 'public/views/mp_payment.php';

                $preference = $this->get_preference();

                $dashboard_view = $this->vk_load_view( $dashboard_template,
                                    ['preference' => $preference]
                                );

                return $dashboard_view;

            } catch (\Throwable $th) {
                
                $dashboard_template = TPC_PLUGIN_PATH . 'public/views/mp_error.php';

                $dashboard_view = $this->vk_load_view( $dashboard_template, 
                                    ['error_message' => $th->getCode()]
                                );

                return $dashboard_view;

            }
        }

        private function check_subscription_status()
        {
            /*$user_id = get_current_user_id();
            $subscription = get_user_meta( $user_id, 'tpc_vendor_subscription', true );

            if( empty( $subscription ) || $subscription['status'] !== 101 )
                throw new Exception("Not waiting for payment", 111);*/
            
            return;
        }

        private function get_preference()
        {
            $preference = new MercadoPago\Preference();

            $item = new MercadoPago\Item();
            $item->title = 'Mi producto';
            $item->quantity = 1;
            $item->unit_price = 75.56;
            //$preference->notification_url = get_rest_url(null, 'tpc/v1/subscription?source_news=webhooks');
            $preference->back_urls = array( 
                        'success' => home_url('success'),
                        'failure' => home_url('failure')
                    );
            $preference->external_reference = get_current_user_id();
            $preference->items = array($item);
            $preference->save();

            return $preference;
        }
    }
}
