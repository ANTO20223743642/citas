<?php
#propiedades de host
$pass='';
$user = 'root';
$namedb = 'citas';

try {
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname='.$namedb, $user, $pass
 );
   # echo 'Exito';
} catch (Exception $error) {
    echo 'error conexion'.$error->getMessage();
    die();
}