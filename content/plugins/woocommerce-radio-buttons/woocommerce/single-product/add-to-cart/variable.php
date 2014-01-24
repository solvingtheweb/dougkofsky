<?php
/**
 * Variable product add to cart
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.5
 */
 
global $woocommerce, $product, $post;
?>
<script type="text/javascript">
    var product_variations_<?php echo $post->ID; ?> = <?php echo json_encode( $available_variations ) ?>;
</script>
 
<?php do_action('woocommerce_before_add_to_cart_form'); ?>
 
<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>">
    <table class="variations" cellspacing="0">
        <tbody>
            <?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
                <tr>
                    <!--<td class="label"><label for="<?php echo sanitize_title($name); ?>"><?php echo $woocommerce->attribute_label($name); ?></label></td>-->
                    <td class="value"><fieldset>
                        <strong>Choose a Size:</strong><br />
                        <ul class="price-selection">
                        <?php
                            if ( is_array( $options ) ) {
 
                                if ( empty( $_POST ) )
                                    $selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
                                else
                                    $selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';
								//echo   $selected_value;
                                // Get terms if this is a taxonomy - ordered
                                if ( taxonomy_exists( sanitize_title( $name ) ) ) {
 
                                    $terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );
									
                                    foreach ( $terms as $term ) {
                                        if ( ! in_array( $term->slug, $options ) ) continue;
                                        echo '<li><input type="radio" value="' . strtolower($term->slug) . '" ' . checked( strtolower ($selected_value), strtolower ($term->slug), false ) . ' id="'. strtolower($term->slug) .'" name="attribute_'. sanitize_title($name).'"><label for="' . strtolower($term->slug) . '">' . apply_filters( 'woocommerce_variation_option_name', $term->name ).'</label></li>';
                                    }
                                } else {
                                    foreach ( $options as $option )
                                        echo '<li><input type="radio" value="' .esc_attr( sanitize_title( $option ) ) . '" ' . checked( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . ' id="'. strtolower($term->slug) .'" name="attribute_'. sanitize_title($name).'"><label for="' . strtolower($term->slug) . '">' . apply_filters( 'woocommerce_variation_option_name', $option ) . '</label></li>';
                                }
                            }
                        ?>
                        </ul>
                    </fieldset> <?php
                        if ( sizeof($attributes) == $loop )
                            //echo '<a class="reset_variations" href="#reset">'.__('Clear selection', 'woocommerce').'</a>';
                    ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
 
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>
 
    <div class="single_variation_wrap" style="display:none;">
        <div class="single_variation"></div>
        <div class="variations_button">
            <strong>Choose a Quantity:</strong>
            <input type="hidden" name="variation_id" value="" />
            <?php woocommerce_quantity_input(); ?>
        </div>
        <button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>
    </div>
    <div><input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" /></div>
 
    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
 
</form>
 
<?php do_action('woocommerce_after_add_to_cart_form'); ?>