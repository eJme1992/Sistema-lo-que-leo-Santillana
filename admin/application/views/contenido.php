<?php if (($estadoc !== "cerrado") AND ( $estadoc !== "")) { ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">


        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);
        google.charts.setOnLoadCallback(drawBasic1);
        google.charts.setOnLoadCallback(drawAnthonyChart);


        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        /*  
         // Load the Visualization API and the corechart package.
         google.charts.load('current', {'packages':['corechart']});
             
         // Set a callback to run when the Google Visualization API is loaded.
         google.charts.setOnLoadCallback(drawChart);
             
         google.charts.setOnLoadCallback(drawAnthonyChart);
         function drawChart() {
             
         // Create the data table.
         var data = new google.visualization.DataTable();
         data.addColumn('string', 'Topping');
         data.addColumn('number', 'Slices');
         data.addRows([
    <?php
    $i = 0;
    $mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    foreach ($tabla as $row) {
        $i = $i + 1;
        ?>
             ['<?php echo $mes[$i - 1]; ?>',<?php echo $row; ?>],
    <?php } ?>
             
             
         ]);
             
         // Set chart options
         var options = {'title':'',
         'width':500,
         'height':300};
             
         // Instantiate and draw our chart, passing in some options.
         var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
         chart.draw(data, options);
         }*/


        function drawAnthonyChart() {

            // Create the data table for Anthony's pizza.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                ['Fisico', <?php echo $reto["1"]; ?>],
                ['Digital', <?php echo $reto["2"]; ?>],
                ['Video', <?php echo $reto["3"]; ?>],
            ]);

            // Set options for Anthony's pie chart.
            var options = {title: '',
                width: 600,
                height: 500};

            // Instantiate and draw the chart for Anthony's pizza.
            var chart = new google.visualization.PieChart(document.getElementById('cantidad'));
            chart.draw(data, options);
        }










        function drawBasic() {

            var data = google.visualization.arrayToDataTable([
                ["Element", "Participantes", {role: "style"}],
    <?php
    $i = 0;
    $max = 0;
    $mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    foreach ($tabla as $row) {
        if ($row > $max) {
            $max = $row;
        }
        $i = $i + 1;
        ?>

                    ['<?php echo $mes[$i - 1]; ?>',<?php echo $row; ?>, '#3266CC'],
    <?php } ?>

            ]);

            var options = {
                width: 900,
                legend: {position: 'none'},
                chart: {subtitle: 'Number Of Pax'},
                axes: {
                    x: {
                        0: {side: 'bottom', label: 'Date'} // Top x-axis.
                    }
                },
                bar: {
                    groupWidth: '90%'
                },
                vAxis: {
                    viewWindow: {max: <?= $max ?>},
                    format: '000'
                }
            };

            var chart = new google.visualization.ColumnChart(
                    document.getElementById('chart_div'));

            chart.draw(data, options);
        }

        //Obras
        function drawBasic1() {

            var data = google.visualization.arrayToDataTable([
                ["Element", "Participantes", {role: "style"}],
    <?php
    $i = 0;
    $max = 0 ;
    foreach ($obras as $row) {
        $nombre = $row->nombre;
        if ($row->cuantos > $max) {
            $max = $row->cuantos;
        }

        $i = $i + 1;
        ?>

                    ['<?php echo $nombre; ?>',<?php echo $row->cuantos; ?>, ' #3266CC'],
    <?php } ?>

            ]);

            var options = {
                width: 900,
                legend: {position: 'none'},
                chart: {subtitle: 'Number Of Pax'},
                axes: {
                    x: {
                        0: {side: 'bottom', label: 'Date'} // Top x-axis.
                    }
                },
                bar: {
                    groupWidth: '90%'
                },
                vAxis: {
                    viewWindow: {max: <?= $max ?>},
                    format: '000'
                }
            };
            var chart = new google.visualization.ColumnChart(
                    document.getElementById('chart_div1'));

            chart.draw(data, options);
        }
    </script>
<?php } ?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Mi Dashboard</li>
</ol>
<!-- Icon Cards-->

<!-- Area Chart Example-->
<!--
<div class="card mb-3">
<div class="card-header">
  <i class="fa fa-area-chart"></i> Area Chart Example</div>
<div class="card-body">
  <canvas id="myAreaChart" width="100%" height="30"></canvas>
</div>
<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
-->
<div class="row">
    <div class="col-md-10">
        <!-- Example Bar Chart Card-->
        <?php     if( (isset($reto["c3"])!==false)  OR (isset($sexo["F"])!==false) ){ ?>
        <div class="panel panel-body">
            <div class="card-header">
            
                <i class="fa fa-bars" aria-hidden="true"></i> Participantes por Mes</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <div class="text-center"><h4>Participantes por Mes</h4></div>
                        <div id="chart_div"></div>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <div class="text-center"><h4>Participantes por obra</h4></div>
                        <div id="chart_div1"></div>
                        <!--  <i class="fa fa-pie-chart"></i> Cantidad de trabajos<hr>
                      <div id="cantidad"></div>-->
                    </div>
                    <!--  <div class="col-sm-12 text-center my-auto">
                          <div class="h4 mb-0 text-primary"><?php
                    if (($estadoc !== "cerrado") AND ( $estadoc !== "")) {
                        echo $sexo["m"] + $sexo['f'];
                    }
                    ?></div>
                          <div class="small text-muted">Total Participantes </div>
                          <hr>
                          <div class="h4 mb-0 text-warning"><?php
                    if (($estadoc !== "cerrado") AND ( $estadoc !== "")) {
                        echo $sexo["m"];
                    }
                    ?></div>
                          <div class="small text-muted">Hombres</div>
                          <hr>
                          <div class="h4 mb-0 text-success"><?php
                    if (($estadoc !== "cerrado") AND ( $estadoc !== "")) {
                        echo $sexo["f"];
                    }
                    ?></div>
                          <div class="small text-muted">Mujeres</div>
                      </div> -->
                </div>
            </div>
            <!--  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            -->
        </div>
        <?php } ?>

    </div>
</div>