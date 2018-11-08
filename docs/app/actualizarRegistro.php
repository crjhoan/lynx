

<!doctype html>
<html lang="en">

<head>
    <title>Actualizar datos</title>

<?php include 'encabezado.php';?>

<?php
include 'conexion.php';
$errores="";

if($_SERVER['REQUEST_METHOD']=='GET'){
        $id=filter_input(INPUT_GET,'usern',FILTER_SANITIZE_STRING);;
        $sql="SELECT * FROM usuario WHERE usernam=:usernam";
        $sentencia=$conexion->prepare($sql);
        $usernam=$_SESSION['usuario'];
        $sentencia->bindValue(':usernam',$usernam);
        $sentencia->execute();
        $datos=$sentencia->fetch(PDO::FETCH_NAMED);
        if($datos==false){
            $errores="ID de registro no existente";
        }else{
        $username= $datos['usernam'];
        $nombre_completo= $datos['nombre_completo'];
        $direccion= $datos['direccion'];
        $email= $datos['email'];
        $sexo= $datos['sexo'];
        }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_POST['contraseña1']==$_POST['contraseña2']){
        $nombreC = filter_input(INPUT_POST,'nombreC',FILTER_SANITIZE_STRING);
        $contraseña = filter_input(INPUT_POST,'contraseña1',FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
        $direccion = filter_input(INPUT_POST,'direccion',FILTER_SANITIZE_STRING);
        $direccion =$direccion. ", " . $_POST['ciudad'] . ", " . $_POST['estado'];
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $sexo = filter_input(INPUT_POST,'sexo',FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM usuario WHERE usernam=:usuario";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':usuario',$username);
        $sentencia->execute();

        $sql="UPDATE usuario SET usernam=:username, contrasena=:contrasena,nombre_completo=:nombre_completo,direccion=:direccion,email=:email,sexo=:sexo WHERE usernam=:usernam";
        $sentencia = $conexion->prepare($sql);
        $hash_contraseña=password_hash($contraseña,PASSWORD_DEFAULT);
            $sentencia->bindValue(':username', $username);
            $sentencia->bindValue(':usernam', $username);
            $sentencia->bindValue(':contrasena', $hash_contraseña);
            $sentencia->bindValue(':nombre_completo', $nombreC);
            $sentencia->bindValue(':direccion', $direccion);
            $sentencia->bindValue(':email', $email);
            $sentencia->bindValue(':sexo', $sexo);
            $sentencia->execute();
        if($sentencia->fetch()!=false){
            $errores="Error al modificar";
        }
        else{
            $correcto="Registro actualizado";
            header("Location: index.php?correcto=$correcto");
        }
    }
}
?>

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
                        <input type="text" value="<?=$username?>" class="form-control" id="nombres" name="username" placeholder="Introduzca sus nombre de usuario" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="direccion">Dirección: </label>
                        <input type="text" value="<?=$direccion?>" class="form-control" id="direccion" name="direccion" placeholder="Introduzca su direccion" required autofocus>
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
                        <input type="text" value="<?=$nombre_completo?>" class="form-control" id="apellidos" name="nombreC" placeholder="Introduzca su nombre completo" required autofocus>
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
                        <input type="email" value="<?=$email?>" class="form-control" id="email" name="email" placeholder="Introduzca su email" required autofocus>
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
                <input type="submit" class="btn btn-primary btn-info" value="Actualizar">
                <input type="reset" class="btn btn-default btn-dark" value="Limpiar">
            </div>
        </div>
    </form>

    <?php if(isset($_SESSION['correcto']) && $_SESSION['correcto'] != "") : ?>
        <div class="alert alert-success" role="alert">
            <strong>Usuario registrado</strong><a href="login.php">Iniciar sesión</a>
        </div>
    <?php endif ?>

    <?php if(isset($_SESSION['error']) && $_SESSION['error'] != "") : ?>
        <div class="alert alert-danger" role="alert">
            <strong>Error</strong><a href="login.php"><?=$_SESSION['error']?></a>
        </div>
    <?php endif ?>
    <!-- /Cuerpo -->

    <?php include 'pie.php';?>