<script>
    if (history.forward(1)) {
        location.replace(history.forward(1))
    }
</script>

<?PHP
include_once 'url.php';
header('Content-Type: text/html; charset=UTF-8');
if (isset($_POST['code'])) {
    $code = $_POST['code'];
} else {
    echo "<script>location.href ='" . $url . "inscribirse/';</script>";
}
?>


<?php
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
get_header();
include_once 'conexion.php';
$con = conexion();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // La pagina ya expiró
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Fue modificada
header("Cache-Control: no-cache, must-revalidate"); // Evitar guardado en cache del cliente HTTP/1.1
header("Pragma: no-cache"); // Evitar guardado en cache del cliente HTTP/1.0
  $SQL = "SELECT id  FROM `concurso` WHERE `estado`='iniciado' OR `estado`='creado'";
  $id = $con->query($SQL);
  foreach ($id AS $row){
     $idc = $row['id'];
  }
$sql = "SELECT * FROM `codigo` WHERE `status`='2' AND `code`='$code' AND id_concurso='$idc'";
// var_dump($sql);
$VG = $con->query($sql);
$VG = $VG->fetch();
if ($VG != FALSE) {
    echo "<script>location.href ='" . $url . "inscribirse/';</script>";
}
?>
<script>
    var tipobra;
    var forma = "digital";
    var sexo = "M";
    function habilitar() {
        forma = "digital";
        $("#documento1").prop('disabled', false);
        $("#documento2").prop('disabled', false);
        $("#video").prop('disabled', false);
        $("#mensaje").hide();
        $("#archivos2").hide();
        document.getElementById('archivos').style.display = 'block';
    }

    function desabilitar() {
        forma = "Fisica";
        $("#documento1").prop('disabled', true);
        $("#documento2").prop('disabled', true);
        $("#video").prop('disabled', true);
        $("#archivos").hide();
        $("#archivos2").hide();
        document.getElementById('mensaje').style.display = 'block';
    }
    function m() {
        sexo = "M";
    }

    function f() {
        sexo = "F";
    }
    function ocultar() {

        var nombre = $('#nombre').val();
        var apellido_p = $('#apellido_p').val();
        var apellido_m = $('#apellido_m').val();
        var dni = $('#dni').val();


        var telefono = $('#telefono').val();

        var grado = $('#grado').val();

        var pdni = $('#pdni').val();
        var pnombre = $('#pnombre').val();
        var papellido_p = $('#papellido_p').val();
        var papellido_m = $('#papellido_m').val();
        var ptelefono = $('#ptelefono').val();
        var pcelular = $('#pcelular').val();

        var msj = '1';

        if (pcelular === '') {
            msj = "El campo  'Celular' del padre, madre o apoderado  es requerido "
        }
        //if (ptelefono === '') {
        //msj = "El campo  Teléfono del padre, madre o apoderado es requerido"
        //}
        if (papellido_m === '') {
            msj = "El campo  'Apellido materno' del padre, madre o apoderado  es requerido ";
        }
        if (papellido_p === '') {
            msj = "El campo  'Apellido paterno' del padre, madre o apoderado  es requerido ";
        }
        if (pnombre === '') {
            msj = "El campo  'Nombre' del padre, madre o apoderado  es requerido ";
        }
        if (pdni === '') {
            msj = "El campo  'DNI' de padre, madre o apoderado es requerido";
        }
      if (pdni.length > 12) {
       msj = "El DNI/C.E debe tener máximo 12 caracteres";
       }
       if (/^\d[0-9]$/.test(pdni)){
       msj = "El DNI/C.E debe tener solo Numeros";
       }
        if (grado === '') {
            msj = "Falta seleccionar el grado del estudiante es requerido";
        }

        if (telefono === '') {
            msj = "El campo 'Teléfono' del estudiante es requerido";
        }
        if (apellido_m.length == 0 || /^\s+$/.test(apellido_m)) {
            msj = "El campo 'Apellido Materno' del estudiante es requerido";
        }

        if (apellido_p == "" || /^\s+$/.test(apellido_p)) {
            msj = "El campo 'Apellido paterno' del estudiante es requerido";
        }
        if (nombre == "" || /^\s+$/.test(nombre)) {
            msj = "El campo 'Nombre' del estudiante es requerido";
        }
        if (dni === '') {
            msj = "El campo  'DNI' del estudiante es requerido";
        }
      if (/^\d[0-9]$/.test(dni)){
       msj = "El DNI/C.E debe tener solo Numeros";
       }
       if (dni.length > 12) {
       msj = "El DNI/C.E debe tener máximo 12 caracteres";
       }

        //if (correo === '') {
        //   msj = "El campo  Correo del estudiante";
        // }
        // if( !(/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test(correo)) ) {msj = "El correo del estudiante esta errado"}

        //  if (!(/^\d{7}$/.test(telefono))) {
        //      msj = "El teléfono del estudiante esta errado"
        //  }

        //  if (!(/^\d{7}$/.test(ptelefono))) {
        //    msj = "El teléfono del padre, madre o apoderado  esta errado"
        //}

        //if (!(/^\d{9}$/.test(pcelular))) {
        //  msj = "El teléfono celular del padre, madre o apoderado  esta errado"
        //}

        //Las validaciones que necesitas hacer
        if (msj === "1") {
            $("#registrar1").hide();
            document.getElementById('registrar2').style.display = 'block';
        } else {
            swal("¡Error! ", msj, "error");

        }

    }

    function regresar() {
        $("#registrar2").hide();
        document.getElementById('registrar1').style.display = 'block';
    }

    $(document).ready(function () {




        $("#departamento").change(function (event) {
            var id = $("#departamento").find(':selected').val();
            // $("#provincia").load('<?php echo $url; ?>backoffice/Regiones/select?id=' + id);
            $.get('<?php echo $url; ?>backoffice/Regiones/select?id=' + id, function (data) {
                var texto = data;
                var textoUtf8 = "";
                try {
                    textoUtf8 = decodeURIComponent(escape(texto));
                } catch (err) {
                    //alert(err.message);
                    textoUtf8 = texto;
                }
                $("#provincia").html(textoUtf8);
            });
        });


        $("#provincia").change(function (event) {
            var id = $("#provincia").find(':selected').val();
            //$("#distrito").load('<?php echo $url; ?>backoffice/Regiones/select?id2=' + id);
            $.get('<?php echo $url; ?>backoffice/Regiones/select?id2=' + id, function (data) {
                var texto = data;
                var textoUtf8 = "";
                try {
                    textoUtf8 = decodeURIComponent(escape(texto));
                } catch (err) {
                    //alert(err.message);
                    textoUtf8 = texto;
                }
                $("#distrito").html(textoUtf8);
            });
        });

        $("#distrito").change(function (event) {
            var id = $("#distrito").find(':selected').val();
            // $("#colegio").load('<?php echo $url; ?>backoffice/Regiones/select?id3=' + id);
            $.get('<?php echo $url; ?>backoffice/Regiones/select?id3=' + id, function (data) {
                var texto = data;
                var textoUtf8 = "";
                try {
                    textoUtf8 = decodeURIComponent(escape(texto));
                } catch (err) {
                    //alert(err.message);
                    textoUtf8 = texto;
                }
                $("#colegio").html(textoUtf8);
            });
        });

        $("#obra").change(function (event) {
            var id = $("#obra").find(':selected').val();
            $.ajax({

                url: '<?php echo $url; ?>backoffice/Regiones/select?id4=' + id, //archivo que recibe la peticion
                type: 'get', //método de envio
                beforeSend: function () {


                },
                success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve

                    if (response == 1) {
                        tipobra = response;
                        $("#archivos1").hide();
                        $("#archivos2").hide();
                        $("#documento1").prop('disabled', true);
                        $("#documento2").prop('disabled', true);
                        $("#video").prop('disabled', true);
                        document.getElementById('mensaje1').style.display = 'block';
                    }

                    if (response == 2) {
                        tipobra = response;
                        $("#mensaje1").hide();
                        $("#archivos2").hide();
                        $("#documento1").prop('disabled', false);
                        $("#documento2").prop('disabled', false);
                        $("#video").prop('disabled', true);
                        document.getElementById('archivos1').style.display = 'block';
                        document.getElementById('archivos').style.display = 'block';
                    }

                    if (response == 3) {
                        tipobra = response;
                        $("#archivos").hide();
                        $("#archivos1").hide();
                        $("#mensaje1").hide();
                        $("#video").prop('disabled', false);
                        $("#documento1").prop('disabled', true);
                        $("#documento2").prop('disabled', true);
                        document.getElementById('archivos2').style.display = 'block';

                    }



                }

            });
        });

        // $("#colegio").change(function(event) {
        //             var id = $("#colegio").find(':selected').val();
        // $.ajax({

        //     url: 'http://serviciosdigitalesperu.com/loqueleo/backoffice/Registroes/colegio/' + id, //archivo que recibe la peticion
        //     type: 'get', //método de envio
        //     beforeSend: function() {
        //         $('#docente').val('Cargando..');
        //         $('#correo_d').val('Cargando..');
        //     },
        //     success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
        //         var str = response;
        //         var json = JSON.parse(str);
        //         $('#docente').val(json.docente),
        //             $('#correo_d').val(json.correo),
        //             console.log(response);

        //     }

        // });


        //    });.
    });

    function realizaProceso(departamento, distrito, provincia, colegio, docente) {

        var msj = '1';

        //VALIDACION DE URL SI LA OBRA SELECCIONADA ES VIDEO
        if (tipobra == 3) {
            forma = "video";
            if ($('#video').prop('value') === "") {
                msj = "El campo  'URL de su video' es requerido ";
            }
        }

        if (tipobra == 2) {
            if (forma === 0) {
                msj = "El campo 'forma de entrega'  es requerido ";
            }
        }

        if (tipobra == 1) {
            forma = "Fisica";
        }

        if ($('#correo_d').prop('value') !== '') {
            if (!(/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test($('#correo_d').prop('value')))) {
                msj = "El correo del docente fue escrito incorrectamente"
            }
        }

        if (docente === '') {
            msj = "El campo  'Docente' es requerido";
        }

        if (colegio == 0) {
            msj = "El campo 'Colegio' es requerido";
        }
        if (distrito == 0) {
            msj = "El campo  Distrito es requerido";
        }
        if (provincia == 0) {
            msj = "El campo  Provincia es requerido";
        }
        if (departamento == 0) {
            msj = "El campo  Departamento es requerido";
        }

        //SI LAS VALIDACIONES ESTA CORRECTAS
        if (msj === "1") {

            $("#send").prop('disabled', true);

            // Evitamos que salte el enlace.
            /* Creamos un nuevo objeto FormData. Este sustituye al
             atributo enctype = "multipart/form-data" que, tradicionalmente, se
             incluía en los formularios (y que aún se incluye, cuando son enviados
             desde HTML. */
            var paqueteDeDatos = new FormData();

            paqueteDeDatos.append('nombre', $('#nombre').prop('value'));
            paqueteDeDatos.append('apellido_p', $('#apellido_p').prop('value'));
            paqueteDeDatos.append('apellido_m', $('#apellido_m').prop('value'));
            paqueteDeDatos.append('dni', $('#dni').prop('value'));
            paqueteDeDatos.append('code', $('#code').prop('value'));
            paqueteDeDatos.append('telefono', $('#telefono').prop('value'));
            paqueteDeDatos.append('sexo', sexo);
            paqueteDeDatos.append('grado', $('#grado').prop('value'));
            paqueteDeDatos.append('pdni', $('#pdni').prop('value'));
            paqueteDeDatos.append('pnombre', $('#pnombre').prop('value'));
            paqueteDeDatos.append('papellido_p', $('#papellido_p').prop('value'));
            paqueteDeDatos.append('papellido_m', $('#papellido_m').prop('value'));
            paqueteDeDatos.append('ptelefono', $('#ptelefono').prop('value'));
            paqueteDeDatos.append('pcelular', $('#pcelular').prop('value'));
            paqueteDeDatos.append('departamento', $('#departamento').prop('value'));
            paqueteDeDatos.append('distrito', $('#distrito').prop('value'));
            paqueteDeDatos.append('provincia', $('#provincia').prop('value'));
            paqueteDeDatos.append('colegio', $('#colegio').prop('value'));
            paqueteDeDatos.append('docente', $('#docente').prop('value'));
            paqueteDeDatos.append('correo_d', $('#correo_d').prop('value'));
            paqueteDeDatos.append('forma', forma);
            paqueteDeDatos.append('obra', $('#obra').prop('value'));
            paqueteDeDatos.append('documento1', $('#documento1')[0].files[0]);
            paqueteDeDatos.append('documento2', $('#documento2')[0].files[0]);
            paqueteDeDatos.append('video', $('#video').prop('value'));

            $.ajax({
                url: '<?php echo $url; ?>backoffice/Registroes/registrar', //archivo que recibe la peticion
                type: 'post', //método de envio
                contentType: false,
                data: paqueteDeDatos, //datos que se envian a traves de ajax
                processData: false,
                cache: false,

                beforeSend: function () {
                    $("#resultado").html("<div class='center-block alert alert-success'> Procesando, espere por favor...<i class='fa fa-sync fa-spin'></i></div>");
                },
                success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                    var str = response;
                    var json = JSON.parse(str);
                    if (json.status == "ok") {
                        swal("¡Felicitaciones ! ", json.mensaje);
                        $("#resultado").html("<div class='center-block alert alert-success'> " + json.mensaje + ".</div>");
                        $('#id_registro').val(json.id_registro),
                                $('#tipo').val(json.tipo),
                                $('#token').val(json.token),
                                $('#enviar').click();
                        console.log(response);
                    } else {
                        $("#send").prop('disabled', false);
                        $("#resultado").html('<div class="center-block alert alert-danger"><strong>¡ERROR! </strong>' + json.error + '.</div>');
                    }
                }


            });

        } else {
            swal("¡Error! ", msj, "error");
        }
    }

</script>

<script>
    window.addEventListener('load', function () {
        $("#obra").load("<?php echo $url; ?>backoffice/Regiones/obras");

        //  $("#departamento").load("<?php echo $url; ?>backoffice/Regiones/Depar");



        $.get("<?php echo $url; ?>backoffice/Regiones/Depar", function (data) {
            var texto = data;
            var textoUtf8 = "";
            try {

                textoUtf8 = decodeURIComponent(escape(texto));

            } catch (err) {
                //alert(err.message);

                textoUtf8 = texto;
            }
            $("#departamento").html(textoUtf8);
        });

        $.get("<?php echo $url; ?>backoffice/Regiones/obras", function (data) {
            var texto = data;
            var textoUtf8 = "";
            try {

                textoUtf8 = decodeURIComponent(escape(texto));

            } catch (err) {
                //alert(err.message);

                textoUtf8 = texto;
            }
            $("#obra").html(textoUtf8);
        });

    }, false);
</script>
<div style="display:none;">
    <form action="<?php echo $url; ?>certificado/" method="post">
        <input type="hidden" value="" name="id_registro" id="id_registro">
        <input type="hidden" value="" name="tipo" id="tipo">
        <input type="hidden" value="" name="token" id="token">
        <input type="submit" name="enviar" id="enviar">
    </form>
</div>
<div class="container" id="registrar1">
    <input type="hidden" name="code" id="code" value="<?php echo $code; ?>">
    <div class="text-center">
        <h1>Registro: Paso 2</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4><img class="img-responsive ico" style="width:23px" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/chupeta.png" alt="Chania">
                Datos del estudiante
            </h4>
            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">DNI/C.E:</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" id="dni" name="dni"  maxlength="12">
                    <div id="dnib"></div>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Nombre(s):</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="nombre" name="nombre" maxlength="18">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Apellido paterno:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="apellido_p" name="apellido_p" maxlength="18">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Apellido materno:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="apellido_m" name="apellido_m" maxlength="18">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Teléfono:</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" id="telefono" name="telefono"  maxlength="9">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Sexo:</label>
                <div class="col-sm-7">
                    <label class="radio-inline"><input type="radio" onclick="m()" name="sexo" id="sexo" checked>Masculino</label>
                    <label class="radio-inline"><input type="radio" onclick="f()" name="sexo" id="sexo">Femenino</label>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Grado:</label>
                <div class="col-sm-7">
                    <select class="form-control" id="grado" name="grado">
                        <option>1.&#176; de primaria</option>
                        <option>2.&#176; de primaria</option>
                        <option>3.&#176; de primaria</option>
                        <option>4.&#176; de primaria</option>
                        <option>5.&#176; de primaria</option>
                        <option>6.&#176; de primaria</option>
                        <option>1.&#176; de secundaria</option>
                        <option>2.&#176; de secundaria</option>
                        <option>3.&#176; de secundaria</option>
                        <option>4.&#176; de secundaria</option>
                        <option>5.&#176; de secundaria</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div>  <h4><img class="img-responsive ico"  width="80" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/mono.png" alt="Chania">
                    Datos del padre, de la madre o del apoderado
                </h4></div>
            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">DNI/C.E:</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" id="pdni" name="pdni" maxlength="12">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Nombre(s):</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="pnombre" name="pnombre" maxlength="24" >
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Apellido paterno:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="papellido_p" name="papellido_p" maxlength="25">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Apellido materno:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="papellido_m" name="papellido_m" maxlength="25">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Teléfono fijo:</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" id="ptelefono" name="ptelefono" maxlength="9">
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Celular:</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" id="pcelular" name="pcelular" maxlength="9">
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-12 text-center ">
        <div class="col-md-12" style="" id="respuesta"></div>
        <a name="ocultar" id="ocultar" class="btn" onclick="ocultar()">Siguiente</a>
    </div>
</div>
<!-- PASO 3 -->
<div class="container" id="registrar2" style="display:none; margin-top:-3%">
    <!--style="display:none;"-->
    <div class="text-center">
        <h1>Registro: Paso 3</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4><img class="img-responsive ico" width="80" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/planeta.png" alt="Chania">
                Datos del colegio
            </h4>
            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Región:</label>
                <div class="col-sm-7">
                    <select class="form-control text" id="departamento" name="departamento">

                    </select>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Provincia:</label>
                <div class="col-sm-7">
                    <select class="form-control text" id="provincia" name="provincia">
                    </select>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Distrito:</label>
                <div class="col-sm-7">
                    <select class="form-control text" id="distrito" name="distrito">
                    </select>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Colegio:</label>
                <div class="col-sm-7">
                    <select class="form-control text" id="colegio" name="colegio">
                    </select>
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Docente encargado:</label>
                <div class="col-sm-7">
                    <input type="TEXT" class="form-control text" id="docente" name="docente" maxlength="100" >
                </div>
            </div>

            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Correo del docente:</label>
                <div class="col-sm-7">
                    <input type="email" class="form-control text" id="correo_d" name="correo_d">
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <h4><img class="img-responsive ico" width="80" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/luz.png" alt="Chania">
                Datos de la obra
            </h4>
            <div class="col-md-12">
                <p>Indícanos el libro con el que participarás y sube tu trabajo. Si es en físico, entrégalo a tu profesora o profesor, y lo recogeremos en tu colegio.</p>
            </div>
            <div class="col-md-12 form-group">
                <label class="control-label col-md-5">Obra:</label>
                <div class="col-sm-7">
                    <select class="form-control text" id="obra" name="obra">

                    </select>
                </div>
            </div>
            <div class="col-md-12" id="mensaje1" style="display:none;" >
                <p>Ahora, entrega tu trabajo terminado al profesor/a. Recuerda incluir tus datos personales al reverso. Un representante de Santillana recogerá tu trabajo en el colegio.</p>
            </div>
            <div id="archivos1" style="display:none;" >
                <div class="col-md-12 form-group" style="margin-top:2%; margin-bottom:2%;">
                    <label class="control-label col-md-5">Forma de entrega:</label>
                    <div class="col-sm-7">
                        <label class="radio-inline"><input type="radio" id="forma" onclick="habilitar()" name="forma" checked>Envío virtual.</label><br>
                        <label class="radio-inline"><input type="radio"  id="forma" onclick="desabilitar()" name="forma">Entrega al profesor/a.</label>
                    </div>
                </div>
                <div class="col-md-12" id="mensaje" style="display:none;" >
                    <p>Ahora, entrega tu trabajo terminado al profesor/a. Recuerda incluir tus datos personales al reverso. Un representante de Santillana recogerá tu trabajo en el colegio.</p>
                </div>
                <div id="archivos">
                    <div class="col-md-12">
                        <p>Convierte tu trabajo en formato PDF, JPG o Word para que puedas cargarlo vía digital.</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="control-label col-md-5">Documento 1</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" id="documento1" name="documento1"  disabled>
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <label class="control-label col-md-5">Documento 2</label>
                        <div class="col-sm-7">
                            <input type="file" class="form-control" id="documento2" name="documento2" disabled>
                            <h6><span class="gris">(opción para que incluya un dibujo original)</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div id="archivos2" style="display:none;">
                <div class="col-md-12 form-group">
                    <label class="control-label col-md-5">Url del video:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control text" id="video" name="video" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 row">
        <div class="text-center">
            <p class="gris" id="texto" ><p>Al hacer clic en el botón completar estoy aceptando los <a target="_blank" class="gris" href="<?php echo get_stylesheet_directory_uri() ?>/pdf/condiciones.pdf"><u>términos y condiciones</u></a> del concurso.</p>
        </div>
        <div class="col-md-12">
            <p><a class="gris" onclick="regresar()"> << Regresar</a></p>
        </div>
        <div class="col-md-12 text-center">
            <div class="col-md-12" style="" id="resultado"></div>
            <button style="width:40%; height:50px" type="submit" name="send" id="send" class="btn" onclick="realizaProceso(
                            $('#departamento').val(),
                            $('#distrito').val(),
                            $('#provincia').val(),
                            $('#colegio').val(),
                            $('#docente').val(),
                            $('#correo_d').val(),
                            $('#obra').val(),
                            $('#documento1').val(),
                            $('#documento2').val(),
                            $('#video').val(),
                            );">Completar</button>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>
