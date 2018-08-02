<?php 
 include_once 'url.php';
 include_once 'conexion.php';
 $settings = pods('datos_del_sitio');
 $ganador =  $settings->field('ganador');
 if($ganador!=1){echo "<script>location.href ='".$url."ganador/';</script>";}

/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
get_header();
?>

<?php
$con = conexion();
$final="";
$premiacion="";
$sql = "SELECT * FROM concurso WHERE  `estado`='creado' OR `estado`='iniciado'  OR `estado`='finalizado'";
                        
                        foreach ($con->query($sql) as $row) {
                            $final = $row['fecha_final'];
                            $premiacion = $row['fecha_premiacion'];
} 
?>
<script>
// Set the date we're counting down to
    var countDownDate = new Date("<?php echo $final ?>").getTime();

// Update the count down every 1 second
    var x = setInterval(function () {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("falta").innerHTML = "<div class='col-md-3'><div  id='NEGROBORDE' class='text-center'><div class='col-md-12'><h2><b>" + days + " </b></h2></div><div class='col-md-12 color'><b>D&Iacute;AS</b></div></div></div><div class='col-md-3'><div  class=' text-center' id='NEGROBORDE'><div class='col-md-12'><h2><b>" + hours + "  </b></h2></div><div class='col-md-12 color'><b>HORAS</b></div></div></div><div class='col-md-3'><div  class=' text-center' id='NEGROBORDE'><div class='col-md-12'><h2><b>" + minutes + "  </b></h2></div><div class='col-md-12 color'><b>MINUTOS</b></div></div></div><div class='col-md-3'><div  class=' text-center' id='NEGROBORDE'><div class='col-md-12'><h2><b>" + seconds + "  </b></h2></div><div class='col-md-12 color'><b>SEGUNDOS</b></div></div></div>";
        
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("falta").innerHTML = "EXPIRADO";
        }
    }, 1000);
</script>

<div class="col-md-offset-1 col-md-10" id="ganadores">
    <div class="row clearfix center-block">

        <!--TITULO-->
        <div class="row text-center">
            <h1>Ganadores</h1>
        </div>

        <!--SUBTITULO -->
        <div class="row text-center">
            <h3><b> Faltan </b></h3>
        </div>
        <!-- FALTAN -->
        <div class="col-md-2"><img style="display:inline;"class="img-responsive ico" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/reloj.png" alt="Chania"></div>
        <div class="col-sm-8 center-block text-center" id="falta"></div>
        <div class="col-md-2"><img style="display:inline;"class="img-responsive ico" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/reloj2.png" alt="Chania"></div> 
        <!-- DATOS -->
        <div class="text-center"><h1>para el cierre del concurso.</h1></div>
        <div class="row">
            <div class="col-md-offset-2 col-md-5">
                Fecha de cierre para la entrega de trabajos:</div> <div id="texto" class="col-md-3 text-right" ><b><?php echo $final ?></b>
            </div>
            <div class="col-md-offset-2 col-md-5">
                Fecha de premiación: </div><div id="texto" class='col-md-3' style="text-align:right"><b><?php echo $premiacion ?></b>
            </div>
        </div>
        <!-- BOTONES -->
        <!-- DATOS -->
        <div class="row botones">
            <div id="sep"><br></div>
            <div class="col-md-offset-2  col-md-4 text-center" style="margin-top:20px;">
                <a href="<?php echo $url; ?>inscribirse/" class="btn btn-block">Regístrate</a>
            </div>
            <div class="col-md-4" style="margin-top:20px;">
                <a href="<?php echo $url ?>premios/" class="btn secun btn-block">Premios</a>
            </div>
        </div>
        <!-- TERMINOS Y CONDICIONES -->
        <div class="col-md-12 text-center"><br><br>
            <u><a target="_blank" class="gris" href="<?php echo get_stylesheet_directory_uri() ?>/pdf/condiciones.pdf" >Términos y condiciones</a></u>
        </div>


    </div>
</div>

<?php get_footer(); ?>