
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Obras literarias</li>
</ol>
<!-- Example DataTables panel-->
<div class="col-md-12">
    <h2>Obras literarias</h2>
</div>
<div class="row">
    <div class="col-md-3">
        <a <?php
        if (($estadoc !== "cerrado") AND ( $estadoc !== "")) {
            if ($estadoc->estado !== "finalizado") {
                echo "";
            } else {
                echo "disabled";
            }
        } else {
            echo "disabled";
        }
        ?>  class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" style="width: 100px">Cargar</a>
    </div>
    <div class="col-md-4">
        <a class="btn btn-primary btn-block" href="<?= base_url(); ?>Reportes/obra/" style="width: 100px">Exportar</a>
    </div>        
</div>
<br>
<div class="panel mb-3">
    <div class="panel-header">
        <i class="fa fa-table"></i> Lista de obras literarias</div>



    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-width80" id="dataTable" width="100%" cellspacing="0" style="margin-top:2%;" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Tipo de reto</th>
                        <th>Estado</th>
                        <th>F. Registro</th> 
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($tabla as $row) {
                        if ($row->reto == 1) {
                            $reto = "Fisico";
                        } if ($row->reto == 2) {
                            $reto = "Digital";
                        } if ($row->reto == 3) {
                            $reto = "Video";
                        }
                        if ($row->estado == "iniciado") {
                            $estado = "Activo";
                        } else {
                            $estado = "No Activo";
                        }
                        ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->nombre; ?></td>
                            <td><?php echo $reto; ?></td>
                            <td><?= $estado ?></td>               
                            <td><?php echo $row->fecha_registro; ?></td>


                            <td>             
                                <a class="btn btn-primary btn-block" href="javascript:;" onclick="aviso('<?= base_url(); ?>Eliminar/codigos/<?php echo $row->id; ?>/obras'); return false;">eliminar</a>
                        </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="center-block text-center">
            <ul class="pagination">
                <?php
                $url = base_url() . "Panel/obras";
                if ($total_paginas > 1) {
                    if ($pagina != 1)
                        echo '<li><a href="' . $url . '?pagina=' . (($total_paginas - $total_paginas) + 1) . '"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a></li>';

                    for ($i = $pagina - 1; $i <= $pagina + 5; $i++) {
                        if ($pagina == $i) {
//si muestro el índice de la página actual, no coloco enlace
                            ?>

                            <li class="active"><a href="#"> <?php echo $pagina; ?> </a></li>
                            <?php
                        } else
                        //si el índice no corresponde con la página mostrada actualmente,
                        //coloco el enlace para ir a esa página
                        if (($i < $total_paginas) and ( $i != 0)) {
                            echo ' <li> <a href="' . $url . '/' . $i . '">' . $i . '</a> </li>';
                        }
                    }
                    if ($pagina != $total_paginas)
                        echo '<li><a href="' . $url . '/' . ($total_paginas) . '"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';
                }
                ?>
            </ul>
        </div>  
    </div>
</div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form id="frmFormulario" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Importar</h4>
                </div>
                <div class="modal-body">


                    <input type="file" class="form-control" id="file" name="file" required="">

                    <div class="col-md-12" style="margin-top:2%;" id="resultado"></div>

                </div>
                <div class="modal-footer">
                    <button type="enviar" d="send"  class="btn btn-danger">Enviar</button>
                    <a href="<?= base_url(); ?>obras"> <button type="button" class="btn btn-default">Cerrar</button></a>
                </div>
            </form> 
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
 $("#send").prop('disabled', true);
        //sobreescribimos el metodo submit para que envie la solicitud por ajax
        $("#frmFormulario").submit(function (e) {

            //esto evita que se haga la petición común, es decir evita que se refresque la pagina
            e.preventDefault();

            //ruta la cual recibira nuestro archivo
            url = "<?= base_url(); ?>Importar/obra/"

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
                        $("#resultado").html("<div class='center-block alert alert-success'> " + json.mensaje + "</div>");
                    } else {
                        $("#send").prop('disabled', false);
                        $("#resultado").html('<div class="center-block alert alert-danger"><strong>¡ERROR! </strong>' + json.error + '</div>');
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
