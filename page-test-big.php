<?php
/*
Template Name: Big Page
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header>
							
							<div class="page-header"><h1><?php the_title(); ?></h1></div>
													<?php echo custom_breadcrumbs(); ?>

							
						</header> <!-- end article header -->
						<section class="post_content">
						<div class="hist-slides">
							<div class="subcontent col-md-10">
								<div class="subcontent-1 subslide active"><?php the_content(); ?></div>
						<!--SLIDES BEGIN-->
						<?php 						
						if( have_rows('histo_slide') ): 
							$count = 1;
						    $menu = ["Blank Slide"];
							?>
						
								<?php while( have_rows('histo_slide') ): the_row(); 

									// vars
									$image = get_sub_field('slide_url');
									$content = get_sub_field('slide_text');
									$title = get_sub_field('slide_title');
									$count = $count+1;
									array_push($menu,$title);
									?>


									 <div class="subcontent-<?php echo $count;?> subslide">
										<?php echo $image; ?>
										<?php if( $title ): ?>
											<h3><?php echo $title; ?></h3>
										<?php endif; ?>											

										<?php if( $content ): ?>								
			
									    <?php echo $content;?>
									<?php endif;?>
									</div>
								<?php endwhile; ?>
							</div>
							<!--SLIDE NATIGATION MENU-->
							<div class="button-wrap col-md-2">
								 <?php  
								 $length = count($menu);
								 $i = 0;
								 while ( $i < $length){
								 	echo '<a href="#" class="button">' .$menu[$i] . '</a>';
								 	$i++;
								 }

								 ?>
							</div>
							<!--END SLIDE MENU-->
						</div>
					<?php endif; ?>
					<!--SUB PAGES MENU-->
					<div class="cell-topics">
						<ul>
						    <?php				
						    $post_id = get_the_ID();
						    $ancestor_id = get_ancestors($post_id,'page', 'post_type')[0];
						    wp_list_pages( array(
						        'title_li'    => '',
						        'child_of'    => $ancestor_id,
						    ) );
						    ?>
						</ul>
					</div>	

						</section> <!-- end article section -->
						
						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>

						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    <?php -e("fish", "wpbootstrap"); ?>
					    </footer>
					</article>

					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>