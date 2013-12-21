<?php

/**
 * WC_Boxpack class.
 */
class WC_Boxpack {

	private $boxes;
	private $items;
	private $packages;
	private $cannot_pack;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		include_once( 'class-wc-boxpack-box.php' );
		include_once( 'class-wc-boxpack-item.php' );
	}

	/**
	 * clear_items function.
	 *
	 * @access public
	 * @return void
	 */
	public function clear_items() {
		$this->items = array();
	}

	/**
	 * clear_boxes function.
	 *
	 * @access public
	 * @return void
	 */
	public function clear_boxes() {
		$this->boxes = array();
	}

	/**
	 * add_item function.
	 *
	 * @access public
	 * @return void
	 */
	public function add_item( $length, $width, $height, $weight, $value = '' ) {
		$this->items[] = new WC_Boxpack_Item( $length, $width, $height, $weight, $value );
	}

	/**
	 * add_box function.
	 *
	 * @access public
	 * @param mixed $length
	 * @param mixed $width
	 * @param mixed $height
	 * @param mixed $weight
	 * @return void
	 */
	public function add_box( $length, $width, $height, $weight = 0 ) {
		$new_box = new WC_Boxpack_Box( $length, $width, $height, $weight );
		$this->boxes[] = $new_box;
		return $new_box;
	}

	/**
	 * get_packages function.
	 *
	 * @access public
	 * @return void
	 */
	public function get_packages() {
		return $this->packages ? $this->packages : array();
	}

	/**
	 * pack function.
	 *
	 * @access public
	 * @return void
	 */
	public function pack() {
		try {
			// We need items
			if ( sizeof( $this->items ) == 0 )
				throw new Exception( 'No items to pack!' );

			// Clear packages
			$this->packages = array();

			// Order the boxes and items by volume
			$this->items = $this->order_by_volume( $this->items );
			$this->boxes = $this->order_by_volume( $this->boxes );

			// Keep looping until packed
			while ( sizeof( $this->items ) > 0 ) {
				if ( $this->boxes ) {

					$possible_packages = array();
					$best_package      = '';

					// Attempt to pack all items in each box
					foreach ( $this->boxes as $box ) {
						$possible_packages[] = $box->pack( $this->items );
					}

					// Find the best success rate
					$best_percent = 0;

					foreach ( $possible_packages as $package ) {
						if ( $package->percent > $best_percent )
							$best_percent = $package->percent;
					}

					if ( $best_percent == 0 ) {
						$this->cannot_pack = $this->items;
						$this->items       = array();
					} else {

						// Get smallest box with best_percent
						$possible_packages = array_reverse( $possible_packages );

						foreach ( $possible_packages as $package ) {
							if ( $package->percent == $best_percent ) {
								$best_package = $package;
								break; // Done packing
							}
						}

						// Update items array
						$this->items = $best_package->unpacked;

						// Store package
						$this->packages[] = $best_package;

					}

				} else {
					$this->cannot_pack = $this->items;
					$this->items       = array();
				}
			}

			// Items we cannot pack (by now) get packaged individually
			if ( $this->cannot_pack ) {
				foreach ( $this->cannot_pack as $item ) {
					$package          = new stdClass();
					$package->id      = '';
					$package->weight  = $item->get_weight();
					$package->length  = $item->get_length();
					$package->width   = $item->get_width();
					$package->height  = $item->get_height();
					$package->value   = $item->get_value();
					$this->packages[] = $package;
				}
			}

		} catch (Exception $e) {
			echo 'Packing error: ',  $e->getMessage(), "\n";
    	}
	}

	/**
	 * order_by_volume function.
	 *
	 * @access private
	 * @return void
	 */
	private function order_by_volume( $sort ) {
		if ( ! empty( $sort ) )
			uasort( $sort, array( $this, 'volume_based_sorting' ) );
		return $sort;
	}

	/**
	 * volume_based_sorting function.
	 *
	 * @access public
	 * @param mixed $a
	 * @param mixed $b
	 * @return void
	 */
	public function volume_based_sorting( $a, $b ) {
		if ( $a->get_volume() == $b->get_volume() ) {
	        return 0;
	    }
	    return ( $a->get_volume() < $b->get_volume() ) ? 1 : -1;
	}

}