<?php

/* Portfolio Archive
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 */

get_header();

#-----------------------------------------------------------------
# switch grid layout
#-----------------------------------------------------------------

global $columnset, $paged, $lambda_meta_data;

switch ($columnset) {
	case 2:
		$grid = "eight columns";
		$z = 0;
		$counter = 1;
		$width = 460;
		break;
	case 3:
		$grid = "fivep columns";
		$z = 4;
		$counter = 2;
		$width = 300;
		break;
	case 4:
		$grid = "four columns";
		$z = 5;
		$counter = 3;
		$width = 220;
		break;
}

#-----------------------------------------------------------------
# Pagination
#-----------------------------------------------------------------
$paged = 1;
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

#-----------------------------------------------------------------
# custom project types for portfolio query
#-----------------------------------------------------------------
$project_types = '';
if(is_array($lambda_meta_data->get_the_value('cb_project_type'))) {
	$project_types = "&project-type=";
	foreach($lambda_meta_data->get_the_value('cb_project_type') as $type) {
		$project_types .= $type.',';
	}
	$project_types = substr($project_types, 0, -1);
}

#-----------------------------------------------------------------
# custom project types for portfolio query
#-----------------------------------------------------------------
	$layout = $lambda_meta_data->the_meta();	
	
	$posts_per_page = (isset($layout['posts_per_page'])) ? $layout['posts_per_page'] : '9';
	$prev = (isset($layout['portfolio_pre_text'])) ? $layout['portfolio_pre_text'] : 'prev';
	$next = (isset($layout['portfolio_next_text'])) ? $layout['portfolio_next_text'] : 'next';

?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section>
	<article>
		<?php the_content(); ?>
	</article>
</section>
<?php endwhile; // end of the loop. ?>

   
<?php
#-----------------------------------------------------------------
# Isotope Effect
#-----------------------------------------------------------------
?>    
    
    
	<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$(window).load(function(){
		
			/* IsoTope
			================================================== */
			$container = $('#portfolioItems');
				
			$container.isotope({
			  itemSelector : '.portfolio-item',
			  animationEngine : 'best-available',
			  layoutMode:'fitRows',
			  resizable: false,
			  masonry: { columnWidth: $container.width() / <?php echo $columnset; ?> -20}
			});
			
			var $sortedItems = $container.data('isotope').$filteredAtoms;
				
			$('#filter-items a').click(function(){
			  var selector = $(this).attr('data-filter');
			  $container.isotope({ filter: selector });
			  
			  <?php if($columnset != '1') {?>
				$container.find('.last').removeClass('last');
				var i = <?php echo $counter; ?>;		  
				$.each($sortedItems, function(key, value) {
					if($(this).hasClass("isotope-hidden")) {
						i++;
					}
					if(((key-i)/<?php echo $columnset; ?>)==0) {
						$(this).addClass('last');
						i = <?php echo $columnset; ?>+i;
					}
				});
			  <?php } ?>
				
			  if ( !$(this).hasClass('selected') ) {
					$(this).parents('#filter-items').find('.selected').removeClass('selected');
					$(this).addClass('selected');
			  }		  
			  
			  $container.isotope( 'reLayout');	
			  return false;
			});		
		});
		
		$(window).smartresize(function(){
		   
		    $container.isotope({
				// update columnWidth to a percentage of container width
				masonry: { columnWidth: $container.width() / <?php echo $columnset; ?> -20}
			});
					
		});
			
	});
	</script>
    

<?php 
#-----------------------------------------------------------------
# Query Portfolio
#-----------------------------------------------------------------
query_posts('post_type='.UT_PORTFOLIO_SLUG.'&posts_per_page='.$posts_per_page.'&paged='.$paged.'&project_types='.$project_types); ?>

<div id="portfolio-container">

<?php

#-----------------------------------------------------------------
# get all taxonomys project types
#-----------------------------------------------------------------
$taxonomys = get_terms('project-type');	
			
			
#-----------------------------------------------------------------
# check if there is a sorting array
#-----------------------------------------------------------------
if(is_array(get_option('wpalchemy_taxonomy_project-type'))) {
	
    $taxSort = array_sort(get_option('wpalchemy_taxonomy_project-type'), 'SortID' , SORT_ASC);
								
	if(is_array($taxonomys)) {
					
		//run trough taxonomy array
		foreach ($taxonomys as $taxkey => $taxval ) {
					
			//run trough sorting array
			foreach ($taxSort as $sortkey => $sortval) {
			
				if($taxval->term_id == $sortkey) {

					$taxonomys[$taxkey]->SortID = $sortval['SortID'];								

				}						
						
			}					
				
		}
								
	}
				
}
uasort($taxonomys, "compareItems");
									
#-----------------------------------------------------------------
# get all used taxonomy project types
#-----------------------------------------------------------------			
$used_taxonomys = array();
if (have_posts()) : while (have_posts()) : the_post();
	
    if(is_array(wp_get_object_terms( $post->ID, 'project-type'))) {
		foreach (wp_get_object_terms( $post->ID, 'project-type') as $term) {
			$used_taxonomys[$term->term_id] = $term->name;
	} }	
    			
endwhile; endif; ?>


<?php if(isset($layout['activate_portfolio_filter']) && $layout['activate_portfolio_filter'] == 'on') : ?>

<!--start portfolio menu-->
<ul id="filter-items" class="filter_portfolio clearfix">

			<?php
			
			#-----------------------------------------------------------------
			# create final sorted portfolio filter
			#-----------------------------------------------------------------
			$portfolio_filter = array();
					
			if(is_array($taxonomys)) {
				$tax = 1;
				foreach ($taxonomys as $key => $value ) {
					
					if($taxonomys[$key]->parent == 0 && isset($taxonomys[$key]->name) && in_array($taxonomys[$key]->name, $used_taxonomys)) {
						echo '<li><a href="#" data-filter="*" class="selected">'.$taxonomys[$key]->name.'</a></li>';
					} 
					if(in_array($taxonomys[$key]->name, $used_taxonomys) && $taxonomys[$key]->parent != 0 ) {							
						echo '<li><a href="#" data-filter=".'.$taxonomys[$key]->slug.'_filt">'.$taxonomys[$key]->name.'</a></li>';
					}
				$tax++;
				}
			}

			?>
						
</ul>
<!--end portfolio menu-->	
						
</ul>
<!--end portfolio menu-->				

<div class="clear"></div>

<?php endif; ?>

<ul id="portfolioItems" class="clearfix">
	<?php 
	if (have_posts()) : while (have_posts()) : the_post(); $lambda_meta_data->the_meta();
		
		global $more, $theme_options;
		$more = 0;
		
		#-----------------------------------------------------------------
		# Portfolio Meta Data & IconSet
		#-----------------------------------------------------------------	
		$portfoliometa = $lambda_meta_data->the_meta();				
		
		if(isset($portfoliometa['portfolio_type'])) :
				
		switch ($portfoliometa['portfolio_type']) {
			case 'video_portfolio':
					$portfoliotype = 'video';
					break;
					
			case 'audio_portfolio':
					$portfoliotype = 'audio';
					break;
									
			case 'single_image_portfolio':
					$portfoliotype = 'image';
					break;
					
			case 'image_portfolio':
					$portfoliotype = 'gallery';
					break;
					
			case NULL:
					$portfoliotype = 'standard';
					break;						
		}
		
		endif;		
		
		$title= str_ireplace('"', '', trim(get_the_title()));
		
		#-----------------------------------------------------------------
		# get all project-types for this item
		#-----------------------------------------------------------------						
		$projecttype = NULL;
		$projecttypeclean = NULL;
		
		$preview = '';
		$unkown = '';
		$singletaxonomy = array();
		
		$project_cats = wp_get_object_terms( $post->ID, 'project-type' );
					
			if(is_array($project_cats)) {
				foreach( $project_cats as $types ){
					$projecttype .=  $types->slug."_filt ";
					
						//run trough sorting array
						if(isset($taxSort) && is_array($taxSort)) {
							foreach ($taxSort as $sortkey => $sortval) {
							
								if($types->term_id == $sortkey && $types->parent > 0) {
									$singletaxonomy[$types->term_id] = new stdClass();
									$singletaxonomy[$types->term_id]->SortID = $sortval['SortID'];
									$singletaxonomy[$types->term_id]->name = $types->name;
								}						
							}
						}
					
				}
			}
			//cut last whitespace and comma
			uasort($singletaxonomy, "compareItems");
			
			foreach($singletaxonomy as $singleprojecttype) {
				$projecttypeclean.= $singleprojecttype->name.', ';
			}
			
			$projecttypeclean = substr($projecttypeclean,0,-2);
		
				
		#-----------------------------------------------------------------
		# 2-4 Column Layout in first step - alpha - omega or last
		#-----------------------------------------------------------------			
		
		$itemposition = '';	//reset position	
		
		if($columnset !=3) { 
			if($columnset == 2) { (($z%2)==0) ? $itemposition = '' : $itemposition = ' last'; }
			if($columnset == 4) { (($z%4)==0) ? $itemposition = ' last' : $itemposition = ''; }
		} else { 
			if(($z%3) == 0) { $itemposition = ' last'; $z = 3; } 
		} 
		
		?>
		
        <li class="portfolio-item <?php echo $grid.$itemposition; ?> <?php echo $projecttype; ?> clearfix"> 
						
						<div class="thumb remove-bottom clearfix">
						<div class="overflow-hidden">
						
						 <?php
									 						 
						 #-----------------------------------------------------------------
						 # embedded video or image
						 #-----------------------------------------------------------------				 
						 ?>
							
								<?php the_post_thumbnail($columnset.'col-image'); ?>								
								
								<a href="<?php the_permalink(); ?>">
								                               	
									<div class="hover-overlay">
										<?php if(isset($layout['portfolio_item_title']) && $layout['portfolio_item_title'] != 'on') { ?>
											<h1 class="portfolio-title"><?php echo $title; ?></h1>
										<?php } else { ?>
											<span class="circle-hover"><img src="<?php echo get_template_directory_uri(); ?>/images/circle-hover.png" alt="<?php _e('link icon', UT_THEME_INITIAL); ?>" /></span>
										<?php } ?>
									</div>
																		
								</a>
																			
						</div>
                        
                        <?php 
						#-----------------------------------------------------------------
						# display title or not
						#-----------------------------------------------------------------
						if(isset($layout['portfolio_item_title']) && $layout['portfolio_item_title'] == 'on') { ?>							
                            
                            <div class="portfolio-title-below-wrap"> 
                            	
                                <a href="<?php the_permalink(); ?>">						
                                    <h1 class="portfolio-title-below">
                                    
                                         <?php echo $title; ?>
                                         <span><?php echo $projecttypeclean; ?></span>
                                        
                                    </h1>
                                </a>                               
                            
                            </div>
							
						<?php } //endif ?>  
						</div>
						
						
 		</li>		
		
		<?php $z++; endwhile; endif; ?>
	</ul>
    
	<div class="clear"></div>
	
    <?php paginate($next,$prev); ?>

</div>

<?php wp_reset_query(); ?>