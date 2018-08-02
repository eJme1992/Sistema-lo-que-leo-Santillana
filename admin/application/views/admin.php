<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $titulo; ?></title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?= base_url(); ?>plantilla/web/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>plantilla/web/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>plantilla/web/css/form-elements.css">
        <link rel="stylesheet" href="<?= base_url(); ?>plantilla/web/css/style1.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?= base_url(); ?>plantilla/web/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url(); ?>plantilla/web/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>plantilla/web/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>plantilla/web/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>plantilla/web/ico/apple-touch-icon-57-precomposed.png">

    </head>
    <script>
        function realizaProceso(enviar, user, pass) {
            var parametros = {
                "enviar": enviar,
                "user": user,
                "pass": pass,

            };


            $.ajax({
                data: parametros, //datos que se envian a traves de ajax
                url: '<?= base_url(); ?>Admin/ingreso', //archivo que recibe la peticion
                type: 'post', //método de envio
                beforeSend: function () {
                    $("#resultado").html("<div class='alert alert-success'> Procesando, espere por favor...</div>");
                },
                success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    var str = response;
                    var json = JSON.parse(str);
                    if (json.status == "ok") {
                        location.href ='panel';
                        console.log(response);
                    } else {
                        $("#resultado").html(json.error);
                    }
                }
            });
        }
    </script>
    <body style="background-image: url('<?= base_url(); ?>plantilla/web/img/fondo1.jpg'); ">

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">

                            <div class="description">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <img class="img-responsive" src="<?= base_url(); ?>plantilla/web/img/Logo.png" alt="Chania">
                                    <p>Ingrese sus datos de acceso para entrar en el panel de control</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form onsubmit="realizaProceso(
                                                $('#enviar').val(),
                                                $('#user').val(),
                                                $('#pass').val()
                                                );
                                        return false;
                                      ">  

                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Usuario</label>
                                        <input type="text" placeholder="Usuario..." class="form-username form-control" name="user" id="user" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Clave</label>
                                        <input type="password"  placeholder="Clave..." class="form-password form-control" name="pass" id="pass" required/>
                                    </div>
                                    <div class="col-md-12" style="margin-top:2%;" id="resultado"></div>
                                    <button type="submit" style="margin-top:2%;" name="enviar" id="enviar" class="btn">Ingresar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="<?= base_url(); ?>plantilla/web/js/jquery-1.11.1.min.js"></script>
        <script src="<?= base_url(); ?>plantilla/web/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>plantilla/web/js/jquery.backstretch.min.js"></script>
        <script src="<?= base_url(); ?>plantilla/web/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="<?= base_url(); ?>plantilla/web//js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>