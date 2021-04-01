<?php
/*
* Capabilities config object.
*/
class Tpc_Capabilities {

    private $capabilities = array(
        'publish_products',
        'edit_products',
        'delete_product',
        'dokan_add_booking_product',
        'dokan_add_product',
        'dokan_delete_booking_product',
        'dokan_delete_product',
        'dokan_duplicate_product',
        'dokan_edit_booking_product',
        'dokan_edit_product',
    );

    public function get()
    {
        return $this->capabilities;
    }

}