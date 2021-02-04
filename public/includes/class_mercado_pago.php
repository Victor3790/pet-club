<?php
/*
*   Class to handle responses from mercado pago
*
*/

if(!class_exists('Tpc_Mercado_Pago'))
{
    class Tpc_Mercado_Pago
    {
        function register_route()
        {
            register_rest_route( 'tpc/v1', '/subscription', array(
                'methods' => WP_REST_SERVER::CREATABLE,
                'permission_callback' => array( $this, 'check_permission' ),
                'callback' => array( $this, 'get_response' )
              ) 
            );
        }

        public function check_permission()
        {
            status_header( 201 );
            return true;
        }

        public function get_response( $json )
        {
            $json_body = $json->get_body();
            $body = json_decode( $json_body, true );

            $this->to_file( $body, 'Printing... ' );

            /*if( $body['type'] === 'payment' &&  $body['action'] === 'payment.created' ) {

                $this->to_file( $body, 'First attempt... ' );

                $curl_handler = curl_init( 'https://api.mercadopago.com/v1/payments/' . $body['data']['id'] );

                curl_setopt( $curl_handler, CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $curl_handler, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt( $curl_handler, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
                curl_setopt( $curl_handler, CURLOPT_XOAUTH2_BEARER, 
                'TEST-5405902477656417-122921-dba0b225aeb1405f5d82a2c5fe872098-172563922' );

                $payment = curl_exec( $curl_handler );
                curl_close( $curl_handler );

                $this->to_file( $payment, 'Payment confirmation... ' );

            }*/

        }

        private function to_file( $print = null, $marker = 'Response begins ... ' )
        {
            $fichero = dirname(__FILE__) . '/payments.txt';
            $response .= $marker;

            if( is_string( $print ) )
                $response .= $print;
            else
                $response .= print_r($print, true);

            file_put_contents($fichero, $response, FILE_APPEND);

            return;
        }
    }
}
