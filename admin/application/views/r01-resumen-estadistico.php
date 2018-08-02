

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Resumen estadístico</li>
</ol>
<!-- Example DataTables panel-->
<div class="col-md-12">
    <h2>Resumen estadístico</h2>
</div>

<div class="row">
    <div class="col-md-3">
       <a <?php if (($estadoc!=="cerrado") AND ($estadoc !==""))  {
             if( (isset($reto["c3"])==false)  OR (isset($sexo["F"])==false) ){ echo "disabled"; }
    } else {
     echo "disabled";
        }?>  class="btn btn-primary btn-block" href="<?= base_url(); ?>Reportes/ER01/<?php echo $curso; ?>"  style="width: 100px">Exportar</a>
    </div> 
</div>
<br>
<div class="row">
    <div class="col-md-md-8">
        <div class="panel mb-3">
            <div class="panel-header">
                <i class="fa fa-table"></i> Participantes por mes</div>

            <div class="panel-body">
                <div class="col-sm-5 table-responsive">
                    <table class="table table-bordered table-width80" id="dataTable" width="100%" cellspacing="0" style="margin-top:2%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mes</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 0;
                            $mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                            foreach ($tabla as $row) {
                                $i = $i + 1;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $mes[$i - 1]; ?></td>
                                    <td><?php echo $row; ?></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>





                <div class="panel mb-6">

                    <div class="col-md-6 table-responsive">

                        <div> <i class="fa fa-table"></i> Participantes por tipo de trabajo</div> 

                        <table class="table table-bordered table-width80" id="dataTable" width="100%" cellspacing="0" style="margin-top:2%;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>%</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Físico</td>
                                    <td><?php echo round($reto["a1"], 2); ?>%</td>
                                </tr>
                                <tr>
                                    <td>Virtual</td>
                                    <td><?php echo round($reto["b2"], 2); ?>%</td>
                                </tr>
                                <tr>
                                    <td>Video</td>
                                    <td><?php if (isset($reto["c3"]))  { ?><?php echo round($reto["c3"], 2); ?>%  <?php } else {echo "0%";} ?></td>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>

                    <!---->
                 



                    <div class="col-md-6 table-responsive">
                        <div>
                            <i class="fa fa-table"></i> Participantes por género</div>
                
                            <table class="table table-bordered table-width80" id="dataTable" width="100%" cellspacing="0" style="margin-top:2%;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Género</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hombre</td>
                                    <td><?php echo round($sexo["M"], 2); ?>%</td>
                                </tr>
                                <tr>
                                    <td>Mujer</td>
                                    <td>     <?php if (isset($sexo["F"]))  { ?><?php echo round($sexo["F"], 2); ?>% <?php } else {echo "0%";} ?></td>
                                </tr>
                            </tbody>
                        </table>
             
                    </div>


                </div>

            </div>
        </div>
    </div>     


</div>   

</div>
<!-- /.container-fluid-->
