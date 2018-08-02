<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
get_header();
?>
<div id="participar" class="container">
    <div class="row clearfix">
        <div class="col-md-12">
            <?php
            if (have_posts()): while (have_posts()): the_post();
                    global $post;
                    $thumbID = get_post_thumbnail_id($post->ID);
                    $imgDestacada = wp_get_attachment_url($thumbID);
                    ?>
                    <div class="row">
                        <div class="col-xs-12 col-md-7">
                            <h1><?php the_title(); ?></h1>
                            <h4><b>Aquí te explicamos con detalles cómo debes participar:<br></b></h4>
                          <div  style="height:20px;"></div>
                          <div id="texto"> <?php the_content(); ?></div>
                        </div>
                        <div class="col-xs-12 col-md-4 calltoaction" style="margin-top:8%;">

                            <p class="gris" id="texto" ><br>Solo haz clic en el botón regístrate. Luego ingresa tus datos y listo.</p>
                            <div class="text-center"><a href="inscribirse/" class="btn btn-lg btn-block">Regístrate</a></div>
                            <img class="img-responsive center-block" width="100" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/mano2.jpg">
                            <div class="text-center"><p><u><a target="_blank" class="gris" id="texto" href="<?php echo get_stylesheet_directory_uri() ?>/pdf/condiciones.pdf" >Términos y condiciones</a></u></p></div>
                        </div>
                    </div>
                <?php endwhile;
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
