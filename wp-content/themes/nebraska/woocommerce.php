<?php 
//includes the header.php
get_header();

//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//can be found in functions/theme-woocommerce.php
lambda_woo_before_content();
lambda_woocommerce_content();
lambda_woo_after_content();

//includes the footer.php
get_footer();
?>