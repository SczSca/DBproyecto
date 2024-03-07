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
      <label class="navbar-brand">Sala</label>
    </div>
    <ul class="nav navbar-nav">
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Acciones <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="altaSala.html">Crear</a></li>
          <li><a href="upSala.html">Actualizar</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tablas <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="centro.php">Centro</a></li>
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
    texto de busqueda: <input class="w3-input" type="text" name="searchTextSala">
    <br>
    <label for="">INTRODUCIR SOLO UNO</label>
    <input class="w3-button w3-black" type="submit" value="Enviar">
  </form>
  <?php
  require_once "config.php";
  if($_SERVER["REQUEST_METHOD"] === "POST"){

    if((!empty($_POST["searchTextSala"]))){

        $searchText = $_POST["searchTextSala"];
        printSearch($link,$searchText);

      }
  }
  ?>
  <br>
  <div class="w3-container" style ="padding: 0">    
  <div class="w3-container w3-blue">
    <h2>Registros de Sala</h2>
  </div>
  <?php
    if(isset($_POST["insertBtnSala"])){
      addSala($link);
    }
    else if(isset($_POST["DeleteBtnSala"])){
      deleteSelected($link);
    }
    else if(isset($_POST["EditBtnSala"])){
      session_start();
      $_SESSION["idSala"] = $_POST["searchDrop"];
      header("location: upSala.html");
    }
    else if(isset($_POST["UpdateBtnSala"])){
      session_start();
      if(isset($_SESSION["idSala"])){
        $idEdit = $_SESSION["idSala"];
        if(!empty($_POST["Nombre"])){
          $nombreEdit = $_POST["Nombre"];
          $sql = "UPDATE Sala SET Nombre = '{$nombreEdit}' WHERE idSala = {$idEdit}";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        if(!empty($_POST["Tipo"])) {
          $tipoEdit = $_POST["Tipo"];
          $sql ="UPDATE Sala SET Tipo = '{$tipoEdit}' WHERE idSala = {$idEdit}";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        if(!empty($_POST["Descripcion"])){
          $descripcionEdit = $_POST["Descripcion"];
          $sql = "UPDATE Sala SET Descripcion = '{$descripcionEdit}' WHERE idSala = {$idEdit}";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        if(!empty($_POST["IdCentro"])){
          $fkCentroEdit = $_POST["IdCentro"];
          $sql = "CALL updateFkCentro('{$fkCentroEdit}',{$idEdit})";
          $result = $link ->query($sql);
          if ($result !== TRUE){
            echo '<div class="w3-panel w3-red">'.
            "<h3>Error: ". $sql . "<br>" . $link->error.
            "</h3></div>";
          }
        }
        unset($_SESSION["idSala"]);
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

        let searchTxt = document.forms["search"]["searchText"].value
        if(|| !!searchTxt){
          return true
        }else{
          alert("valor faltante")
          return false
        }
      }
    }

  </script>
  <?php
    function printRows($link){
      $sql = "CALL showAllSala()";
      $resultQuery = $link->query($sql);
      if ($resultQuery->num_rows > 0) {
        // output data of each row
        echo '<ul class="w3-ul w3-hoverable">';
        while($row = $resultQuery->fetch_assoc()) {
          echo "<li>";  
          echo "Nombre: " . $row["Nombre"].
          " | Tipo: " . $row["Tipo"].
          " | Descripcion: " . $row["Descripcion"]." | idCentro: " . $row["fkCentro"];
      }
      echo "</ul>";
      } else {
        echo "No hay registros";
      }
    }
    function printSearch($link,$input){
      $concat_input = "'%{$input}%'";
      $sql = "CALL searchSala($concat_input)";
      $resultQuery = $link->query($sql);
      die(var_dump($resultQuery));
      if ($resultQuery->num_rows > 0) {
        // output data of each row
        echo '<div class="d-flex justify-content-center" id="searchDiv">
              <form name="deleteSala" action="#" method="post"><select name="searchDrop">';
        while($row = $resultQuery->fetch_assoc()) {
          echo "<option value ='{$row["idSala"]}'>";  
          echo "Nombre: " . $row["Nombre"].
              " | Tipo: " . $row["Tipo"].
              " | Descripcion: " . $row["Descripcion"].
              " | idCentro: " . $row["fkCentro"]. "</option> ";
      }
      echo "</select> 
            <input class='w3-button w3-red' type='submit' name='DeleteBtnSala' value='Borrar'>
            <input class='w3-button w3-khaki' type='submit' name='EditBtnSala' value='Editar'> </form> </div>";
      } else {
        echo "No hay registros";
      }
    }
    function addSala($conn){
      $nombre=$_POST["Nombre"];
      $tipo=$_POST["Tipo"];
      $descripcion=$_POST["Descripcion"];
      $idCentro=$_POST["IdCentro"];
      $sql = "CALL addValues(2,'{$nombre}','{$tipo}','{$descripcion}','{$idCentro}')";
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
      $sql = "DELETE FROM sala WHERE idSala ={$selected_id}";
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
</div>
</body>
