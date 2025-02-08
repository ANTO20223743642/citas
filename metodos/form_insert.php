<form action="metodos/insert.php" method="post">
    <p class="text-danger"><b>Los datos con (*) son obligatorios. y debe ser de la persona que hara el tramite</b></p>

 

    <div class="form-group">
        <label for="nombre">Nombre *</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tus nombres" required>
        <small class="form-text text-muted">Si tienes dos nombres, colócalos aquí.</small>
    </div>

    <div class="form-group">
        <label for="apellidos">Apellidos *</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escribe tu apellido paterno y materno" required>
        <small class="form-text text-muted">Coloca tus apellidos.</small>
    </div>

    <div class="form-group">
        <label for="carnet">Cedula *</label>
        <input type="text" class="form-control" id="carnet" name="carnet" placeholder="Escribe tu nro. de cedula de identidad" required>
        <small class="form-text text-muted">Coloca tu Nro de Documento.</small>
    </div>

    <div class="form-group">
        <label for="correo">Correo *</label>
        <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@gmail.com" required>
    </div>

    <div class="form-group">
        <label for="servicio">Selecciona el Tramite que realizara en el Sereci *</label>
        <select class="custom-select" id="servicio" name="servicio" required>
            <option value="" selected>Elige...</option>
            <option value="10">Apostilla</option>
            <option value="30">Asentamiento de Divorcios</option>
            <option value="6">Audiencias Control Legal y Tramites Administrativos</option>
            <option value="1">Certificado de Filiación (Descendencia)</option>
            <option value="11">Comprobación de Matrimonio</option>
            <option value="2">Emision de Certificaciones(Solterio, Inexistencia, otros....)</option>
            <option value="6">Homologacion y Registros Realizados en el Extranjero</option>
            <option value="9">Identidad  de Genero</option>
            <option value="8">Registro de Doble Nacionalidad de Personas Nacidas en el Exterior</option>
            <option value="3">Saneamiento de Partida</option>
            <option value="4">Uniones Libres Judiciales</option>
        </select>
    </div>

    

    <a class="nav-link" href="requisitos.php">Ver Requisitos del Tramite</a>



    <div class="form-group">
        <label for="cantidad">Selecciona la cantidad de tramites que realizara en el Sereci *</label>
        <select class="custom-select" id="cantidad" name="cantidad" required>
    
            <option value="1 selected">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>



    <div class="form-group">
    <label for="fecha">Selecciona la FECHA que realizara la Reserva *</label>
    <select name="fecha" id="fecha" class="custom-select mb-3" onchange="recuperarhoras('variable_xyz', this.value)" >  
                                                    
                    <option value="" selected>Seleccione Una Fecha …</option>
                    <option value="2025-02-05">2025-02-05</option>
                    <option value="2025-02-06">2025-02-06</option>              
                </select>
    </div>


<?php
    include "admin/model/conexion.php";

    // Realiza una consulta SQL para seleccionar todos los registros de la tabla"
    // $fechaElegida1 ="2025-02-04";    // $fechaElegida2 ="2025-02-05";

    $query = "SELECT DISTINCT(HORA) as hora FROM HORAS WHERE (FECHA ='2025-02-05' or FECHA ='2025-02-06') AND ESTADO = 'A' ORDER BY HORA";
    $result = $db->query($query);
?>
 

    <div class="form-group">
        <label for="hora">Hora: *</label>
        <select class="form-control" id="hora" name="hora" required>
            <option value="" selected>Elige la hora</option>
                                
           <?php
                // Itera a través de los resultados y muestra cada registro en una fila de la tabla
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row["hora"] . "'>" . $row["hora"] . "</option>";
                }
            ?>
        </select>
    </div>


    <div class="form-group">
        <label for="mensaje">Mensaje adicional:</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
    </div>
    
    <input type="hidden" name="estado" value="Pendiente">
    <input type="hidden" name="oculto" value="1">

    <button type="reset" class="btn btn-warning">Limpiar</button>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>


<script>
        /* 
        Otra forma de captura tanto el valor de un select html, como enviar y recibir variables
        desde el mismo select. Nota: la variable 'variable_xyz' aqui es opcional si deseas enviar alguna 
        variable o valor de acuerdo a tu necesita 
        */
        function recuperarhoras(miVariable,filtro){  
            console.log('El valor de mi variable es :' + miVariable);
            console.log('El valor de mi select ', filtro)
            let id_tramite = document.getElementById('servicio').value
            console.log('El valor de mi id1 ', id_tramite)
            if (id_tramite = 6) {
                /*  recuperar horas de audiencias */
                <?php
                include "admin/model/conexion.php";

                $query = "SELECT DISTINCT(HORA) as hora FROM HORAS_audiencia WHERE (FECHA ='2025-02-05' or FECHA ='2025-02-06') AND ESTADO = 'A' ORDER BY HORA";
                $result = $db->query($query);
                ?>
        
            } else {
                /* no recuperar por ya recupero las horas disponibles */
            }  
        }
</script>
