<?php
include_once 'url.php';
/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
get_header();

?>
<script>
             
        
   function realizaProceso( send,codigo,dni) {
   var msj = "1";
   if (codigo===""){ msj = "Ingresa tu código para continuar"}  
   if (dni===""){ msj = "Ingresa tu código para continuar"}    
      if (msj==="1"){
     
        var parametros = {
        "send": send,
        "code": codigo,
        "dni": dni
    
      };
      $.ajax( {
        data: parametros, //datos que se envian a traves de ajax
        url: '<?php echo $url; ?>backoffice/Registroes/reimprimir', //archivo que recibe la peticion
        type: 'post', //método de envio
        beforeSend: function () {
          $( "#resultado" ).html( "<div class='center-block alert alert-success'> Procesando, espere por favor...</div>" );
        },
     success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
               var str = response;
               var json = JSON.parse(str);
               if (json.status=="ok"){
               $('#id_registro').val(json.id_registro),
               $('#tipo').val(json.tipo),
               $('#token').val(json.token),
               $('#enviar').click();
               console.log(response);}
               else{
               $("#resultado").html(json.error);    
               }             
               }
      } );
  }else{ swal("¡Error! ",  msj  , "error");}
    
    
    }
  </script>
  <div style="display:none;">
    <form action="<?php echo $url; ?>certificado/" method="post">
    <input type="hidden" value="" name="id_registro" id="id_registro">
    <input type="hidden" value="" name="tipo" id="tipo">
    <input type="hidden" value="" name="token" id="token">
    <input type="submit" name="enviar" id="enviar">
    </form>
</div>
<div class="container" id="registrar">
    
            <div class="row">
                <div class="col-lg-12 text-center" style="min-height: 450px;">
                    <h1><b>Reimprimir Certificado</b><br></h1>
                    <h4><b>Ingresa tu código para reimprimir</b><br></h4>

<input type="text" class="form-control center-block" id="codigo" name="codigo" placeholder="MI CÓDIGO"><br>
<input type="text" class="form-control center-block" id="dni" name="dni"   placeholder="MI DNI"><img style="margin-left: 70%;" class="img-responsive ico center-block" width="80" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/mano.png" alt="Chania"><br>
                    

<div class="text-center" style="margin-top:-7%;">
                            <div class="col-md-12"  id="resultado"></div>
                            <button type="button" class="btn" name="send" onclick="realizaProceso($('#send').val(),
                            $('#codigo').val(),$('#dni').val(),   );" >Reimprimir</button><br>
                  </div>

                    <div class="text-center">
                        <P><a href="#" data-toggle="modal" data-target="#myCodigo" class="gris"><u>¿Dónde encuentro mi código?</u></a></P>
                    </div>

                    <div class="text-center">
                        <P class="gris">Para reimprimir el certificado de participación necesitas ingresar el código que<br> está en tu libro y el DNI del alumno con el que se registró.</P>
                    </div>


                </div>


            </div>


        </div>
 


<div class="modal fade" id="myCodigo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img class="img-responsive center-block" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/donde.jpg" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
