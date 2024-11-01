<?php

function ej_woo_shortcode_popup_frontend(){
	global $wsp_options;
?>

	<a href="#pop2"><button><?php echo $wsp_options['wsp_button_name']; ?></button></a>

	<div id="pop2" class="pop-up">
	  <div class="popBox">
		<div class="popScroll">
		  <h2><?php echo $wsp_options['wsp_button_name']; ?></h2>
		  <?php echo do_shortcode($wsp_options['wsp_shortcode']); ?>
		</div>
		<a href="#links" class="close"><span>Close</span></a>
	  </div>
	  <a href="#links" class="lightbox">Back to links</a>
	</div>
	
<?php
}