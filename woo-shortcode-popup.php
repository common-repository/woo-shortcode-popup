<?php
/*
Plugin Name: woo-shortcode-popup
Plugin URI: http://juliwebconsultancy.com/woo-shortcode-popup
Description: This is a conversion rate optimization plugin that adds a call to action button on woocommerce product archives or product page that opens a popup window when clicked, the name of the button and the content(contact 7 shortcode, map shortcode etc) of the pop up window can be inserted in the admin settings area.
Author: eric jumba
Author URI: http://juliwebconsultancy.com/
Version: 20160706.1
Text Domain: http://juliwebconsultancy.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
function ej_woo_shortcode_popup_init()
{
   if ( get_option( 'wsp' ) === false )
   {
      $options_array['wsp_button_name'] = 'Contact Seller';
      $options_array['wsp_shortcode'] = '';
      add_option( 'wsp', $options_array );
   }
   
}
register_activation_hook( __FILE__, 'ej_woo_shortcode_popup_init' );
$wsp_options = get_option('wsp');
//add styles
function ej_woo_shortcode_popup_scripts() {
    wp_enqueue_style( 'wsp_styles', plugins_url( 'assets/style.css', __FILE__ ));
	//wp_enqueue_script( 'wsp_scripts', plugins_url( 'assets/jquery.leanModal.min.js', __FILE__ ), array(), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'ej_woo_shortcode_popup_scripts' );

if ($wsp_options['wsp_shortcode']!=''){
add_action( 'woocommerce_after_shop_loop_item', 'ej_woo_shortcode_popup_frontend' );
} 
include( plugin_dir_path( __FILE__ ) .'inc/menus.php');
include( plugin_dir_path( __FILE__ ) .'inc/frontend.php');
add_action( 'admin_menu', 'ej_woo_shortcode_popup_menu' );

//save options
add_action( 'admin_post_wsp_save_option', 'ej_process_wsp_options' );
function ej_process_wsp_options()
{
   //if ( !current_user_can( 'manage_options' ) )
   //{
   //   wp_die( 'You are not allowed to be on this page.' );
  // }
   // Check that nonce field
   check_admin_referer( 'wsp_verify' );
 
   $options = get_option( 'wsp' );
 
   if ( isset( $_POST['wsp_button_name'] ) )
   {
      $options['wsp_button_name'] = sanitize_text_field( $_POST['wsp_button_name'] );
	  $options['wsp_shortcode'] =  htmlentities(stripslashes($_POST['wsp_shortcode'])) ;
   }
 
   update_option( 'wsp', $options );
 
   wp_redirect(  admin_url( 'options-general.php?page=woocomerce-shortcode-popup%2Finc%2Fmenus.php&m=1' ) );
   exit;
}