<?php
/*
Plugin Name: WooCommerce variation sorting 
Description: Ability to sort woocommerce variations.
Version: 1.1
License: GPL - 3
Author: JohnDave - BlackCrowValley
Author URI: http://www.blackcrowvalley.co.uk
*/


/* Runs when plugin is activated */
register_activation_hook(__FILE__,'sorter_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'sorter_remove' );

function sorter_install() {
/* Creates new database field */
add_option("sorter_data", 'Default', '', 'yes');

/* Change variable.php contents to new version */
$file = dirname(__FILE__) . '/variable.php';

$newfile = dirname(dirname(__FILE__)) . '/woocommerce/templates/single-product/add-to-cart/variable.php';

if (!copy($file, $newfile)) {
    echo "failed to copy $file...\n";
}

}

function sorter_remove() {
/* Deletes the database field */
delete_option('sorter_data');

/* Change variable.php contents to original version */
$file = dirname(__FILE__) . '/variableOLD.php';

$newfile = dirname(dirname(__FILE__)) . '/woocommerce/templates/single-product/add-to-cart/variable.php';

if (!copy($file, $newfile)) {
    echo "failed to copy $file...\n";
}
}
    
    
if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'hello_world_admin_menu');

function hello_world_admin_menu() {
add_options_page('WooCommerce Variation Sorting', 'WooCommerce Variation Sorting', 'administrator',
'WooCommerce-Variation-Sorting', 'sorting_html_page');
}
}


function sorting_html_page() {
?>
<div>
<h2>WooCommerce Variation Sorting Options</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table width="510">
<tr valign="top">
<th width="192" scope="row">Select sorting order...</th>
<td width="406">

<?php 
$setting = get_option('sorter_data');
if( $setting == "Ascending" ){
	echo "<select name=\"sorter_data\" id=\"sorter_data\">";
	echo "<option value=\"Ascending\" selected>Ascending</option>";
	echo "<option value=\"Descending\">Descending</option>";
	echo "<option value=\"In List Order\">In list order</option>";
	echo "</select>";
}

if( $setting == "Descending" ){
	echo "<select name=\"sorter_data\" id=\"sorter_data\">";
	echo "<option value=\"Ascending\">Ascending</option>";
	echo "<option value=\"Descending\" selected>Descending</option>";
	echo "<option value=\"In List Order\">In list order</option>";
	echo "</select>";
}

if( $setting == "In List Order" ){
	echo "<select name=\"sorter_data\" id=\"sorter_data\">";
	echo "<option value=\"Ascending\">Ascending</option>";
	echo "<option value=\"Descending\" >Descending</option>";
	echo "<option value=\"In List Order\" selected>In list order</option>";
	echo "</select>";
}

if( $setting == "Default" ){
	echo "<select name=\"sorter_data\" id=\"sorter_data\">";
	echo "<option value=\"Ascending\">Ascending</option>";
	echo "<option value=\"Descending\" >Descending</option>";
	echo "<option value=\"In List Order\" selected>In list order</option>";
	echo "</select>";
}

?>



</td>
</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="sorter_data" />

<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?php
}
?>