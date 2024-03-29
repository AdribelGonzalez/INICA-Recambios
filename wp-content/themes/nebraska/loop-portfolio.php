<?php
/* Portfolio Archive
 *
 * lambda framework v 2.1
 * by www.unitedthemes.com
 * since lambda framework v 1.0
 * 
 */
global $lambda_meta_data, $theme_path, $theme_options;

$metadata = $lambda_meta_data->the_meta();
$projectatts = $lambda_meta_data->the_meta();
$projectatts_exists = ( isset($projectatts[UT_THEME_INITIAL.'project_atts']) && is_array($projectatts[UT_THEME_INITIAL.'project_atts']) ) ? true : false;

$parentID = '';

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
								
				<?php $parentID = get_the_ID(); ?>
                
				<div id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
                  			
                <?php
				$metadata = $lambda_meta_data->the_meta();
				
				if(isset($metadata['portfolio_type']) && $metadata['portfolio_type'] == 'video_portfolio') {
					get_template_part( 'post-formats/video' );
				}
				
				if(isset($metadata['portfolio_type']) && $metadata['portfolio_type'] == 'audio_portfolio') {
					get_template_part( 'post-formats/audio' );
				}
				
				if(isset($metadata['portfolio_type']) && $metadata['portfolio_type'] == 'image_portfolio') {
					get_template_part('post-formats/gallery');
				}
				
				if(isset($metadata['portfolio_type']) && $metadata['portfolio_type'] == 'single_image_portfolio') { ?>
					
					<div class="thumb">
                    	
                        <div class="post-image">	
		
							<div class="overflow-hidden imagepost">
						
							<?php 

								$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
								$image = aq_resize( $url, 940 );								
								
							?>
                            
                            <img src="<?php echo $image; ?>"/>                           
                            <a href="<?php echo $url; ?>" data-rel="prettyPhoto">
                                <div class="hover-overlay"><span class="circle-hover"><img src="<?php echo get_template_directory_uri(); ?>/images/lens-icon.png" /></span></div>
                            </a>						
                        
						</div>
                        
                    </div>
                    
				</div>
                    
				<?php } ?>
				
            <div class="clear"></div>
            
                       
                <div class="entry-content portfolio-content <?php echo ($projectatts_exists) ? 'eleven columns alpha' : 'full-width'; ?> clearfix">  
                	
					<?php if(isset($metadata['pcontent_title'])) { ?>
						
                        <div class="title-wrap clearfix">
                        
						<h3 class="home-title"><span><?php echo lambda_translate_meta($metadata['pcontent_title']); ?></span></h3>
					
                    	</div>
                        
					<?php } ?>
					
					<?php the_content(); ?>
                
				</div>            
                
				<?php if($projectatts_exists) : ?>
				         
                <div class="five columns p-info-wrap omega">
            	
            	<div class="portfolio-info">
            			
					<?php if(isset($metadata['work_title'])) { ?>
						
                        <div class="title-wrap clearfix">
                        
							<h3 class="home-title"><span><?php echo $metadata['work_title']; ?></span></h3>
                        
                        </div>
					
					<?php } ?>
													
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', UT_THEME_NAME ), 'after' => '</div>' ) ); ?>              
                
                		<?php
						#-----------------------------------------------------------------
						# project attributes like Client: Google.com or Location: Los Angeles
						#-----------------------------------------------------------------
						
						if($projectatts_exists) {
						foreach ($projectatts[UT_THEME_INITIAL.'project_atts'] as $item)	{
							echo "<p>".$item['work_title'];
							if(isset($item['is_link'])) {
								echo '</br><span><a href="'.$item['work_desc'].'" target="_blank">'.__('Visit Site', UT_THEME_NAME).'</a></span>';
							} else {
								echo "</br><span>".do_shortcode($item['work_desc'])."</span>","</p>";		
							}
						}}	
											
						?>
                        
                        
                </div><!-- #portfolio-info -->
                
                </div><!-- #four columns -->
				
				<?php endif; ?>
                
                </div><!-- #post-## -->
                
                         
                <div class="clear"></div>
                
                <div class="edit-link-wrap">
						<?php edit_post_link( __( 'Edit', UT_THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-utility -->       
				
                <?php endwhile; // end of the loop. ?>
                
                <div class="clear"></div>
                                
				<?php 
				
				$related = array();
				if(is_array(wp_get_object_terms( $post->ID, 'project-type'))) {
				foreach (wp_get_object_terms( $post->ID, 'project-type') as $term) {
						
						if($term->parent != 0)
						array_push($related, $term->slug);
						
				} }
																		
				$args = array(
                    'post_type'         =>  UT_PORTFOLIO_SLUG,
                    'posts_per_page'    =>  4,
                    'paged'             =>  $paged,
                    'tax_query'         =>  array(
                                                array(
                                                    'taxonomy' => 'project-type',
                                                    'field' => 'slug',
                                                    'terms' => $related
                                                )
                                            ),
                    'post__not_in'      =>  array( $post->ID )
                
                );
                														
				query_posts($args);
				
				$z = 1; ?>                
                
                <section id="related-projects">
                    
                    <?php if ( have_posts() && $wp_query->found_posts > 1) : ?>
                    
                    <div class="title-wrap clearfix">
                    
                   		<h3 class="home-title"><span><?php _e('Related Projects', UT_THEME_NAME ); ?></span></h3>
                    
                    </div>
                    
                    <?php endif; ?> 
                    
                    <ul id="portfolioItems" class="clearfix">
                        
						<?php if ( have_posts()) : while ( have_posts() ) : the_post(); $lambda_meta_data->the_meta(); ?>
                        	
								<?php 
                                
                                global $more;
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
                                $itemposition = (($z%4) == 0) ? ' last' : ''; ?>
                                
                                <?php if( $parentID != get_the_ID() ) : ?>
                                
                                <li class="portfolio-item four columns <?php echo $itemposition; ?> clearfix"> 
                                    
                                    <div class="thumb remove-bottom clearfix">
                                        <div class="overflow-hidden">
                                            
                                            <?php the_post_thumbnail('4col-image'); ?>
                                                                                
                                            <a href="<?php the_permalink(); ?>">
                                                                            
                                                <div class="hover-overlay">
                                                        <span class="circle-hover"><img src="<?php echo get_template_directory_uri(); ?>/images/circle-hover.png" alt="<?php _e('link icon', UT_THEME_INITIAL); ?>" /></span>
                                                </div>
                                                                                    
                                            </a>
                                            
                                        </div>
                                            
                                        <div class="portfolio-title-below-wrap"> 
                                                
                                                <a href="<?php the_permalink(); ?>">            
	                                                <h1 class="portfolio-title-below">
                                                        
                                                            <?php echo $title; ?>
                                                        
                                                    </h1>
                                                </a>
                                            
                                        </div>                                            
                                        
                                    </div>
                                
                                </li>
                                
                                <?php $z++; ?>
                                
                                <?php endif; ?>                            
                            
                        <?php endwhile; endif; ?>
                    </ul>    
                </section>
                
				<?php wp_reset_query(); ?>

<?php comments_template( '', true ); ?>