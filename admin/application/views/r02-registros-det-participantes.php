
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Registros detallados</li>
      </ol>
      <!-- Example DataTables panel-->
        <div class="col-md-12" class="text-center">
          <h2>Registros detallados</h2>
        </div>
        
      
        <div class="row">
          <div class="col-md-3">
              <a class="btn btn-primary btn-block" href="<?=base_url();?>Reportes/ER02/<?php echo $curso;  ?>/<?php echo $tipo;  ?>/<?php echo $buscar;  ?>" style="width: 100px">Exportar</a>
          </div> 
        </div>
        <br>
      <div class="panel mb-3">
        <div class="panel-header">
          <i class="fa fa-table"></i> Registros detallados </div>
          
        <div class="panel-body">
          <div class="table-responsive">
              <div class="col-md-12">
                  <form method="GET" action="<?=base_url();?>Panel/r02">   
                      <label>Concurso</label>
                      <select id='curso' name='curso' class="">
                             <?php foreach ($años as $row)  { ?>
                          <option value="<?=$row->año;?>"><?=$row->año;?></option>
                          <?php } ?>
                      </select>
                      <label>Tipo de busqueda</label>
                          <select id='tipo' name='tipo' class="">
                          <option>Todo</option>
                          <option>Colegios</option>
                          <option>Estudiantes</option>
                          <option>Apoderado</option>
                          <option>Obra</option>
                          </select>    
                      <input type="text" name="buscar" id="buscar" placeholder="Buscar" class="" required="">
                      <input type="submit" value="Buscar" class="btn btn-primary">
                  </form>
              </div>
            <br>
            <table class="table table-bordered table-width80" id="dataTable" width="100%" cellspacing="0" style="margin-top:2%;"> 
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>DNI Concursante</th>
                  <th>Concursante</th>
                  <th>Apoderado</th>
                  <th>Codigo colegio</th>
                  <th>Colegio</th>
                  <th>Tipo reto</th>
                  <th>Obra</th>
                  <th>F. Registro</th>
                </tr>
              </thead>
            <!--  <tfoot>
                <tr>
                  <th>codigo</th>
                  <th>Concursante</th>
                  <th>Apoderado</th>
                  <th>col-mdegio</th>
                  <th>Tipo reto</th>
                  <th>F. Registro</th>
                </tr>
              </tfoot>
            -->
              <tbody>
                  <?php foreach ($tabla as $row) { 
                      if ($row->reto==1){$reto="Fisico";} if($row->reto==2){$reto="Digital";} if($row->reto==3){$reto="Video";} 
                      ?>
                  <tr>
                  <td><?php echo $row->code; ?></td>
                  <td><?php echo $row->dni; ?></td>
                  <td><?php echo $row->nombre.' '.$row->apellido_p.' '.$row->apellido_m; ?></td>
                  <td><?php echo $row->nombre_p.' '.$row->papellido_p.' '.$row->papellido_m;?></td>
                  <td><?php echo $row->codecol; ?></td>
                  <td><?php echo $row->colegio; ?></td>
                  <td><?php echo $reto; ?></td>
                  <td><?php echo $row->obra; ?></td>
                  <td><?php echo $row->fecha_registro; ?></td>
                  </tr>
                  <?php  } ?>
                
                
              </tbody>
            </table>
          </div>
            
            
            <div class="col-sm-6 center-block text-center">
<ul class="pagination">
<?php 
$url = base_url()."Panel/r02";
if ($total_paginas > 1) {
   if ($pagina != 1)
      echo '<li><a href="'.$url.'?pagina='.(($total_paginas-$total_paginas)+1).'/'.$curso.'/'.$tipo.'/'.$buscar.'"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a></li>';
      
   for ($i=$pagina-1;$i<=$pagina+5;$i++) {
         if ($pagina == $i) { 
//si muestro el índice de la página actual, no coloco enlace
?>
            
               <li class="active"><a href="#"> <?php echo $pagina; ?> </a></li>
       <?php  } else
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            if (($i<$total_paginas) and ($i!=0)) { 
            echo ' <li> <a href="'.$url.'/'.$i.'/'.$curso.'/'.$tipo.'/'.$buscar.'">'.$i.'</a> </li>';
            }
      }
      if ($pagina != $total_paginas)
         echo '<li><a href="'.$url.'/'.($total_paginas).'/'.$curso.'/'.$tipo.'/'.$buscar.'"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';
}?>
</ul>
</div>
            
            
            
            
            
            
        </div>
      </div>
        

    
    </div>
  