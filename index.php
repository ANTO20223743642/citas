<?php 
include "header.php";
include "navbar.php";
?>



<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4 text-center">
      <h2>Reserva Ficha Para Ser Atendido</h2>
      <h5>SERECI - COCHABAMBA</h5>
      <img src="img/logo3.jpg" class="rounded mx-auto d-block border" width="80%" alt="...">
      <p><kbd>Reserva con un solo clic</kbd></p>
      <h3>Accesos rapidos</h3>
      <p>Te presentamos algunas links de accesos.</p>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="mediosContacto.php">Medios de contacto</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.oep.org.bo">Acerca de</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>

    
    <div class="col-sm-8">
      <div class="text-justify">
          <p class="alert alert-info">Has clic en el siguiente botón para iniciar tu reserva en el sistema, en cuánto sea procesada
            se te enviará un mensaje de confirmación al correo electrónico que ingreses en el formulario. 
            <br><b>""</b>.
          </p>
      </div>
      <?php 
      date_default_timezone_set('America/Manaus');

      $hora_actual =date('H:i:s'); // hora actual
      # echo $hora_actual; 	
    
      $hora1 = strtotime( "08:30" );
      $hora2 = strtotime( "23:30" );
    
      if( strtotime($hora_actual) > $hora1 and strtotime($hora_actual) < $hora2) {
          echo ' El Sistema solo esta Vigente de 08:30 a 16:30';
          include "modal_reserva.php";
          #include "metodos/form_insert.php";
      } else {
          echo '<h1> Señor Usuario el Sistema solo esta activo de 8:30 a 16:30 </h1>';
      } 
       
      ?>

      <hr>
      <div class="text-justify">
          <p class="alert alert-warning">Quieres consultar el estado de tu reserva?, 
            no has recibido el mensaje de confirmación o falló el envio?.<a class="nav-link" href="#">Consultar Reserva</a>
          </p>
          
      </div>
      <img src="img/logo3.jpg" class="rounded mx-auto d-block border" width="80%" alt="...">

    </div>
  </div>
</div>





<?php include "footer.php";?>