<?php
/**
 * Template Name: Service Template
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * based on skeleton
*/

global $lambda_meta_data, $theme_path;

$meta_sidebar = $lambda_meta_data->get_the_value('sidebar');
$meta_sidebar = (!empty( $meta_sidebar )) ? $meta_sidebar : get_option_tree( 'select_sidebar' );

//includes the header.php
get_header();

//includes the template-part-slider.php
get_template_part( 'template-part', 'slider' );

//includes the template-part-teaser.php
get_template_part( 'template-part', 'teaser' );

//content opener - this function can be found in functions/theme-layout-functions.php line 5-50
lambda_before_content($columns='sixteen');

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section>
	<article>
    	<div class="entry-content">
			<?php the_content(); ?>
        </div>
	</article>
</section>
    
<?php endwhile; // end of the loop. ?>


<?php
#-----------------------------------------------------------------
# Service Template
#-----------------------------------------------------------------
?>

<?php if ( !post_password_required( $post ) ) : ?>

<?php 

//retrieve faq items
$tab_items = $lambda_meta_data->get_the_value(UT_THEME_INITIAL.'verticaltabs');

//check if faq items exists
if(is_array($tab_items)) { ?>
	
	<script type="text/javascript">
	jQuery(document).ready(function($){
		
		//url call for tabs
		var contentLocation = window.location.href.slice(window.location.href.indexOf('?') + 1).split('#');
		var contentLocator = contentLocation[1];
		
		//settings
		var $items = $('#vmenu > ul > li');
		var initialindex = 0;
		
		if(contentLocation[1]) {
			initialindex = parseInt(contentLocation[1]);
		}
		
		$(window).load(function(){
					
			$('#vtab').removeClass('overflow-hidden');
			$('#vtabs').css('height', $('#vtabs > div').eq(initialindex).height());
			$('#service-loader').hide();
			
		});
		
		function stopAnimation(element) {
 		   $(element).find('a').css("-webkit-transition", "none");
 		   $(element).find('a').css("-moz-transition", "none");
		   $(element).find('a').css("-o-transition", "none");
		   $(element).find('a').css("-ms-transition", "none");
		   $(element).find('a').css("transition", "none");
		}
		
		function AddAnimation(element) {
 		   $(element).find('a').css("-webkit-transition", "0.2s");
 		   $(element).find('a').css("-moz-transition", "0.2s");
		   $(element).find('a').css("-o-transition", "0.2s");
		   $(element).find('a').css("-ms-transition", "0.2s");
		   $(element).find('a').css("transition", "0.2s");
		}
		
		$items.click(function() {
	    		
			$items.removeClass('selected');
	    	$(this).addClass('selected');
	 
	    	var index = $items.index( $(this) );
	    	
			stopAnimation('#vtabs > div');
								
			$('#vtabs > div').css({ visibility : 'hidden', position: 'absolute' , "z-index": '1' }).eq(index).css({ visibility : 'visible', position: 'absolute' , "z-index": '9999' });
			$('#vtabs').css('height', $('#vtabs > div').eq(index).height());
						
			AddAnimation('#vtabs > div');
					
		}).eq(initialindex).click();
		
		
	});
	</script>
	
	<section class="verticaltabs-wrap clearfix">

	<div id="vtab" class="clearfix overflow-hidden">
    
		<div class="one_fourth" id="vmenu">
			<ul>
			<?php $z=1; foreach($tab_items as $tab) { ?>
					
					<li class="tab tab_<?php echo $z; ?>"><h3><?php echo isset($tab['tab_name']) ? lambda_translate_meta($tab['tab_name']) : ''; ?></h3></li>
			
			<?php $z++; } ?>	
			</ul>
		</div>    
		
		<div id="vtabs" class="clearfix">
		   
		<?php $z=1; foreach($tab_items as $tab) { ?>	
		
			<div class="three_fourths last entry-content" style="right:0px; display:block;"><?php echo (isset($tab['tab_content'])) ? do_shortcode(apply_filters('the_content', $tab['tab_content'])): ''; ?></div>
		
		<?php $z++; } ?>
                    
		</div>
        
        <div id="service-loader" class="three_fourths last" style="right:0px; top:0px; height:100%; display:block; position:absolute;">
        	<img src="<?php echo $theme_path ; ?>/images/103.gif" />
        </div>

	
	</div>
	
	</section>
	<div class="clear"></div>
	
<?php } ?>
                       
<?php
//content closer - this function can be found in functions/theme-layout-functions.php line 56-61
lambda_after_content();

//end password protection
endif;

//includes the footer.php
get_footer();
?>
