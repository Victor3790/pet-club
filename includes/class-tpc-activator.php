<?php

/**
 * Fired during plugin activation
 *
 * @link       victorcrespo.net
 * @since      1.0.0
 *
 * @package    Tpc
 * @subpackage Tpc/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tpc
 * @subpackage Tpc/includes
 * @author     Víctor Crespo <victor182@msn.com>
 */

include_once 'class_tpc_capabilities.php';

class Tpc_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		$seller_role = get_role( 'seller' );

		if( empty( $seller_role ) )
			throw new Exception("El perfil 'seller' no existe", 1);

		$cap_obj = new Tpc_Capabilities();
		$caps = $cap_obj->get();

		foreach ( $caps as $cap ) {

			$seller_role->remove_cap( $cap );

		}

		flush_rewrite_rules();
	}

}
