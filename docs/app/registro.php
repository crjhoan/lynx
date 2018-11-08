<?php
include 'conexion.php';
$errores="";
$correcto = "";
if(isset($_GET['correcto'])){$correcto=filter_input(INPUT_GET,'nombreC',FILTER_SANITIZE_STRING);}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_POST['contraseña1']==$_POST['contraseña2']){
        $nombreC = filter_input(INPUT_POST,'nombreC',FILTER_SANITIZE_STRING);
        $contraseña = filter_input(INPUT_POST,'contraseña1',FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
        $direccion = filter_input(INPUT_POST,'direccion',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $sexo = filter_input(INPUT_POST,'sexo',FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM usuario WHERE usernam=:usuario";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':usuario',$username);
        $sentencia->execute();

        $direccion =$direccion. ", " . $_POST['ciudad'] . ", " . $_POST['estado'];
        if($sentencia->fetch()==false){
            $hash_contraseña=password_hash($contraseña,PASSWORD_DEFAULT);
            $sql= "INSERT INTO usuario (usernam, contrasena, nombre_completo,direccion ,email, sexo) 
            VALUES (:usuario, :contrasena,:nombre_completo,:direccion,:email, :sexo)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(':usuario', $username);
            $sentencia->bindValue(':contrasena', $hash_contraseña);
            $sentencia->bindValue(':nombre_completo', $nombreC);
            $sentencia->bindValue(':direccion', $direccion);
            $sentencia->bindValue(':email', $email);
            $sentencia->bindValue(':sexo', $sexo);
            $sentencia->execute();
            $correcto = "Registo exitoso";
            header('location:registro.php?correcto=$correcto');
        }
        else{
            $errores = "Usuario ya registrado";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Registro</title>

<?php include 'encabezado.php';?>

    <nav class="breadcrumb px-4 mb-0">
        <a class="breadcrumb-item" href="#">Inicio</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->

    <div class="container">
        <h1 class="text-center my-3">Formulario de registro</h1>
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="nombres">Nombre de usuario: </label>
                        <input type="text" class="form-control" id="nombres" name="username" placeholder="Introduzca sus nombre de usuario" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="direccion">Dirección: </label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Introduzca su direccion" required autofocus>
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label" for="fecha">Fecha de nacimiento: </label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Introduzca su fecha de nacimiento" required
                            autofocus>
                    </div> -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="apellidos">Nombre completo: </label>
                        <input type="text" class="form-control" id="apellidos" name="nombreC" placeholder="Introduzca su nombre completo" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="ciudad">Ciudad/Estado: </label>
                        <div class="row">
                            <div class="col">
                                <select name="ciudad" class="form-control">
                                    <option value="San Luis Potosì">San Luis Potosì</option>
                                    <option value="Guadalajara">Guadalajara</option>
                                    <option value="Aguascalientes">Aguascalientes</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="estado" class="form-control">
                                    <option value="San Luis Potosì">San Luis Potosì</option>
                                    <option value="Guadalajara">Guadalajara</option>
                                    <option value="Aguascalientes">Aguascalientes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Sexo:</p>
                        <input type="radio" id="femenino" name="sexo" value="Femenino">
                        <label for="femenino">Femenino</label>

                        <input type="radio" id="masculino" name="sexo" value="masculino" checked>
                        <label for="masculino">Masculino</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="email">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Introduzca su email" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="telefono">Contraseña: </label>
                        <input type="password" class="form-control" id="telefono" name="contraseña1" placeholder="Introduzca su contraseña" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="telefono">Confirme contraseña: </label>
                        <input type="password" class="form-control" id="telefono" name="contraseña2" placeholder="Confirme su contraseña" required autofocus>
                    </div>
                </div>
            </div>
            <div class="form-group text-center my-3">
                <input type="submit" class="btn btn-primary btn-info" value="Registrar">
                <input type="reset" class="btn btn-default btn-dark" value="Limpiar">
            </div>
        </form>
    </div>

    <?php if($correcto != "") : ?>
        <div class="alert alert-success" role="alert">
            <strong>Usuario registrado</strong><a href="login.php">Iniciar sesión</a>
        </div>
    <?php endif ?>

    <?php if($errores != "") : ?>
        <div class="alert alert-danger text-center" role="alert">
            <strong>Error </strong><?=$errores?>
        </div>
    <?php endif ?>
    <!-- /Cuerpo -->

    <?php include 'pie.php';?>