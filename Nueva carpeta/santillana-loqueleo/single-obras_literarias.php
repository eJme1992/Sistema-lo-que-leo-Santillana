<?php
include_once 'url.php';
get_header();
while (have_posts()): the_post();
    global $post;
    $thumbID = get_post_thumbnail_id($post->ID);
    $imgDestacada = wp_get_attachment_url($thumbID);
    $reto = get_post_meta($post->ID, 'reto', true);
    $obra_series = wp_get_post_terms($post->ID, 'series', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
    $obra_series = array_pop($obra_series);
    $obra_denominacion = get_post_meta($post->ID, 'denominacion', true);
    $instrucciones_pdf = get_post_meta($post->ID, 'instrucciones_pdf', true);
    $slogan_cintillo = get_post_meta($post->ID, 'slogan_cintillo', true);
    $video = get_post_meta($post->ID, 'video', true);
    ?>

    <section class="center-block" id="<?php echo $obra_series->name; ?>">

        <div class="container" id="obrasdetalles">
            <h1><b>El reto</b></h1>
            <div class="row" style="margin-top:-3%;">
                <div class="col-md-5">
                    <div id="<?php echo $obra_series->name; ?>BORDE">
                        <img src="<?= $imgDestacada; ?>" class="img-responsive img-rounded" alt="obra">
                    </div>
                </div>


                <div class="col-md-7">
                    <h2><b><?= $obra_denominacion; ?></b></h2>
                    <h4><b><?= $slogan_cintillo; ?></b></h4>
                    <p><?= $reto; ?></p>

                    <div class="row">
                        <div class="col-md-6 text-center">
                            <a href="<?php echo $url; ?>participar/"  border="4" class="btn btn-block" >Inscribirse</a>
                        </div>
                        <div class="col-md-6 text-center">
                          <a target="_blank" class="btn btn-block" href="<?php echo $instrucciones_pdf['guid']; ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Indicaciones</a>
                        </div>
                    </div>


                    <div class="row center-block">
                        <div class="center-block text-center col-md-10 ">
                            <iframe class="center-block" width="100%" height="280" src="https://www.youtube.com/embed/<?= $video; ?>" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>

                </div>
            </div>

    </section>

<?php
endwhile;
get_footer();
?>