<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script src="js/script.js">

</script>
<style>
  .w3-input{
    padding-bottom: 20px;
  }
  .w3-container{
    width: 100%;
  }
</style>
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="welcome.php">DB</a>
    </div>
    <ul class="nav navbar-nav">
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Acciones <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="agenda1.php">Crear</a></li>
          <li><a href="#">Borrar</a></li>
          <li><a href="#">Actualizar</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tablas <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="phpagenda1 - copia.php">Zoo</a></li>
          <li><a href="#">Motos</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid">
  <div class="w3-container w3-blue">
    <h2>Validación de formas con JavaScript</h2>
  </div> <br>
<form name="insert" class="w3-container" action="phpagenda1 - copia.php"  onsubmit="return validateForm(2)" method="post">
  Nombre: <input class="w3-input" type="text" name="nombre">
  <br>
  Descripción: <input class="w3-input" type="text" name="descripcion" style="padding-bottom:50px ;">
  <br>
  Cantidad: <input class="w3-input" type="number" name="cantidad">
  <br>
  Precio: <input class="w3-input" type="number" name="precio">
  <br>
  <input class="w3-button w3-black" type="submit" name="Enviar" value="Enviar">
  <a class="w3-button w3-black" href="phpagenda1.php">Ir a base</a>
</form>
</div>
</body>
</html>