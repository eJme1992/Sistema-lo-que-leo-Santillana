<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
get_header();
?>
<div class="container" id="premios">


    <h1><b>Premios</b></h1>
    <h4><b><b>Concursa y gana fabulosos premios</b></h4>

    <div class="row">


        <div class="col-md-6">
            <div class="text-center grado center-block">
                <div style="height:5px;"></div>
                <h3><b>PRIMARIA</b></h3>
            </div>
            <?php
            // consulto la categoria estructura_premio el id 3
            $categories = get_terms(array(
                'taxonomy' => 'estructura_premio',
                'parent' => 3,
                'hide_empty' => false,
                'orderby' => 'name',
                'order' => 'desc'
            ));
            // Si la consulta es correcta recorro el arreglo
            if ($categories) {
                ?>

                <?php
                foreach ($categories as $category) {
                    ?>
                    <div class="panel panel-body">
                        <div class=""> <h4><b>
                                    <span class="sub" >
                                        <img class="img-responsive ico" src="<?php
                                        echo get_stylesheet_directory_uri();
                                        ?>/_/img/<?php
                                             echo $category->name;
                                             ?>.png" alt="Chania"> Para los <?= $category->name; ?>
                                        </h4></div>
                                        <?php
                                        // Consulto los premios que depende de esa categoria
                                        $args = array(
                                            'post_type' => 'premios',
                                            'orderby' => 'date',
                                            'order' => 'ASC',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'estructura_premio',
                                                    'field' => 'term_id',
                                                    'terms' => $category->term_id
                                                )
                                            ),
                                          
                                        );

                                        $subpages = new WP_query($args);
                                        $i = 0;
                                        //Recorro el arreglo de premios
                                        if ($subpages->have_posts()):
                                            while ($subpages->have_posts()):
                                                $subpages->the_post();

                                                // Imagen destacada
                                                global $post;
                                                $thumbID = get_post_thumbnail_id($post->ID);
                                                $imgDestacada = wp_get_attachment_url($thumbID);
                                                $premio = get_post_meta($post->ID, 'nombrepremio', true);
                                                $puesto = get_post_meta($post->ID, 'puesto', true);
                                                ?>

                                                <div class="col-sm-12 det-premio row">

                                                    <div class="text-center puesto"><span><b><?= $puesto; ?><b/></span><br>puesto</div>
                                                    <div class="col-md-offset-1 img-premio" <?php
                                                    if ($i < 1) {
                                                        echo "style='height:140px;'";
                                                    } else {
                                                        echo "style='height:100px;'";
                                                    }
                                                    ?>><img class="img-premio center-block" src="<?= $imgDestacada; ?>"  <?php
                                                         if ($i < 1) {
                                                             echo "style='height:100px'";
                                                         } else {
                                                             echo "style='height:75px;'";
                                                         }
                                                         ?>></div>
                                                    <div class=" premio"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><?= $premio; ?></div>
                                                </div>
                                                <img class="img-responsive center-block"  src="<?php echo get_stylesheet_directory_uri() ?><?php
                                                if ($i < 1) {
                                                    echo "/_/img/separador.png";
                                                } else {
                                                    echo "/_/img/Separador3.png";
                                                }
                                                ?>" >

                                                <?php
                                                $i++;
                                            endwhile;
                                        else:
                                            echo 'Lo sentimos, por el momento no contamos con tours para este destino.';
                                        endif;

                                        // reset the query
                                        wp_reset_postdata();
                                        ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                }
                                ?>
                                </div>



                                <div class="col-md-6">
                                    <div class="text-center grado center-block">
                                        <div style="height:5px;"></div>
                                        <h3><b>SECUNDARIA</b></h3>
                                    </div>
                                    <?php
                                    // consulto la categoria estructura_premio el id 4
                                    $categories1 = get_terms(array(
                                        'taxonomy' => 'estructura_premio',
                                        'parent' => 4,
                                        'hide_empty' => false,
                                        'orderby' => 'name',
                                        'order' => 'desc'
                                    ));
                                    // Si la consulta es correcta recorro el arreglo
                                    if ($categories1) {
                                        ?>
                                        <?php
                                        foreach ($categories1 as $category) {
                                            ?>
                                            <div class="panel panel-body">
                                                <div class=""> <h4><b>
                                                            <span class="sub" >
                                                                <img class="img-responsive ico" src="<?php
                                                                echo get_stylesheet_directory_uri();
                                                                ?>/_/img/<?php
                                                                     echo $category->name;
                                                                     ?>.png" alt="Chania"> Para los <?= $category->name; ?>
                                                                </h4></div>
                                                                <?php
                                                                // Consulto los premios que depende de esa categoria
                                                                $args = array(
                                                                    'post_type' => 'premios',
                                                                     'orderby' => 'date',
                                                                     'order' => 'DESC',
                                                                    'tax_query' => array(
                                                                        array(
                                                                            'taxonomy' => 'estructura_premio',
                                                                            'field' => 'term_id',
                                                                            'terms' => $category->term_id
                                                                        )
                                                                    ),
                                                                
                                                                );

                                                                $subpages = new WP_query($args);
                                                                $i = 0;
                                                                //Recorro el arreglo de premios
                                                                if ($subpages->have_posts()):
                                                                    while ($subpages->have_posts()):
                                                                        $subpages->the_post();

                                                                        // Imagen destacada
                                                                        global $post;
                                                                        $thumbID = get_post_thumbnail_id($post->ID);
                                                                        $imgDestacada = wp_get_attachment_url($thumbID);
                                                                        $premio = get_post_meta($post->ID, 'nombrepremio', true);
                                                                        $puesto = get_post_meta($post->ID, 'puesto', true);
                                                                        ?>

                                                                        <div class="col-sm-12 det-premio row">

                                                                            <div class="text-center puesto"><span><b><?= $puesto; ?><b/></span><br>puesto</div>
                                                                            <div class="col-md-offset-1 img-premio" <?php
                                                                            if ($i < 1) {
                                                                                echo "style='height:140px;'";
                                                                            } else {
                                                                                echo "style='height:100px;'";
                                                                            }
                                                                            ?>><img class="img-premio center-block" src="<?= $imgDestacada; ?>"  <?php
                                                                                 if ($i < 1) {
                                                                                     echo "style='height:100px'";
                                                                                 } else {
                                                                                     echo "style='height:75px;'";
                                                                                 }
                                                                                 ?>></div>
                                                                            <div class=" premio"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><?= $premio; ?></div>
                                                                        </div>
                                                                        <img class="img-responsive center-block"  src="<?php echo get_stylesheet_directory_uri() ?><?php
                                                                        if ($i < 1) {
                                                                            echo "/_/img/separador.png";
                                                                        } else {
                                                                            echo "/_/img/Separador3.png";
                                                                        }
                                                                        ?>" >

                                                                        <?php
                                                                        $i++;
                                                                    endwhile;
                                                                else:
                                                                    echo 'Lo sentimos, por el momento no contamos con tours para este destino.';
                                                                endif;

                                                                // reset the query
                                                                wp_reset_postdata();
                                                                ?>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                        }
                                                        ?>
                                                        </div>

                                                        <div class="col-md-12  text-center panel panel-body completo">
                                                            <?php
                                                            if (have_posts()):
                                                                while (have_posts()):
                                                                    the_post();
                                                                    global $post;
                                                                    $thumbID = get_post_thumbnail_id($post->ID);
                                                                    $imgDestacada = wp_get_attachment_url($thumbID);
                                                                    ?>
                                                                    <div class="text-center">  <h4><b><span class="sub" >   <img class="img-responsive ico" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/casa.png" alt="Chania">Para los colegios</span></h4></div>
                                                                    <div class="col-md-offset-1  col-md-3">
                                                                        <div  class="col-md-10">
                                                                            <img class="img-responsive" style="width:120%"  src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/premios.png" alt="Chania">
                                                                        </div>
                                                                        <div class="col-md-1 text-left">
                                                                            <h1>+</h1>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/Libros.png" alt="Chania">
                                                                    </div>
                                                                    <div class="col-md-3" style="margin-top:10px;">
                                                                        <h5><b>< Un trofeo + una colección de libros</b></h5>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                edit_post_link(__('Edit this entry', 'html5reset'), '<p>', '</p>');
                                                                ?>
                                                                <?php
                                                            endwhile;
                                                        endif;
                                                        ?>
                                                        <div class="col-md-12 text-center panel panel-body completo">
                                                            <?php
                                                            if (have_posts()):
                                                                while (have_posts()):
                                                                    the_post();
                                                                    global $post;
                                                                    $thumbID = get_post_thumbnail_id($post->ID);
                                                                    $imgDestacada = wp_get_attachment_url($thumbID);
                                                                    ?>


                                                                    <div id="texto" class="col-md-offset-3 col-lg-6"><p><?php
                                                                            the_content();
                                                                            ?></p></div>

                                                                </div>
                                                                <?php
                                                                edit_post_link(__('Edit this entry', 'html5reset'), '<p>', '</p>');
                                                                ?>
                                                                <?php
                                                            endwhile;
                                                        endif;
                                                        ?>
                                                        <div id="texto" class="col-md-12 text-center">
                                                            <p>Mira el detalle completo de nuestros premios en <u><a target="_blank" class="gris" href="<?php
                                                                                                                     echo get_stylesheet_directory_uri();
                                                                                                                     ?>/pdf/condiciones.pdf" >Términos y condiciones.</a></u></p>
                                                        </div>
                                                        </div>

                                                        </div>


                                                        <?php
                                                        get_footer();
                                                        ?>
