<?php
include 'conexion.php';
$errores="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    session_start();
if(isset($_POST['usuario']) && isset($_POST['contraseña'])){
    $usuario=filter_input(INPUT_POST,'usuario',FILTER_SANITIZE_STRING);
    $contraseña=filter_input(INPUT_POST,'contraseña',FILTER_SANITIZE_STRING);
    $sql="SELECT * FROM usuario WHERE usernam=:usuario";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':usuario',$usuario);
    $sentencia->execute();

    if( $sentencia == true)
    {
        $datos = $sentencia->fetch(PDO::FETCH_OBJ);
        if(password_verify($contraseña, $datos->contrasena))
        {
            $_SESSION['usuario'] = $usuario;
            if($usuario=='admin'){
                header('Location: administrador.php');
            }else{
                header('Location: index.php');
            }
        }else{
        $errores = "Usuario o contraseña no válido";
    }
    }
}}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
            <?php include 'encabezado.php'; ?>


<nav class="breadcrumb px-4 mb-0">
<a class="breadcrumb-item" href="#">Inicio</a>
<span class="breadcrumb-item active"></span>
</nav>

        <div class="container">
            <form action="" method="POST">
                <h1>Login</h1>
                <div class="form-group">
                    <label for="usuario">Nombre de usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de usuario">
                </div>
                <div class="form-group">
                    <label for="contraseña">Ingrese contraseña</label>
                    <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña">
                </div>
                <button type="submit" class="btn btn-info m-2">Acceder</button>
                <a href="registro.php" class="btn btn-dark m-2">Regístrate</a>
            </form>
            <?php if($errores!=""): ?>
            <p>
                <?=$errores?>
            </p>
            <?php endif ?>
        </div>
        <?php include 'pie.php'?>