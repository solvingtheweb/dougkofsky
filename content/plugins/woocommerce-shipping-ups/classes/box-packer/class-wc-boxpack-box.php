<?php

/**
 * WC_Boxpack_Box class.
 */
class WC_Boxpack_Box {

	/** @var string ID of the box - given to packages */
	private $id = '';

	/** @var float Weight of the box itself */
	private $weight;

	/** @var float Max allowed weight of box + contents */
	private $max_weight = 0;

	/** @var float Outer dimension of box sent to shipper */
	private $outer_height;

	/** @var float Outer dimension of box sent to shipper */
	private $outer_width;

	/** @var float Outer dimension of box sent to shipper */
	private $outer_length;

	/** @var float Inner dimension of box used when packing */
	private $height;

	/** @var float Inner dimension of box used when packing */
	private $width;

	/** @var float Inner dimension of box used when packing */
	private $length;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct( $length, $width, $height, $weight = 0 ) {
		$dimensions = array( $length, $width, $height );

		sort( $dimensions );

		$this->outer_length = $this->length = $dimensions[2];
		$this->outer_width  = $this->width  = $dimensions[1];
		$this->outer_height = $this->height = $dimensions[0];
		$this->weight       = $weight;
	}

	/**
	 * set_id function.
	 *
	 * @access public
	 * @param mixed $weight
	 * @return void
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}

	/**
	 * set_max_weight function.
	 *
	 * @access public
	 * @param mixed $weight
	 * @return void
	 */
	public function set_max_weight( $weight ) {
		$this->max_weight = $weight;
	}

	/**
	 * set_inner_dimensions function.
	 *
	 * @access public
	 * @param mixed $length
	 * @param mixed $width
	 * @param mixed $height
	 * @return void
	 */
	public function set_inner_dimensions( $length, $width, $height ) {
		$dimensions = array( $length, $width, $height );

		sort( $dimensions );

		$this->length = $dimensions[2];
		$this->width  = $dimensions[1];
		$this->height = $dimensions[0];
	}

	/**
	 * can_fit function.
	 *
	 * @access public
	 * @param mixed $item
	 * @return void
	 */
	function can_fit( $item ) {
		return ( $this->get_length() >= $item->get_length() && $this->get_width() >= $item->get_width() && $this->get_height() >= $item->get_height() ) ? true : false;
	}

	/**
	 * pack function.
	 *
	 * @access public
	 * @param mixed $items
	 * @return object Package
	 */
	public function pack( $items ) {

		$packed        = array();
		$unpacked      = array();
		$packed_weight = $this->get_weight();
		$packed_volume = 0;
		$packed_value  = 0;

		while ( sizeof( $items ) > 0 ) {
			$item = array_shift( $items );

			// Check dimensions
			if ( ! $this->can_fit( $item ) ) {
				$unpacked[] = $item;
				continue;
			}

			// Check max weight
			if ( ( $packed_weight + $item->get_weight() ) > $this->max_weight && $this->max_weight > 0 ) {
				$unpacked[] = $item;
				continue;
			}

			// Check volume
			if ( ( $packed_volume + $item->get_volume() ) > $this->get_volume() ) {
				$unpacked[] = $item;
				continue;
			}

			// Pack
			$packed[] = $item;
			$packed_volume += $item->get_volume();
			$packed_weight += $item->get_weight();
			$packed_value  += $item->get_value();
		}

		$package           = new stdClass();
		$package->id       = $this->id;
		$package->packed   = $packed;
		$package->unpacked = $unpacked;
		$package->percent  = ( sizeof( $packed ) / ( sizeof( $unpacked ) + sizeof( $packed ) ) ) * 100;
		$package->weight   = $packed_weight;
		$package->volume   = $packed_volume;
		$package->length   = $this->get_outer_length();
		$package->width    = $this->get_outer_width();
		$package->height   = $this->get_outer_height();
		$package->value    = $packed_value;

		return $package;
	}

	/**
	 * get_volume function.
	 *
	 * @access public
	 * @return void
	 */
	function get_volume() {
		return $this->get_height() * $this->get_width() * $this->get_length();
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
	 * get_weight function.
	 *
	 * @access public
	 * @return void
	 */
	function get_weight() {
		return $this->weight;
	}

	/**
	 * get_outer_height function.
	 *
	 * @access public
	 * @return void
	 */
	function get_outer_height() {
		return $this->outer_height;
	}

	/**
	 * get_width function.
	 *
	 * @access public
	 * @return void
	 */
	function get_outer_width() {
		return $this->outer_width;
	}

	/**
	 * get_width function.
	 *
	 * @access public
	 * @return void
	 */
	function get_outer_length() {
		return $this->outer_length;
	}
}