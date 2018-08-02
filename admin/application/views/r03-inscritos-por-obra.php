
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Inscritos por obra</li>
      </ol>
      <!-- Example DataTables panel-->
        <div class="col-md-12">
          <h2>Inscritos por obra</h2>
        </div>
        
        <div class="row">
          <div class="col-md-3">
              <a class="btn btn-primary btn-block" href="<?=base_url();?>Reportes/ER03/<?php echo $curso;  ?>/<?php echo $buscar;  ?>" style="width: 100px">Exportar</a>
          </div> 
        </div>
        <br>
      <div class="panel mb-3">
        <div class="panel-header">
          <i class="fa fa-table"></i> Cantidad inscritos por obra</div>
          
        <div class="panel-body">
            <div class="col-md-12">
                  <form method="GET" action="<?=base_url();?>Panel/r03">  
                      <label>Concurso</label>
                      <select id='curso' name='curso' class="">
                              <?php foreach ($años as $row)  { ?>
                          <option><?=$row->año;?></option>
                          <?php } ?>
                      </select>
                          
                     <input type="text" name="buscar" id="buscar" placeholder="Buscar" class="" required="">
                      <input type="submit" value="Buscar" class="btn btn-primary">
                  </form>
              </div>
          <div class="col-sm-6 table-responsive">
            <table class="table table-bordered table-width80" id="dataTable" width="100%" cellspacing="0" style="margin-top:2%;"  id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                
                  <th>Obra</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody>
                   <?php foreach ($tabla as $row) { ?>
                <tr>
                  <td><?php echo $row->nombre; ?></td>                
                  <td><?php echo $row->cuantos; ?></td>
                </tr>
              <?php  } ?>
                
  
              </tbody>
            </table>
          </div>
        
        
                    <div class="col-sm-6 center-block text-center">
<ul class="pagination">
<?php 
$url = base_url()."Panel/r03";
if ($total_paginas > 1) {
   if ($pagina != 1)
      echo '<li><a href="'.$url.'?pagina='.(($total_paginas-$total_paginas)+1).'/'.$curso.'/'.$buscar.'"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a></li>';
      
   for ($i=$pagina-1;$i<=$pagina+5;$i++) {
         if ($pagina == $i) { 
//si muestro el índice de la página actual, no coloco enlace
?>
            
               <li class="active"><a href="#"> <?php echo $pagina; ?> </a></li>
       <?php  } else
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            if (($i<$total_paginas) and ($i!=0)) { 
            echo ' <li> <a href="'.$url.'/'.$i.'/'.$curso.'/'.$buscar.'">'.$i.'</a> </li>';
            }
      }
      if ($pagina != $total_paginas)
         echo '<li><a href="'.$url.'/'.($total_paginas).'/'.$curso.'/'.$buscar.'"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></li>';
}?>
</ul>
</div>
        
        
        
        </div>
      </div>

    </div>
   