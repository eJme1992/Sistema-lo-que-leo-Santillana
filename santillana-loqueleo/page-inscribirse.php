<?php
get_header();

?>

<div class="container" id="registrar">
    <div class="row clearfix">
        <div class="col-md-12">
<script>
             
   <?php   
   require  'url.php'; 
 
   ?>  
   function realizaProceso( send, codigo) {
   var msj = "1";
   if (codigo===""){ msj = "Ingresa tu código para continuar"}  
      
      if (msj==="1"){
     
        var parametros = {
        "send": send,
        "code": codigo
    
      };
      $.ajax( {
        data: parametros, //datos que se envian a traves de ajax
        url: '<?php echo $url; ?>backoffice/Registroes/codigo', //archivo que recibe la peticion
        type: 'post', //método de envio
        beforeSend: function () {
          $( "#resultado" ).html( "<div class='center-block alert alert-success'> Procesando, espere por favor...</div>" );
        },
          success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
               var str = response;
               var json = JSON.parse(str);
               if (json.status=="ok"){
               $('#code').val(json.code),               
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
    <form action="<?php echo $url; ?>registro/" method="post">
    <input type="hidden" value="" name="code" id="code">
    <input type="submit" name="enviar" id="enviar">
    </form>
</div>
  
                <div class="row">
                    <div class="col-lg-12 text-center" style="margin-top:-30px;">
                        <h1><b>Comenzar el registro<b></h1>
                                    <h4><b>Ingresa tu código para iniciar el registro</b></h4>
                        <input type="text" class="form-control center-block" id="codigo" name="codigo" placeholder="MI CÓDIGO" required><img style="margin-left: 70%;" class="img-responsive ico center-block" width="80" src="<?php echo get_stylesheet_directory_uri() ?>/_/img/mano.png" alt="Chania"><br>
                      
                        <div class="text-center" style="margin-top:-8%;">
                            <P><a href="#" data-toggle="modal" data-target="#myCodigo" class="gris"><u>¿Dónde encuentro mi código?</u></a></P>
                        </div>


                        <div class="text-center">
                            <div class="col-md-12"  id="resultado"></div>
                            <button type="button" class="btn" name="send" onclick="realizaProceso($('#send').val(),
                            $('#codigo').val(),);" >Regístrate</button><br>
                        </div>

                        <div class="text-center">
                            <P class="gris" id="texto">Este formulario debe completarlo el padre, la madre o quien ejerza<br> la representación del estudiante y lo autorice a participar en el concurso.</P>
                        </div>

                    </div>
                </div>
            </form>

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
