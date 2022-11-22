<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">DB</a>
    </div>
    <ul class="nav navbar-nav">
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Acciones <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Crear</a></li>
          <li><a href="#">Borrar</a></li>
          <li><a href="#">Actualizar</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tablas <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Zoo</a></li>
          <li><a href="#">Motos</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">

</div>

  <div class="w3-container" style ="padding: 0">    
  <div class="w3-container w3-blue">
    <h2>Listado de registros de la agenda</h2>
  </div>
  <?php
    //Micro servicio para obtener los datos de una forma
    //conectarse al srvidor de base de datos
    $servername = "localhost";
    $username = "root";
    $password = "ass1";
    $dbname = "examen";
    
    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Checar la conexión
    if ($conn->connect_error) {
      die("Fallo la conexión: " . $conn->connect_error);
    }
    //Si hay variable por el metodo POST
    if(!empty($_POST["nombre"])) {
      //Recibir las variables de la forma enviados por la forma    
      $nombre=$_POST["nombre"];
      $descripcion=$_POST["descripcion"];
      $cantidad=$_POST["cantidad"];
      $precio=$_POST["precio"];
      
      
      
      $sql = "INSERT INTO agenda (nombre, descripcion, cantidad,precio) VALUES ('{$nombre}', '{$descripcion}', '{$cantidad}','{$precio}')";
      
      if ($conn->query($sql) === TRUE) {
    ?>
    <div class="w3-panel w3-green">
    <?php
        echo "<h3>Registro añadido con exito</h3>";  
    ?>
    </div>
    <?php
      } else {
      echo '<div class="w3-panel w3-red">'.
      "<h3>Error: " . $sql . "<br>" . $conn->error.
      "</h3></div>";
      }
    }
    else if(!empty($_POST["idEdit"])){
      $idEdit = $_POST["idEdit"];

      if(!empty($_POST["nombreEdit"])){
        $nombreEdit = $_POST["nombreEdit"];
        $sql = "UPDATE agenda SET nombre = '{$nombreEdit}' WHERE id = {$idEdit}";
        $conn ->query($sql);
      }
      if(!empty($_POST["descripcionEdit"])) {
        $descripcionEdit = $_POST["descripcionEdit"];
        $sql ="UPDATE agenda SET descripcion = '{$descripcionEdit}' WHERE id = {$idEdit}";
        $conn ->query($sql);
      }
      if(!empty($_POST["cantidadEdit"])){
        $cantidadEdit = $_POST["cantidadEdit"];
        $sql = "UPDATE agenda SET cantidad = {$cantidadEdit} WHERE id = {$idEdit}";
        $conn->query($sql);
      }
      if(!empty($_POST["precioEdit"])){
        $precioEdit = $_POST["precioEdit"];
        $sql = "UPDATE agenda SET precio = {$precioEdit} WHERE id = {$idEdit}";
        $conn ->query($sql);
      }
      ?>
      <div class="w3-panel w3-green">
      <?php
          echo "<h3>Registro actualizado con exito</h3>";  
      ?>
      </div>
      <?php
    }
    

  ?>
  <?php
  //Listar los registros que tiene la tabla persona de la base de datos tercera
  $sql = "SELECT * FROM agenda";
  $result = $conn->query($sql);
  printRows($result);

  ?>

<br>
  <a class="w3-button w3-black" href="agenda1.html">Volver</a>
  <a class="w3-button w3-black" href="agendaEdit.html">Editar</a> <br>
  <br>
  <div class="w3-container w3-blue">
    <h2>Borrar en base a id</h2>
  </div>

  <form name="delete" class="w3-container" action="<?php $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm(1)" method="post">
    <br> id: <input class="w3-input" type="text" name="id">
    <br>
    <input class="w3-button w3-black" type="submit" value="Enviar">
  </form>
  <div class="w3-container w3-blue">
    <h2>Buscar Registro</h2>
  </div>
  <form name="search" class="w3-container" action="<?php $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm(2)" method="post">
    <br> numero de registro: <input class="w3-input" type="text" name="rowNum"> <br>
    texto de busqueda: <input class="w3-input" type="text" name="searchText">
    <br>
    <label for="">INTRODUCIR SOLO UNO</label>
    <input class="w3-button w3-black" type="submit" value="Enviar">
  </form>
  <?php
  if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(!empty($_POST["id"])){

      $id=$_POST["id"];
  
      $sql = "DELETE FROM agenda WHERE id ='{$id}'";
      $result = $conn->query($sql);
      printRows($result);
      if($conn ->query($sql) === TRUE){
        $sql = "ALTER TABLE agenda DROP id";
        $conn ->query($sql);
        $sql = "ALTER TABLE agenda add id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY(id)";
        $conn ->query($sql);
        ?>
        <div class="w3-panel w3-red">
        <?php
            echo "<h3>Registro borrado con exito</h3>";  
        ?>
        </div>
      <?php
      } else {
        echo '<div class="w3-panel w3-red">'.
        "<h3>Error: " . $sql . "<br>" . $conn->error.
        "</h3></div>";          
      }  
    }
    else if(!empty($_POST["rowNum"]) || !empty($_POST["searchText"])){
      if(!empty($_POST["rowNum"])){
        $rowNum = $_POST["rowNum"] - 1;
        $sql = "SELECT * FROM agenda LIMIT {$rowNum},1";
        $result = $conn->query($sql);
        printRows($result);
      }else{
        $searchText = $_POST["searchText"];
        $sql = "SELECT * FROM agenda WHERE nombre LIKE '%{$searchText}%' OR descripcion LIKE '%{$searchText}%'";
        $result = $conn->query($sql);
        printRows($result);
      }
    }
  }
  ?>
  <script>
    //no se necesita ";"
    function validateForm(idForm){
      if(idForm === 1){
        let id = document.forms["delete"]["id"].value
        if(!!id){
          return true
        }else{
          alert("valor faltante")
          return false
        }
      }else {
        let rowNum = document.forms["search"]["rowNum"].value
        let searchTxt = document.forms["search"]["searchText"].value
        if(!!rowNum || !!searchTxt){
          return true
        }else{
          alert("valor faltante")
          return false
        }
      }
    }

  </script>
  <?php
    //cerrar la conexión
    function printRows($resultQuery){
  
      if ($resultQuery->num_rows > 0) {
        // output data of each row
        echo '<ul class="w3-ul w3-hoverable">';
        while($row = $resultQuery->fetch_assoc()) {
          echo "<li>";  
          echo "id: " . $row["id"]. ", Nombre: " . $row["nombre"].
          ",Descripción: " . $row["descripcion"].
          ", Cantidad: " . $row["cantidad"].", precio: " . $row["precio"];
      }
      echo "</ul>";
      } else {
        echo "No hay registros";
      }
    }
    $conn->close();
  ?>  
</div>
</body>
