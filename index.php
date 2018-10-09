<?php
   /*
   Plugin Name: Content Website Order Calculator
   Plugin URI: https://www.websiteladz.com/
   description: a plugin to create Content websites order calculator.<br> use shortcode for display:  [content_calculator]
   Version: 1.0
   Author: Mr. Omesh Narwani
   License: GPL2
   */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/*
function wptuts_scripts_basic()
{
    // Deregister the included library
    wp_deregister_script( 'jquery' );
     
    // Register the library again from Google's CDN
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), null, false );
     
    // Register the script like this for a plugin:
    wp_register_script( 'custom-script', plugins_url( '/js/myscript.js', __FILE__ ) );
    // or
    // Register the script like this for a theme:
    //wp_register_script( 'custom-script', get_template_directory_uri() . '/js/custom-script.js' );
 
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic' );*/

add_action('wp_enqueue_scripts', 'callback_for_setting_up_scripts');
function callback_for_setting_up_scripts() {
        // Deregister the included library
    wp_deregister_script( 'jquery' );
     
    // Register the library again from Google's CDN
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), null, false );
    wp_register_style( 'namespace', plugins_url( '/css/mystyle.css', __FILE__ ) );
    wp_enqueue_style( 'namespace' );
    wp_enqueue_script( 'custom-script', plugins_url( '/js/myscript.js', __FILE__ ) );
}


add_shortcode( 'content_calculator', 'contentcalculator_shortcode_function' );
function contentcalculator_shortcode_function($atts, $content = null){
    $ref = shortcode_atts( array(
          'main-heading' => '',
          'sub-heading' => '',
          'heasing-descp-para' => '',
        ), $atts );
    global $wpdb;
    $query = "SELECT p.ID,p.post_title,pm.meta_value as price FROM wp_posts p, wp_postmeta pm WHERE p.post_type = 'product' and p.`post_status` = 'publish' and p.ID = pm.post_id and pm.meta_key = '_regular_price'";
    $products = $wpdb->get_results ($query);
    //echo "<pre>";
    //print_r($products);
?>
<div class="formArea1">
    <div class="row">
        <div class="col-md-6">
            <p>Select The Service Required: </p>
        </div>
        <div class="col-md-6">
            <!-- SELECT SERVICES  -->
            <select name="product" id="product-services1">
                <option value="-1" selected="selected">Select Service</option>
            <?php foreach($products as $product){ ?>
                <option data-proid="<?= $product->ID; ?>"  value="<?= $product->price; ?>"><?=$product->post_title; ?></option>
            <?php } ?>
            </select>
        </div>
    </div>
    <div class="row sec1">
        <div class="col-md-6">
            
            <p>Number of Pages Required: </p>
        </div>
        <div class="col-md-6">
           <!-- SELECT PAGES  -->
			<select  data-val="true" data-val-number="The field SelectedNumberOfPages must be a number." data-val-required="The SelectedNumberOfPages field is required." id="numberofpages01" name="SelectedNumberOfPages">
			<option value="">Select No Of Pages</option>
			<?php for($i=1; $i <=400; $i++){
			    echo "<option value='".$i."'>$i</option>";
			}?>
			
            </select>
			<!-- ORDERT BUTTON  -->
            <a href="#" id="carturl" class="anchor" target="_parent">Place Order</a>
        </div>
    </div>
    
    <div class="row">
		<!-- TOTAL AMOUNT  -->
        <div class="col-md-6 TotalAmount"><h5 class="dl">Total Amount:<br><span id="price1">$ 0</span></h5></div>

		
        <div class="col-md-6" style="display:none"><h5>Estimated Time:<br><span id="deadline" class="nn"></span><span> Working Days</span></h5></div>
    </div>
</div>
<?php
}
?>

