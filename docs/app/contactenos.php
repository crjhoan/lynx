<?php
include 'conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $nombre=filter_input(INPUT_POST,'nombre_completo',FILTER_SANITIZE_STRING);
    $telefono=filter_input(INPUT_POST,'telefono',FILTER_SANITIZE_STRING);
    $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
    $mensaje=filter_input(INPUT_POST,'mensaje',FILTER_SANITIZE_STRING);
    $sql="INSERT INTO mensaje (nombre_completo,telefono,email,mensaje,id_mensaje) VALUES (:nombre, :telefono,:email,:mensaje,NULL)";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':nombre',$nombre);
    $sentencia->bindValue(':telefono',$telefono);
    $sentencia->bindValue(':email',$email);
    $sentencia->bindValue(':mensaje',$mensaje);
    $sentencia->execute();
    if($sentencia->fetch()!=false){
        die("Error al momento de insertar en la base de datos");
    }
    header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Contactenos</title>

<?php include 'encabezado.php';?>

<?php 
$nombre_completo= "";
$direccion="";
$email="";
if(isset($_SESSION['usuario'])){
        $usuario=$_SESSION['usuario'];
        $sql="SELECT * FROM usuario WHERE usernam=:usuario";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':usuario',$usuario);
        $sentencia->execute();
        $datos=$sentencia->fetch(PDO::FETCH_NAMED);
        if($datos==false){
            $errores="ID de registro no existente";
        }
        $nombre_completo= $datos['nombre_completo'];
        $direccion=$datos['direccion'];
        $email=$datos['email'];
}
?>

    <nav class="breadcrumb px-4 mb-0">
        <a class="breadcrumb-item text-info" href="#">Inicio</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->

    <div class="container">
    <form action="" method="POST">
        <h1 class="text-center my-3">Contactenos</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="nombre_completo">Nombre completo: </label>
                    <input type="text" class="form-control" id="nombre_completo" value="<?=$nombre_completo?>" name="nombre_completo" placeholder="Introduzca sus nombres" required autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label" for="telefono">Telefono: </label>
                    <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Introduzca su telefono" required autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">Email: </label>
                    <input type="email" class="form-control" id="email" value="<?=$email?>" name="email" placeholder="Introduzca su email" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label" for="Mensaje">Mensaje</label>
                <textarea rows="12" cols="30" class="form-control" id="mensaje" name="mensaje" placeholder="Introduzca su mensaje" required></textarea>
            </div>
        </div>
        <div class="form-group text-center my-3">
            <input type="submit" class="btn btn-primary btn-info" value="Enviar">
            <input type="reset" class="btn btn-default btn-dark" value="Limpiar">
        </div>
        </form>
    </div>

    <!-- /Cuerpo -->

    <?php include 'pie.php';?>