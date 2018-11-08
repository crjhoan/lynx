<?php
$fuente = "mysql:host=localhost;dbname=lynx";
$usuario ="root";
$contraseña="root";
try{
    $conexion= new PDO($fuente, $usuario, $contraseña);
}catch(PDOException $ex){
    echo'Error en la conexion'. $ex->getMessage();
}
?>