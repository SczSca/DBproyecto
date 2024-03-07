<div>
  <?php  
// $mysqli = new mysqli('localhost', 'usuario', 'password', 'base_de_datos');
   $mysqli = new mysqli('localhost', 'root', '123456', 'centrosocio');
?>
  <p>Prueba menú desplegable</p>
  <div>                       
       <select>
        <option >Selecciona:</option>
        <?php
          $query = $mysqli -> query ("SELECT * FROM cuidador");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores['id'].'">'.$valores['Nombre'].'</option>';
          }
        ?>
      </select>
      <button>Enviar</button>
    </p>
  </div>
</div>
