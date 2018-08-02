<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
?>

<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
    <!-- the "no-js" class is for Modernizr. -->
    <head id="<?php echo of_get_option('meta_headid'); ?>" data-template-set="ID-Peru-Theme-Wordpress">
        <meta charset="UTF-8">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <!-- Always force latest IE rendering engine (even in intranet) -->
        <!--[if IE ]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->
        <?php
        if (is_search())
            echo '<meta name="robots" content="noindex, nofollow" />';
        ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <meta name="title" content="<?php wp_title('|', true, 'right'); ?>">
        <meta name="description" content="<?php bloginfo('description'); ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Mukta+Malar" rel="stylesheet">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel='dns-prefetch' href='//ajax.googleapis.com' />
        <?php
        if (true == of_get_option('meta_author'))
            echo '<meta name="author" content="' . of_get_option("meta_author") . '" />';
        if (true == of_get_option('meta_google'))
            echo '<meta name="google-site-verification" content="' . of_get_option("meta_google") . '" />';
        ?>
        <meta name="Copyright" content="Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.">
        <?php
        /*
          j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag
          - device-width : Occupy full width of the screen in its current orientation
          - initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
          - maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
          - minimal-ui = iOS devices have minimal browser ui by default
         */
        if (true == of_get_option('meta_viewport'))
            echo '<meta name="viewport" content="' . of_get_option("meta_viewport") . ' minimal-ui" />';
        /*
          These are for traditional favicons and Android home screens.
          - sizes: 1024x1024
          - transparency is OK
          - see wikipedia for info on browser support: http://mky.be/favicon/
          - See Google Developer docs for Android options. https://developers.google.com/chrome/mobile/docs/installtohomescreen
         */
        if (true == of_get_option('head_favicon')) {
            echo '<meta name=”mobile-web-app-capable” content=”yes”>';
            echo '<link rel="shortcut icon" sizes=”1024x1024” href="' . of_get_option("head_favicon") . '" />';
        }
        /*
          The is the icon for iOS Web Clip.
          - size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for iPhone4 retina display (IMHO, just go ahead and use the biggest one)
          - To prevent iOS from applying its styles to the icon name it thusly: apple-touch-icon-precomposed.png
          - Transparency is not recommended (iOS will put a black BG behind the icon) -->';
         */
        if (true == of_get_option('head_apple_touch_icon'))
            echo '<link rel="apple-touch-icon" href="' . of_get_option("head_apple_touch_icon") . '">';
        ?>
        <!-- concatenate and minify for production -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reset.css" />


        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/_/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />

        <!-- aqui empieza -->
        <?php wp_head(); ?>
        <!-- aqui termina -->
        <?php
        include_once 'url.php';
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
        $imagen_fondo_izquierda = $settings->field('imagen_fondo_izquierda');
        $imagen_fondo_derecha = $settings->field('imagen_fondo_derecha');
        $posicion_fondo = $settings->field('posicion_fondo');
        $ver_intro = $settings->field('ver_intro');
        ?>

    </head>


    <body class="bounceInUp" <?php body_class(); ?> 
    <?php
    $imgIzqCustom = get_post_meta($post->ID, 'imagen_fondo_01', true);
    $imgDerCustom = get_post_meta($post->ID, 'imagen_fondo_02', true);
    $posicionCustom = get_post_meta($post->ID, 'posicion_custom', true);

    if ($imgIzqCustom || $imgDerCustom) {
        $imgIzq = $imgIzqCustom['guid'];
        $imgDer = $imgDerCustom['guid'];
    } elseif ($imagen_fondo_izquierda || $imagen_fondo_derecha) {
        $imgIzq = $imagen_fondo_izquierda['guid'];
        $imgDer = $imagen_fondo_derecha['guid'];
    }
    if ($posicionCustom) {
        $posicion = $posicionCustom;
    } else {
        $posicion = $posicion_fondo;
    }
    ?>
          style="background:#fff;background-image:url('<?= $imgIzq ?>'),url('<?= $imgDer ?>'); background-attachment: fixed;background-repeat:no-repeat,no-repeat;background-position:left <?= $posicion ?>%,right <?= $posicion ?>%;">
    <?php include_once("googletagmanager.php") ?>
        <section id="top-header" class="hidden-xs">
            <div class="container-fluid">
                <div class="row-full clearfix">

                    <span class="top-logo"></span>

                    <div class="menu-top">
                        <ul>
                            <li>
                                <a href="<?php echo $url; ?>">Página principal</a>
                            </li>
                        </ul>
                    </div>
                    <div class="rd">
<?php echo $texto_legal; ?>
                    </div>
                </div>
            </div>
        </section>
        <header id="header" class="clearfix">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <nav class="navbar" role="navigation">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                </div>
                                <div class="w-print">
                                    <a href="<?php echo $url; ?>reimprimir//" class="print">
                                        Reimprimir<br/>certificado
                                    </a>
                                </div>
                                <div id="navbar-desktop" class="navbar-collapse hidden-xs">
                                    <nav id="nav" role="navigation" class="hidden-xs">
<?php
wp_nav_menu(
        array(
            'theme_location' => 'primary',
            'menu_class' => 'nav nav-pills center-block text-center',
            'container' => '',
            'walker' => new wp_bootstrap_navwalker(),
        )
);
?>
                                    </nav>

                                    <a class="intro" data-toggle="modal" data-target="#myModal" <?php if ($ver_intro == 1) {
                                            echo 'style="display:none;"';
                                        } ?>>
                                        Ver intro 
                                    </a>
                                </div>

                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row row-navmobile">
                    <div class="col-xs-12 col-md-12">
                        <div id="navbar" class="navbar-collapse collapse">					
                            <nav id="nav-mobile" role="navigation" class="visible-xs-block">
                                <?php
                                wp_nav_menu(
                                        array(
                                            'theme_location' => 'main-mobile',
                                            'menu_class' => 'nav',
                                            'container' => '',
                                        )
                                );
                                ?>
                                <ul>
                                    <li class="intro menu-item menu-item-type-post_type menu-item-object-page">
                                        <a data-toggle="modal" data-target="#myModal" <?php if ($ver_intro == 1) {
                                    echo 'style="display:none;"';
                                } ?>>Ver intro</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </header>

