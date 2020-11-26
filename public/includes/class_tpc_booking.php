<?php

if ( version_compare( WC_VERSION, '3.0', '<' ) ) {
	class WC_Product_Booking_Compatibility extends Legacy_WC_Product_Booking {}
} else {
	class WC_Product_Booking_Compatibility extends WC_Product {}
}

class TPC_Product_Booking extends WC_Product_Booking_Compatibility
{
	/**
	 * Stores product data.
	 *
	 * @var array
	 */
	protected $defaults = array(
		'apply_adjacent_buffer'      => false,
		'availability'               => array(),
		'block_cost'                 => 0,
		'buffer_period'              => 0,
		'calendar_display_mode'      => 'always_visible',
		'cancel_limit_unit'          => 'month',
		'cancel_limit'               => 1,
		'check_start_block_only'     => false,
		'cost'                       => 0,
		'default_date_availability'  => '',
		'display_cost'               => '',
		'duration_type'              => 'fixed',
		'duration_unit'              => 'day',
		'duration'                   => 1,
		'enable_range_picker'        => false,
		'first_block_time'           => '',
		'has_person_cost_multiplier' => false,
		'has_person_qty_multiplier'  => false,
		'has_person_types'           => false,
		'has_persons'                => false,
		'has_resources'              => false,
		'has_restricted_days'        => false,
		'max_date_unit'              => 'month',
		'max_date_value'             => 12,
		'max_duration'               => 1,
		'max_persons'                => 1,
		'min_date_unit'              => 'day',
		'min_date_value'             => 0,
		'min_duration'               => 1,
		'min_persons'                => 1,
		'person_types'               => array(),
		'pricing'                    => array(),
		'qty'                        => 1,
		'requires_confirmation'      => false,
		'resource_label'              => '',
		'resource_base_costs'        => array(),
		'resource_block_costs'       => array(),
		'resource_ids'               => array(),
		'resources_assignment'       => '',
		'restricted_days'            => '',
		'user_can_cancel'            => false,
	);

	/**
	 * Stores availability rules once loaded.
	 *
	 * @var array
	 */
	//public $availability_rules = array();

	/**
	 * Merges booking product data into the parent object.
	 *
	 * @param int|WC_Product|object $product Product to init.
	 */
	public function __construct( $product = 0 ) {
		$this->data = array_merge( $this->data, $this->defaults );
		parent::__construct( $product );
	}
}