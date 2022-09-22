<!doctype html>
<html lang="en">

<head>
  <title>Parcial 2</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <h1>Estudiantes</h1>
    <div class="container">
    <form class="d-flex" action ="" method="post">
        <div class="col">
            <div class="mb-3">
                <label for="lbl_carnet" class="form-label"><b>Carnet</b></label>
                <input type="text" name="txt_carnet" id="txt_carnet" class="form-control" placeholder="carnet: E001" required>
            </div>
            <div class="mb-3">
                <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: nombre1 nombre2" required>
            </div>
            <div class="mb-3">
                <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: apellido1 apellido2" required>
            </div>
            <div class="mb-3">
                <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
                <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Direccion: #casa calla avenida lugar" required>
            </div>
            <div class="mb-3">
                <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
                <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Telefono: 55555" required>
            </div>
            <div class="mb-3">
              <label for="lbl_genero" class="form-label"><b>Genero</b></label>
              <select class="form-select" name="drop_genero" id="drop_genero">
             <option value=0>----Genero-----</option>
             <option value=1>Masculino</option>
             <option value=1>Femenino</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com">
              <small id="emailHelpId" class="form-text text-muted"></small>
            </div>
        
            <div class="mb-3">
                <label for="lbl_fn" class="form-label"><b>Fecha Nacimiento</b></label>
                <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mm-dd" required> <!-- required, campo obligarorio a llenar  -->
            </div>
            <div class="mb-3">
                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="agregar">
            </div>
          </div>

          <div class="mb-3">
                <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-primary" value="agregar">
            </div>
          </div>
   
    </form>
<div class="table-responsive">
  <table class="table table-striped 	table-inverse ">
    <thead class="table-light">
      <tr>
        <th>Carnet</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Genero</th>
        <th>E-mail</th>
        <th>Nacimiento</th>
      </tr>
      </thead>
      <tbody >
              <?php
              include("conexion_parcial.php");
              $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
              $db_conexion ->real_query("SELECT e.id_estudiantes as id,e.carnet,e.nombres,e.apellidos,e.direccion,e.telefono,e.genero,e.email,e.fecha_nacimiento
              FROM estudiantes as e;");
              $resultado = $db_conexion->use_result();
              while($fila = $resultado->fetch_assoc()){
                echo"<tr data-id=".$fila['id'] .">";
                  echo"<td". $fila['carnet'] ."</td>";
                  echo"<td". $fila['nombres'] ."</td>";
                  echo"<td". $fila['apellidos'] ."</td>";
                  echo"<td". $fila['direccion'] ."</td>";
                  echo"<td". $fila['telefono'] ."</td>";
                  echo"<td". $fila['genero'] ."</td>";
                  echo"<td". $fila['email'] ."</td>";
                  echo"<td". $fila['fecha_nacimiento'] ."</td>";
                  echo"<tr>";
              }
              $db_conexion ->close();
              ?>
      </tbody>
  </table>
</div>


</div>
<?php
    if (isset($_POST["btn_agregar"]))  {
        include("conexion_parcial.php");
            $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
            $txt_carnet = utf8_decode($_POST ["txt_carnet"]) ;
            $txt_nombres = utf8_decode($_POST ["txt_nombres"]) ;
            $txt_apellidos = utf8_decode($_POST ["txt_apellidos"]) ;
            $txt_direccion = utf8_decode($_POST ["txt_direccion"]) ;
            $txt_telefono = utf8_decode($_POST ["txt_telefono"]) ;
            $drop_genero = utf8_decode($_POST ["drop_genero"]) ;
            $email = utf8_decode($_POST ["email"]) ;
            $txt_fn = utf8_decode($_POST ["txt_fn"]) ;
            $sql = "INSERT INTO estudiantes(carnet,nombres,apellidos,direccion,telefono,genero,email,fecha_nacimiento) VALUES('".$txt_carnet."','".$txt_nombres."','".$txt_apellidos."','".$txt_direccion."','".$txt_telefono."',".$drop_genero.",'".$email."','".$txt_fn."',);";
        if($db_conexion ->query($sql)===true){
            $db_conexion  ->close();
            echo"Exito";
            header("Refresh:0");
            
        }else{
            echo"Error". $sql. "<br>".$db_conexion ->close();
        }
    }  
?>
  
 
<?php
if (isset($_get["btn_eliminar"]))  {
include_once("conexion_parcial.php");
if($_REQUEST['estudiante']) {
	$sql = "DELETE FROM estudiante WHERE id='".$_REQUEST['estudiante']."'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
	if($resultset) {
		echo "Registro Borrado";
	}
}
?> 
  
  
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>
</body>

</html>
