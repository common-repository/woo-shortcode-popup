<?php
function ej_woo_shortcode_popup_menu() {
	add_options_page( 'shortcode popup', 'shortcode popup', 'manage_options', __FILE__, 'ej_woo_shortcode_popup_menu_admin_page', 'dashicons-tickets', 6  );
}
function ej_woo_shortcode_popup_menu_admin_page(){
	 $options = get_option( 'wsp' );
?>
   <div class="wrap">
      <h2>Woocommerce shortcode popup</h2>

<?php
  if ( isset( $_GET['m'] ) && $_GET['m'] == '1' )
  {
?>
   <div id='message' class='updated fade'><p><strong>You have successfully updated your button.</strong></p></div>
<?php
  }
?>
	  
      <form method="post" action="admin-post.php">
	  <?php wp_nonce_field( 'wsp_verify' ); ?>
         <input type="hidden" name="action" value="wsp_save_option" /> 
		 <table class="form-table">
			<tbody>
			<tr><th scope="row">
         Button Text:</th>
			<td><input type="text" name="wsp_button_name" value="<?php echo esc_html( $options['wsp_button_name'] ); ?>"/></td>
         <tr><th scope="row">
		 Shortcode: </th>
		 <td><input type="text" name="wsp_shortcode" value="<?php echo esc_html( $options['wsp_shortcode'] ); ?>"/></td>
         <tr><th scope="row"></th>
         <td><input type="submit" value="Submit" class="button-primary"/></td>
		 </tbody>
		 </table>
      </form>
	  
   </div>
<?php
}