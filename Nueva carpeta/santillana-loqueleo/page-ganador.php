<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0

 */
get_header();
?>


<div class="container" id="ganador">
    <!-- prueba -->

    <div class="navbar col-md-offset-1 col-md-12 text-center">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <i class="fa fa-align-justify"></i>                       
      </button>
     
    </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul  class="navbar-nav  center-block">
            <li class="active AMARILLA">
                <a  href="#AMARILLABORDE" data-toggle="tab">Seccion:<br>Amarilla</a>
            </li>
            <li class="MORADA"><a href="#MORADABORDE" data-toggle="tab">Seccion:<br>Morada</a>
            </li>
            <li class="NARANJA"><a href="#NARANJABORDE" data-toggle="tab">Seccion:<br>Naranja</a>
            </li>
            <li class="AZUL"><a href="#AZULBORDE" data-toggle="tab">Seccion:<br>Azul</a>
            </li>
            <li class="JUVENIL"><a href="#JUVENILBORDE" data-toggle="tab">Seccion:<br>Juvenil</a>
            </li>
        </ul>
        </div>

    </div>


    <div class="tab-content">
        <?php
        $args = array(
            'post_type' => 'obras_literarias',
            'orderby' => 'date',
            'order' => 'asc',
            'posts_per_page' => -1
        );
        $i = 0;
        $actual = 0;


        $terms = get_terms(array(
            'taxonomy' => 'series',
            'hide_empty' => false,
        ));

        foreach ($terms as $row) {
            ?>






            <div id="<?php echo $row->name; ?>BORDE" class="panel-body panel tab-pane fad <?php if( $row->name=='AMARILLA'){echo 'in active';} ?> col-md-12">  
            <div id="<?php echo $row->name; ?>">
                <?php
                $args = array(
                    'post_type' => 'ganadores',
                    'orderby' => 'date',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'series',
                            'field' => 'term_id',
                            'terms' => $row->term_id
                        )
                    ),
                    'order' => 'asc'
                );

                $subpages = new WP_query($args);

                if ($subpages->have_posts()):
                    while ($subpages->have_posts()):
                        $subpages->the_post();
                        global $post;

                         $obra = get_post_meta($post->ID, 'obra', true);
                         $obraNombre = $obra['post_title'];
                         $thumbID = get_post_thumbnail_id($obra['ID']);
                         $obra_img = wp_get_attachment_url($thumbID);
                         
                         $colegio1 = get_post_meta($post->ID, '1_colegio', true);
                         $estudiante1 = get_post_meta($post->ID, '1_estudiante', true);
                         $profesor1 = get_post_meta($post->ID, '1_profesor', true);
                         
                         $colegio2 = get_post_meta($post->ID, '2_colegio', true);
                         $estudiante2 = get_post_meta($post->ID, '2_estudiante', true);
                         $profesor2 = get_post_meta($post->ID, '2_profesor', true);
                        ?>


                        
                        <div class="row col-md-12">
                            <div class="col-md-12 text-left"><h3><?php echo $obraNombre; ?></h3></div>
                           
                            <div class="col-lg-3">
                                   <img width="200" src="<?= $obra_img ?>" class="img-responsive img-thumbnail img-rounded" alt="obra">
                               </div>
                               <div class="col-lg-6">
                                   <table class="table1" WIDTH="100%" height="160">
                                       <tr height="135" >
                                           <td class="text-center">
                                               <h2><b>1er</b></h2>
                                               <h5>Puesto<h5>
                                           </td>
                                           <td>
                                               <table WIDTH="100%">
                                                   <tr>
                                                       <td WIDTH="50%"><h5><b>Colegio:</b></h5></td>  <td WIDTH="50%"><h5><?= $colegio1  ;?></h5></td>
                                                   </tr>
                                                   <tr>
                                                       <td WIDTH="50%"><h5><b>Estudiante:</b></h5></td>  <td WIDTH="50%"><h5><?= $estudiante1  ;?></h5></td>
                                                   </tr>
                                                   <tr>
                                                       <td WIDTH="50%"><h5><b>Docente:</b></h5></td>  <td WIDTH="50%"><h5><?= $profesor1  ;?></h5></td>
                                                   </tr>
                                               </table>
                                           </td>
                                       </tr>
                                       
                                         <tr height="80">
                                             <td class="text-center">
                                              <h2><b>2do</b></h2>
                                              <h5>Puesto<h5>
                                           </td>
                                           <td>
                                               <table WIDTH="100%">
                                                   <tr>
                                                       <td WIDTH="50%"><h5><b>Colegio:</b></h5></td>  <td WIDTH="50%"><h5><?= $colegio2  ;?></h5></td>
                                                   </tr>
                                                   <tr>
                                                       <td WIDTH="50%"><h5><b>Estudiante:</b></h5></td>  <td WIDTH="50%"><h5><?= $estudiante2  ;?></h5></td>
                                                   </tr>
                                                   <tr>
                                                       <td WIDTH="50%"><h5><b>Docente:</b></h5></td>  <td WIDTH="50%"><h5><?= $profesor2  ;?></h5></td>
                                                   </tr>
                                               </table>
                                           </td>
                                       </tr>
                                   </table>
                               </div>
                            
                            
                            
                            
                            
                            
                      
                        </div>
                           
            


                    <?php
                    $i++;
                endwhile;
            else:
                echo 'Lo sentimos, por el momento no contamos con ganadores.';
            endif;

            // reset the query
            wp_reset_postdata();
            ?>
            </div>
                    </div>
        <?php } ?>
    </div>

    
    <div class="text-center"><h1>Galeria de fotos:</h1>
   <?php echo do_shortcode('[WRGF id=327]');  ?>
    </div>
</div>

 
















<?php get_footer(); ?>
