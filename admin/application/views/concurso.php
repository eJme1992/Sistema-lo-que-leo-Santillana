<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Concursos</li>
</ol>
<!-- Example DataTables Card-->
<div class="col-12">
    <h2>Concursos</h2>

</div>

<div class="row">

    <div class="col-md-3">
        <a <?php if (($estadoc!=="cerrado") AND ($estadoc !==""))  {
    echo "disabled";
} else {
    echo "";
        } ?> class="btn btn-primary btn-block" href="<?= base_url(); ?>crearconcurso" style="width: 100px" >Crear</a>
    </div>
    <div class="col-md-4">
        <a class="btn btn-primary btn-block" href="<?= base_url(); ?>Reportes/concurso/" style="width: 100px">Exportar</a>
    </div> 
</div>
<br>
<div class="panel col-mb-3">
    <div class="panel-header">
        <i class="fa fa-table"></i> Lista de concursos</div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-width80" id="dataTable" width="100%" cellspacing="0" style="margin-top:2%;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Año</th>
                        <th>Periodo</th>
                        <th>Estado</th>
                        <th>F. Creado</th>
                        <th>F. Inicio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
<?php foreach ($tabla as $row) { ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->año; ?></td>
                            <td><?php echo $row->fecha_inicio . '/' . $row->fecha_premiacion; ?></td>
                            <td><?php echo $row->estado; ?></td> 
                            <td><?php echo $row->fecha_registro; ?></td> 
                            <td><?php echo $row->fecha_inicio; ?></td>
                            <td>             
                                <a  <?php if($row->estado=='cerrado'){   echo "disabled";} ?>  class="btn btn-primary btn-block" href="<?= base_url(); ?>Panel/editarconcurso/<?php echo $row->id; ?>">Editar</a>
                            </td>
                        </tr>
<?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>