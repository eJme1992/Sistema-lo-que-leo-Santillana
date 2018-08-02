 <?php
  include_once 'conexion.php';
   include_once 'url.php';
   $con = conexion();
   header('Content-Type: text/html; charset=utf-8');
   
                            if (isset($_GET['id'])){
                            $sql = "SELECT * FROM `ubprovincia` WHERE idDepa=".$_GET['id'];
                            echo "<option value='0'> Seleccionar </option>";
                            foreach ($con->query($sql) as $row) {
                            $provincia= $row['provincia'] ;
                            $idPro= $row['idProv']; 
                            echo "<option value='$idPro'> $provincia </option>";
                            }}
                           
                            if (isset($_GET['id2'])){
                            $sql = "SELECT * FROM `ubdistrito` WHERE idProv=".$_GET['id2'];
                            echo "<option value='0'> Seleccionar </option>";
                            foreach ($con->query($sql) as $row) {
                            $distrio= $row['distrito'] ;
                            $idDist= $row['idDist']; 
                            echo "<option value='$idDist'> $distrio </option>";
                            }}
                            
                            if (isset($_GET['id3'])){
                            $sql = "SELECT * FROM `colegio` WHERE code_dis=".$_GET['id3'];
                            echo "<option value='0'> Seleccionar </option>";
                            foreach ($con->query($sql) as $row) {
                            $nombre= $row['nombre'] ;
                            $id= $row['id']; 
                            echo "<option value='$id'> $nombre </option>";
                            }}
                            
                            if (isset($_GET['id4'])){
                            $_GET['id4'];
                            $sql = "SELECT * FROM `obra` WHERE id=".$_GET['id4'];
                            foreach ($con->query($sql) as $row) {
                            $tipo= $row['reto'] ;
                            echo "$tipo";
                            }}

                           ?>

                         


