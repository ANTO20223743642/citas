<?php
include "header.php";
include "navbar.php";
include "admin/model/conexion.php";


// Realiza una consulta SQL para seleccionar todos los registros de la tabla "REQUISITOS"
$query = "SELECT descripcion FROM sereci_tramites where id = 1";
$result = $db->query($query);


?>

<div class="container" style="margin-top: 30px">
  <div class="row">
    <div class="col">
      <h2>REQUISITOS DEL TRAMITE</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Estos son nuestros Requisitos que deben traer para el Tramite</th>´
            
          </tr>
        </thead>
        <tbody>
          <?php
          // Itera a través de los resultados y muestra cada registro en una fila de la tabla
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['descripcion'] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
