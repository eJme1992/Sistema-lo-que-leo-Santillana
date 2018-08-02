<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0

 */
get_header();
?>
<script src="<?php echo get_stylesheet_directory_uri() ?>/_/js/script.js"></script>


<!-- prueba -->
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="w-title-com">
                <h3>Concurso</h3>
                <h2 class="title">Soyloqueleo</h2>
                <h4 class="subtitle"><span class="line"></span><span class="text">&iexcl;Cumple el reto de tu grado y gana!</span></h4>
                <p><b>Participan todos los estudiantes, docentes y colegios.</b></p>
            </div>
            <div class="list-filter  category_list">
                <ul>
                    <li><a class="category_item" id="" category="all" href="#"><img class="img-responsive center-block"  width="30" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/filter_1.jpg" alt="Chania">Todo</a></li>
                    <li><a class="category_item" id="AMARILLA" category="AMARILLA" href="#"><img class="img-responsive center-block"  width="30" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/pin1.png" alt="Chania">+6</a></li>
                    <li><a class="category_item" id="MORADA" category="MORADA"  href="#"><img class="img-responsive center-block"  width="30" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/pin2.png" alt="Chania">+8</a></li>
                    <li><a class="category_item" id="NARANJA" category="NARANJA"  href="#"><img class="img-responsive center-block"  width="30" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/pin3.png" alt="Chania">+10</a></li>
                    <li><a class="category_item" id="AZUL" category="AZUL"  href="#"><img class="img-responsive center-block"  width="30" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/pin4.png" alt="Chania">+12</a></li>
                    <li><a class="category_item" id="JUVENIL" category="JUVENIL"  href="#"><img class="img-responsive center-block"  width="30" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/pin5.png" alt="Chania">+14</a></li>
                </ul>

            </div>
        </div>
    </div>

    <div class="row clearfix" style="margin-top:4%;">
        <div class="w-item-book clearfix center-block products-list">
            <?php
            $args = array(
                'post_type' => 'obras_literarias',
                'orderby' => 'date',
                'order' => 'asc',
                'posts_per_page' => -1
            );

            $obras = new WP_query($args);

            if ($obras->have_posts()) : while ($obras->have_posts()) : $obras->the_post();
                    $thumbID = get_post_thumbnail_id($post->ID);
                    $obra_img = wp_get_attachment_url($thumbID);
                    $obra_title = get_the_title($post->ID);
                    $obra_link = get_permalink($post->ID);
                    $obra_autor = get_post_meta($post->ID, 'autor', true);
                    $sexo = get_post_meta($post->ID, 'sexo_del_autor', true);
                    $obra_series = wp_get_post_terms($post->ID, 'series', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all'));
                    $obra_series = array_pop($obra_series);
                    $obra_categoria = $obra_series->slug;
                    $obra_denominacion = get_post_meta($post->ID, 'denominacion', true);
                    $edad = get_term_meta($obra_series->term_id, 'edad', true);
                  
                    ?>
                    <div class="product-item col-md-3 show-grid item-book text-center center-block home" category="<?= $obra_series->name; ?>"  id="<?= $obra_series->name; ?>" >
                        <div class="cont">
                            <a href="<?= $obra_link ?>">  <img src="<?= $obra_img ?>" class="img-responsive img-thumbnail img-rounded" alt="obra"></a>
                        </div>
                        <div class="author"><p><br><strong><?=$sexo;?>: </strong><?php echo$obra_autor;?></p></div>
                        <div class="soy-typo"><span class="num-filter"><?= $edad;?></span><j style="font-size:16px;"> <?php echo $obra_denominacion;?></j> </div>
                        <a href="<?= $obra_link ?>" class="btn">Participar</a>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>
