<?php
/*
  Plugin Name: Woo Radio Buttons Extension
  Plugin URI: 'Woo Radio Buttons Extension'
  Description: This plugin provide new attribute type 'radio button' compatible with Woocommerce 2.0. <strong>If you find this plugin usefull, please provide ratings. Thanks and enjoy!</strong>
  Author: Cyber Infrastructure : Dev - Ankit Mehta
  Author URI: http://www.cisin.com/
  Version: 1.0
 */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    function wooradio_plugin_path() {
        // gets the absolute path to this plugin directory 
        return untrailingslashit(plugin_dir_path(__FILE__));
    }

    add_filter('woocommerce_locate_template', 'wooradio_woocommerce_locate_template', 10, 3);

    function wooradio_woocommerce_locate_template($template, $template_name, $template_path) {
        global $woocommerce;
        $_template = $template;
        if (!$template_path)
            $template_path = $woocommerce->template_url;
        $plugin_path = wooradio_plugin_path() . '/woocommerce/';
        // Look within passed path within the theme - this is priority 
        $template = locate_template(
                array(
                    $template_path . $template_name,
                    $template_name
                )
        );
        // Modification: Get the template from this plugin, if it exists
        if (!$template && file_exists($plugin_path . $template_name))
            $template = $plugin_path . $template_name;
        // Use default template
        if (!$template)
            $template = $_template;
        // Return what we found
        return $template;
    }

    function register_radio_button_scripts() {
        wp_deregister_script('wc-add-to-cart-variation');
        wp_dequeue_script('wc-add-to-cart-variation');
        wp_register_script('wc-add-to-cart-variation', plugins_url('woocommerce\assets\js\frontend\add-to-cart-variation.min.js', __FILE__), array('jquery'), false, true);
        wp_enqueue_script('wc-add-to-cart-variation');
    }

    add_action('wp_enqueue_scripts', 'register_radio_button_scripts');
    add_action('wp_footer', 'register_radio_button_scripts');

    /* function to add radio button in option list */
    add_action('woocommerce_admin_attribute_types', 'add_new_attribute_type');

    function add_new_attribute_type() {
        echo "<option " . selected($att_type, 'text') . " value='radio'>Radio Button</option>";
    }

    /* function to save radio button value */
    add_action('woocommerce_product_option_terms', 'add_new_attribute_type_values', 10, 2);

    function add_new_attribute_type_values($tax, $i) {
        global $post, $thepostid;
        $thepostid = $post->ID;
        $attribute_taxonomy_name = 'pa_' . $tax->attribute_name;
        if ($tax->attribute_type == "radio") {
            ?>
            <select multiple="multiple" data-placeholder="<?php _e('Select terms', 'woocommerce'); ?>" class="multiselect attribute_values" name="attribute_values[<?php echo $i; ?>][]">
                <?php
                $all_terms = get_terms($attribute_taxonomy_name, 'orderby=name&hide_empty=0');
                if ($all_terms) {
                    foreach ($all_terms as $term) {
                        $has_term = has_term((int) $term->term_id, $attribute_taxonomy_name, $thepostid) ? 1 : 0;
                        echo '<option value="' . esc_attr($term->slug) . '" ' . selected($has_term, 1, false) . '>' . $term->name . '</option>';
                    }
                }
                ?>
            </select>

            <button class="button plus select_all_attributes"><?php _e('Select all', 'woocommerce'); ?></button> <button class="button minus select_no_attributes"><?php _e('Select none', 'woocommerce'); ?></button>

            <button class="button fr plus add_new_attribute" data-attribute="<?php echo $attribute_taxonomy_name; ?>"><?php _e('Add new', 'woocommerce'); ?></button>
<?php } } } ?>