<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <title><?php echo $titulo; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- bootstrap 3.0.2 -->
        <link href="<?= base_url(); ?>plantilla/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome 
        <link href="<?= base_url(); ?>plantilla/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        -->
        <!-- Ionicons -->
        <link href="<?= base_url(); ?>plantilla/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?= base_url(); ?>plantilla/css/morris/morris.css" rel="stylesheet" type="text/css" />

        <!-- Date Picker -->
        <link href="<?= base_url(); ?>plantilla/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?= base_url(); ?>plantilla/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?= base_url(); ?>plantilla/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?= base_url(); ?>plantilla/css/AdminLTE.css?v=1" rel="stylesheet" type="text/css" />
        <!-- jQuery 2.0.2 -->

        <!-- jQuery UI 1.10.3 -->

        <!-- Bootstrap -->
        <script src="<?= base_url(); ?>plantilla/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts
        <script src="<?= base_url(); ?>plantilla///cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
         -->
        <script src="<?= base_url(); ?>plantilla/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- 
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        
        <script src="<?= base_url(); ?>plantilla/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
      
        <script src="<?= base_url(); ?>plantilla/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        
        <script src="<?= base_url(); ?>plantilla/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        
        <script src="<?= base_url(); ?>plantilla/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        
        <link href="<?= base_url(); ?>plantilla/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        
        <script src="<?= base_url(); ?>plantilla/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
       
        <script src="<?= base_url(); ?>plantilla/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
      
        <script src="<?= base_url(); ?>plantilla/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
       
        <script src="<?= base_url(); ?>plantilla/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
      
        <script src="<?= base_url(); ?>plantilla/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

       
        <script src="<?= base_url(); ?>plantilla/js/AdminLTE/app.js" type="text/javascript"></script>

        <script src="<?= base_url(); ?>plantilla/js/AdminLTE/dashboard.js" type="text/javascript"></script>

        
        <script src="<?= base_url(); ?>plantilla/js/AdminLTE/demo.js" type="text/javascript"></script>
        -->
        <script language="JavaScript">
            function aviso(url) {
                if (!confirm("ALERTA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) {
                    return false;
                } else {
                    document.location = url;
                    return true;
                }
            }
        </script>
    </head>

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Administrador 
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="collapse" data-target="#demo">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- Notifications: style can be found in dropdown.less -->

                        <li style="margin-top: 2%;">
                            Estado del sistema: <br><b> Concurso <?Php if (($estadoc!=="cerrado") AND ($estadoc !=="")){  echo $año->año;}?> :  <span style="color:#fff;"><?Php if (($estadoc!=="cerrado") AND ($estadoc !=="")){ echo $estadoc->estado;}else{ echo "Sin concursos";} ?></span></b>
                        </li>    


                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= $user_name; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">


                                <!-- Menu Footer-->
                                <li class="user-footer">

                                    <div class="center-block text-center">
                                        <a href="<?= base_url(); ?>Panel/salir" class="btn btn-default btn-flat">Cerrar Seccion</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <div class="wrapper row-offcanvas row-offcanvas-left"  >

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas collapse in"  id="demo">
                <!-- sidebar: style can be found in sidebar.less -->
                <section>







                    <ul class="nav nav-pills nav-stacked" id="exampleAccordion">
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                            <a class="nav-link" href="<?= base_url(); ?>panel">
                                <i class="fa fa-fw fa-dashboard"></i>Dashboard
                            </a>
                        </li>

                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                            <a class="nav-link" href="<?= base_url(); ?>concurso">

                                <i class="fa fa-cog" aria-hidden="true"></i>Config. Concursos
                            </a>
                        </li>

                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                            <a class="nav-link" href="<?= base_url(); ?>codigos">

                                <i class="fa fa-qrcode" aria-hidden="true"></i>Códigos de concurso
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                            <a class="nav-link" href="<?= base_url(); ?>obras">

                                <i class="fa fa-book" aria-hidden="true"></i>Obras literarias 
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                            <a class="nav-link" href="<?= base_url(); ?>colegios">           
                                <i class="fa fa-briefcase" aria-hidden="true"></i>Colegios
                            </a>
                        </li> 


                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                                <i class="fa fa-file-word-o" aria-hidden="true"></i>Reportes
                            </a>

                            <ul class="collapse" id="collapseMulti">
                                <li>
                                    <a href="<?= base_url(); ?>Panel/r01">Resumen estadístico</a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>Panel/r02">Registros detallados de los participantes</a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>Panel/r03">Inscritos por obra</a>
                                </li>
                                <li>
                                    <a href="<?= base_url(); ?>Panel/r04">Participantes por colegios</a>
                                </li>
                            </ul>
                        </li>

                    </ul> 










                </section> 
                <!-- /.sidebar -->
            </aside>



            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <section class="container">