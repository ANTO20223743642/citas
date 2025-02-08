<?php
#prueba de envio de datos
#print_r($_POST);

# Verificar si se ha enviado el formulario
if (!isset($_POST['oculto'])) {
    exit(); // Si no se ha enviado, salir del script.
}

# Incluir el archivo de conexión a la base de datos
include '../admin/model/conexion.php';

# Obtener los datos del formulario
# ver que ventanilla se esta asignando
#  $ventanilla = $_POST['ventanilla']; 
$ventanilla = "V01";
# RECUPERAR VENTANILLA DISPONIBLE 
$consulta = $db->prepare("select distinct(ventanilla) as venta from horas where fecha = ? and hora = ? and estado ='A'");
$consulta->execute([$fecha, $hora]);
$ventanilla = $consulta->fetchColumn();
echo $ventanilla;

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];

$carnet = $_POST['carnet'];

$correo = $_POST['correo'];

$servicio = $_POST['servicio'];

$cantidad = $_POST['cantidad'];

$fecha = $_POST['fecha'];

# MOSTRAR HORAS DISPONIBLES --> SELECT DISTINCT(HORA) FROM HORAS WHERE FECHA ='2025-01-20' AND ESTADO = 'A' ORDER BY HORA
# OCTENER VENTANILLA DISPONIBLE --> select ventanilla from horas where fecha ='2025-01-20' and hora ='08:30' and estado = 'A'
$hora = $_POST['hora'];
$mensaje = $_POST['mensaje'];
$estado = $_POST['estado'];
#       $horafinal = $_POST['horafinal'];

# Verificar si ya existe una cita de una misma persona
$consulta = $db->prepare("SELECT COUNT(*) FROM reservas WHERE fecha = ? AND ci_solicitante = ? ");
$consulta->execute([$fecha, $carnet]);
$existeCita = $consulta->fetchColumn();
if ($existeCita >= 1) {
    header('Location: ../error.php');
    echo 'Ya existe una Reserva Programada para la misma persona.';
} else {
    # code...continuar con el registro....
}

# Verificar si ya existe una cita en la misma fecha y hora
$consulta = $db->prepare("SELECT COUNT(*) FROM reservas WHERE fecha = ? AND hora = ? ");
$consulta->execute([$fecha, $hora]);
$existeCita = $consulta->fetchColumn();

if ($existeCita >= 1) {
    header('Location: ../error.php');
    echo 'Ya existe una Reserva Programada para la misma fecha y hora.';
} else {
    # Insertar el nuevo registro si no hay conflicto
    $sentencia = $db->prepare("INSERT INTO reservas(nombre, apellidos, correo, servicio, fecha, hora, mensajeadicional, estado,ventanilla,ci_solicitante,cant_tramites,horafinal)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    
    if ($sentencia->execute([$nombre, $apellidos, $correo, $servicio, $fecha, $hora, $mensaje, $estado,$ventanilla,$carnet,$cantidad,$hora])) {
        // Realiza una consulta SQL para seleccionar todos los registros de la tabla"
       
        $consulta = $db->prepare("update horas set estado = 'I' WHERE hora = ?  AND fecha = ? AND estado = 'A' ");
        $consulta->execute([$hora, $fecha]);

        header('Location: ../exito.php'); // Redirigir si la inserción fue exitosa.
        // header('Location: ../metodos/reporte.php'); // Redirigir si la inserción fue exitosa.
    } else {
        echo 'Error al insertar datos.';
    }
}

# Verificar si Existe disponible para una fecha , hora y ventanilla.
$TiempoTramite = 5;
$NroRegistros = 1;
$Verifica = "TRUE";
While ($NroRegistros > 0) {
    $consulta = $db->prepare("SELECT COUNT(*) FROM reservas WHERE fecha = ? AND hora = ? AND ventanilla = ?  AND estado = 'A'?");
    $consulta->execute([$fecha, $hora, $ventanilla]);
    $existeCita = $consulta->fetchColumn();

    if ($existeCita >= 1) {
        # si existe hora disponible, no hace nada
    } else {
        # SI NO EXISTE ESPACIO DISPONIBLE 
        $Verifica = "FALSE";       
    }
    $hora = $hora + 5;

}
if ($Verifica="TRUE") {
    # INSERTAR REGISTRO DE RESERVA
     
} else {
        
    header('Location: ../error.php');
    echo 'NO SE TIENE HORA DISPONIBLE PARA ESE TRAMITE';
}

?>