<?php

/**
 * WC_Boxpack_Item class.
 */
class WC_Boxpack_Item {

	public $weight;
	public $height;
	public $width;
	public $length;
	public $volume;
	public $value;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct( $length, $width, $height, $weight, $value = '' ) {
		$dimensions = array( $length, $width, $height );

		sort( $dimensions );

		$this->length = $dimensions[2];
		$this->width  = $dimensions[1];
		$this->height = $dimensions[0];

		$this->volume = $width * $height * $length;
		$this->weight = $weight;
		$this->value  = $value;
	}

	/**
	 * get_volume function.
	 *
	 * @access public
	 * @return void
	 */
	function get_volume() {
		return $this->volume;
	}

	/**
	 * get_height function.
	 *
	 * @access public
	 * @return void
	 */
	function get_height() {
		return $this->height;
	}

	/**
	 * get_width function.
	 *
	 * @access public
	 * @return void
	 */
	function get_width() {
		return $this->width;
	}

	/**
	 * get_width function.
	 *
	 * @access public
	 * @return void
	 */
	function get_length() {
		return $this->length;
	}

	/**
	 * get_width function.
	 *
	 * @access public
	 * @return void
	 */
	function get_weight() {
		return $this->weight;
	}

	/**
	 * get_value function.
	 *
	 * @access public
	 * @return void
	 */
	function get_value() {
		return $this->value;
	}
}