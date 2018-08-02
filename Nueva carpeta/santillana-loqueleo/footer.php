<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
?>
<?php
$settings = pods('datos_del_sitio');
$facebook = $settings->field('facebook');
$twitter = $settings->field('twitter');
$instagram = $settings->field('instagram');
$youtube = $settings->field('youtube');
$googleplus = $settings->field('google_plus');
$telefono = $settings->field('telefono');
$anexo = $settings->field('anexo');
$texto_legal = $settings->field('texto_legal');
$imagen_intro = $settings->field('imagen_intro');
$video_intro = $settings->field('video_intro');
?>
<footer id="footer" class="col-md-12">		
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-6">		
                <div class="logo_santillana">
                    <a>
                        <img src="<?php echo get_template_directory_uri(); ?>/_/img/logo_santillana.png">
                    </a>
                </div>
                <div class="menu">
                    <?php
                    //wp_nav_menu( 
                    //array(
                    //	'theme_location' => 'footer_one', 
                    //	'menu_class' => '',
                    //	'container' => '',
                    //	) 
                    //	); 
                    ?>
                </div> 
            </div>
            <div class="col-md-6 text-right">		
                <div class="consultas">
                    <div class="block block1">
                        <div class="text"><span><b>Consultas</b></span></div>
                        <div class="num"><span><?php echo $telefono; ?></span></div>
                    </div>
                    <div class="block">
                        <div class="text"><span><b>Anexo</b></span></div>
                        <div class="num small"><span><?php echo $anexo; ?></span></div>
                    </div>
                </div>
                <div class="social">
                  <!--  <span>Comparte:</span>
                    <ul>
                            <!--<li><a class="mail" href="#"><i class="fa fa-envelope"></i></a></li>
                            <li><a class="fb" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="tw" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li>   <?php echo do_shortcode('[wpusb]'); ?> </li>
                    </ul>-->
                    <a target="_blank" href="<?=$facebook?>">    
              <i class="fab fa-facebook-square fa-3x"></i>
                </a>
                     <a target="_blank"  href="mailto:libreriasperu@santillana.com">  
              <i class="fas fa-envelope fa-3x"></i>
              </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
<?php if ($video_intro !== '') { ?> <div class="center-block  col-md-12 ">
                        <iframe class="center-block" width="100%" height="280" src="https://www.youtube.com/embed/<?= $video_intro; ?>" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                    </div> <?php } ?>
                <?php if ($imagen_intro !== NULL) { ?> 
                    <img class="img-responsive center-block" src="<?php echo $imagen_intro["guid"]; ?>" />
<?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

<!-- Lea Verou's Prefix Free, lets you use only un-prefixed properties in yuor CSS files
<script src="<?php echo get_template_directory_uri(); ?>/_/js/prefixfree.min.js"></script> -->

<!-- This is an un-minified, complete version of Modernizr.
         Before you move to production, you should generate a custom build that only has the detects you need. -->
<script src="<?php echo get_template_directory_uri(); ?>/_/js/modernizr-2.8.0.dev.js"></script>

<!-- jQuery is called via the WordPress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_directory'); ?>/_/js/bootstrap.min.js"></script>

</body>

</html>
