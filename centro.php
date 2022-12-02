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
  <nav class="navbar navbar-inverse" style="margin: 0">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="welcome.php">DB</a>
        <label class="navbar-brand">Centro</label>
      </div>
      <ul class="nav navbar-nav">
        
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Acciones <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="altaCentro.html">Crear</a></li>
            <li><a href="upCentro.html">Actualizar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tablas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="sala.php">Sala</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
      </ul>
    </div>
  </nav>
    
  <div class="container">

  </div>

  <div class="w3-container w3-blue">
    <h2>Buscar Registro</h2>
  </div>
  <form name="search" class="w3-container" action="<?php $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm(2)" method="post">
    texto de busqueda: <input class="w3-input" type="text" name="searchTextCentro">
    <br>
    <input class="w3-button w3-black" type="submit" value="Enviar">
  </form>
  <?php
  require_once "config.php";
  if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(!empty($_POST["searchTextCentro"])){     
      $searchText = $_POST["searchTextCentro"];
      printSearch($link,$searchText);      
    }
  }
  ?>
  

  <br>
  <div class="w3-container" style ="padding: 0">    
  <div class="w3-container w3-blue">
    <h2>Listado de registros de la agenda</h2>
  </div>
  <?php
    if(isset($_POST["insertBtnCentro"])){
      addCentro($link);

    }
    else if(isset($_POST["DeleteBtnCentro"])){
      deleteSelected($link);
    }
    else if(isset($_POST["EditBtnCentro"])){
      session_start();
      $_SESSION["idCentro"] = $_POST["searchDrop"];
      header("location: upCentro.html");
    }
    else if(isset($_POST["UpdateBtnCentro"])){
      session_start();
      if(isset($_SESSION["idCentro"])){
        $idEdit = $_SESSION["idCentro"];
        if(!empty($_POST["Nombre"])){
          $nombreEdit = $_POST["Nombre"];
          $sql = "UPDATE centro SET Nombre = '{$nombreEdit}' WHERE idCentro = {$idEdit}";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        if(!empty($_POST["Telefono"])) {
          $telefonoEdit = $_POST["Telefono"];
          $sql ="UPDATE centro SET Telefono = '{$telefonoEdit}' WHERE idCentro = {$idEdit}";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        if(!empty($_POST["Direccion"])){
          $direccionEdit = $_POST["Direccion"];
          $sql = "UPDATE centro SET Direccion = '{$direccionEdit}' WHERE idCentro = {$idEdit}";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        if(!empty($_POST["Email"])){
          $emailEdit = $_POST["Email"];
          $sql = "UPDATE centro SET Email = '{$emailEdit}' WHERE idCentro = {$idEdit}";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        unset($_SESSION["idCentro"]);
      }else{
        die("No id seleccionada");
      }
    }
    //Listar los registros que tiene la tabla persona de la base de datos tercera
    printRows($link);

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
    <?php
    function printRows($link){
      $sql = "SELECT * FROM centro";
      $resultQuery = $link->query($sql);
      if ($resultQuery->num_rows > 0) {
        // output data of each row
        echo '<ul class="w3-ul w3-hoverable">';
        while($row = $resultQuery->fetch_assoc()) {
          echo "<li>";  
          echo "Nombre: " . $row["Nombre"].
          " | Telefono: " . $row["Telefono"].
          " | Direccion: " . $row["Direccion"].
          " | Email: " . $row["Email"];
      }
      echo "</ul>";
      } else {
        echo "No hay registros";
      }
    }
    function printSearch($link,$input){
      $sql = "SELECT * FROM centro WHERE Nombre LIKE '%{$input}%' OR
              Telefono LIKE '%{$input}%' OR Direccion LIKE '%{$input}%'
              OR Email LIKE '%{$input}%'";
      $resultQuery = $link->query($sql);
      if ($resultQuery->num_rows > 0) {
        // output data of each row
        echo '<div class="d-flex justify-content-center" id="searchDiv">
              <form name="deleteCentro" action="#" method="post"><select name="searchDrop">';
        while($row = $resultQuery->fetch_assoc()) {
          echo "<option value ='{$row["idCentro"]}'>";  
          echo "Nombre: " . $row["Nombre"].
          "         | Telefono: " . $row["Telefono"].
          "         | Direccion: " . $row["Direccion"]." | Email: " . $row["Email"]. "</option> ";
      }
      echo "</select> 
            <input class='w3-button w3-red' type='submit' name='DeleteBtnCentro' value='Borrar'>
            <input class='w3-button w3-khaki' type='submit' name='EditBtnCentro' value='Editar'> </form> </div>";
      } else {
        echo "No hay registros";
      }
    }
    function addCentro($conn){
      $nombre=$_POST["Nombre"];
      $telefono=$_POST["Telefono"];
      $direccion=$_POST["Direccion"];
      $email=$_POST["Email"];
      $sql = "CALL addValues(1,'{$nombre}','{$telefono}','{$direccion}','{$email}')";
      $result = $conn->query($sql);
      if ($result !== TRUE){
        echo '<div class="w3-panel w3-red">'.
        "<h3>Error: ". $sql . "<br>" . $conn->error.
        "</h3></div>";
      }else{
        echo '<div class="w3-panel w3-green">'.
        "<h3> Registro añadido con éxito </h3></div>";
      }
      
    }
    function deleteSelected($link){
      $selected_id = $_POST["searchDrop"];
      $sql = "DELETE FROM centro WHERE idCentro ={$selected_id}";
      $result = $link ->query($sql);
      if ($result !== TRUE){
        echo '<div class="w3-panel w3-red">'.
        "<h3>Error: ". $sql . "<br>" . $link->error.
        "</h3></div>";
      }else{
        echo '<div class="w3-panel w3-red">'.
        "<h3> Registro borrado con éxito </h3></div>";
      }
    }
    ?>

  </script>
    
</div>
</body>
