<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
 get_header(); ?>
 <div class="container">
	<div class="row clearfix">
		<div class="col-md-12">
		<?php if (have_posts()) : while (have_posts()) : the_post();

global $post;
$thumbID = get_post_thumbnail_id( $post->ID );
$imgDestacada = wp_get_attachment_url( $thumbID );?>
			


				
				
		
<?php if (is_page('participar') ) { $p=1; ?>


<div class="row" style="margin-left:10%; margin-right: 10%; margin-bottom:10%;" >
			     <div class="col-lg-6" style="min-height: 450px;">
			     <h1><span style="color:#85B037;" ><?php the_title(); ?></span></h1>
				<?php the_content(); ?>
				</div>
                
				<div class="col-lg-6" style="margin-top:50px;" >
				
				 <img class="img-responsive" src="<?php echo $imgDestacada ?>">
				 <p>En provincias, el ganador recibirá el premio a través de su delegación. El premio no contempla el traslado del ganador a Lima.</p>
                 <div class="text-center">
                 <a href="#" class="btn" style="background-color:#85B037;">Registrate</a><br>
                 </div>
                 <div class="text-center" style="margin-top:4%">
                 <div style="margin-top:2%;"><a href="#" >Terminos y condiciones</a></div>
				</div>
				</div>
	</div>


<?php } ?>











 <?php if (is_page('inmuebles') ) { include (TEMPLATEPATH .'/inmuebles.php'); } ?>
 <?php if (is_page('internacional') ) { include (TEMPLATEPATH .'/internacional.php'); } ?>
 <?php if (is_page('contactanos') ) { include (TEMPLATEPATH .'/contactanos.php'); } ?>
<?php if ($p!=1) {the_content(); }   ?>
	

			
			



			



			<?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>
		<?php endwhile; endif; ?>			
		</div>
	</div>
</div>
	
<?php get_footer(); ?>
