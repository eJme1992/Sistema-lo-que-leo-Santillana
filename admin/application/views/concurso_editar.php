<!--
<script>
  function realizaProceso( año,inicio,cierre,premiacion) {
    var msj = "1";
     if (msj==="1"){
        var parametros = {
        "año": año,
        "inicio": inicio,
        "cierre": cierre,
        "premiacion": premiacion
      };
      
      $.ajax( {
        data: parametros, //datos que se envian a traves de ajax
        url: '<?= base_url(); ?>Panel/crear/', //archivo que recibe la peticion
        type: 'post', //método de envio
        beforeSend: function () {
          $( "#resultado" ).html( "<div class='center-block alert alert-success'> Procesando, espere por favor...</div>" );
        },
     success: function(response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
               var str = response;
               var json = JSON.parse(str);
               if (json.status=="ok"){
                $("#resultado").html("<div class='center-block alert alert-success'> " + json.mensaje + ".</div>");
                        
               console.log(response);}
               else{
               $("#resultado").html(json.error);    
               }             
               }
      } );
  }else{ swal("¡Error! ",  msj  , "error");}
    
    
    }
    
    </script>
-->



<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Crear concurso</li>
      </ol>
      <div class="row">
          
          
        
          <h2>Crear concurso</h2>
          <p>Aquí podrás crear concursos</p>
       
          
               
 <div class="panel panel-register mx-auto mt-1">
      <div class="panel-header">Datos del concurso</div>
      <div class="panel-body">
          <!-- onSubmit="realizaProceso($('#año').val(),$('#inicio').val(),$('#cierre').val(),$('#premiacion').val(),);"-->
        <form  id="frmFormulario">
        
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputName">Año</label>
                <input value="<?php echo $valores->año;?>"  class="form-control"  required id="año" name="año" type="number" aria-describedby="nameHelp" placeholder="Ingresa el año">
              </div>
             
           
          
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputLastName">Fecha de Inicio</label>
                <input value="<?php echo $valores->fecha_inicio;?>" class="form-control"  required  id="inicio" name="inicio" type="date" aria-describedby="nameHelp" placeholder="Selecciona la fecha de inicio">
              </div>
           
        
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputName">Fecha de cierre</label>
                <input value="<?php echo $valores->fecha_final;?>" class="form-control"  required  id="cierre" name="cierre" type="date" aria-describedby="nameHelp" placeholder="Selecciona la fecha de cierre" >
              </div>
              <div class="col-md-6" style="margin-top:2%;">
                <label for="exampleInputLastName">Fecha de premiación</label>
                <input value="<?php echo $valores->fecha_premiacion;?>"  class="form-control"  required   id="premiacion" name="premiacion" type="date" aria-describedby="nameHelp" placeholder="Selecciona la fecha de premiación">
              </div>
              <input type="hidden" name="id" id="id" value="<?php echo $valores->id;?>">
              <div class="col-md-12" style="margin-top:2%;" id="resultado"></div>
      
          <div class="col-md-6" style="margin-top:2%;">
            <input type="submit" id="send" class="btn btn-primary btn-block" value="Guardar">
          </div>
          <div class="col-md-6" style="margin-top:2%;">
              <a class="btn btn-primary btn-block" href="<?=base_url();?>concurso">Volver</a>
          </div>        
        
            
        </form>

      </div>
    </div>
          
          
              <script>
        $(document).ready(function () {
   
            //sobreescribimos el metodo submit para que envie la solicitud por ajax
            $("#frmFormulario").submit(function (e) {
             $("#send").prop('disabled', true);
                //esto evita que se haga la petición común, es decir evita que se refresque la pagina
                e.preventDefault();

                //ruta la cual recibira nuestro archivo
                url = "<?= base_url(); ?>Panel/editar/";

                //FormData es necesario para el envio de archivo, 
                //y de la siguiente manera capturamos todos los elementos del formulario
                var parametros = new FormData($(this)[0])

                //realizamos la petición ajax con la función de jquery
                $.ajax({
                    type: "POST",
                    url: url,
                    data: parametros,
                    contentType: false, //importante enviar este parametro en false
                    processData: false, //importante enviar este parametro en false
                    beforeSend: function () {
                        $("#resultado").html("<div class='center-block alert alert-success'> Procesando, espere por favor...</div>");
                    },
                    success: function (response) {
                        var str = response;
                        var json = JSON.parse(str);
                        if (json.status == "ok") {
                            $("#send").prop('disabled', false);
                            $("#resultado").html("<div class='center-block alert alert-success'> " + json.mensaje + ".</div>");
                        } else {
                            $("#send").prop('disabled', false);
                            $("#resultado").html('<div class="center-block alert alert-danger"><strong>¡ERROR! </strong>' + json.mensaje + '.</div>');
                        }
                    },
                    error: function (r) {
                        $("#send").prop('disabled', false);
                        alert("Error del servidor - (Este error puede ocurrir porque el archivo tiene el formato incorrepto)");
                    }
                });

            })

        })

    </script> 
          
          
          
          
          
          
      </div>