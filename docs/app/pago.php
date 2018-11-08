<!doctype html>
<html lang="en">

<head>
    <title>Información de pago</title>

<?php
    include 'encabezado.php';
    include 'conexion.php';
?>

<!-- Pagina de confirmacion de pago -->
<div class="container my-5">
    <?php if(isset($_SESSION['usuario'])) : 
        $usuario=$_SESSION['usuario'];
        $sql ="SELECT * FROM usuario where usernam=:usuario";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':usuario',$usuario);
        $sentencia->execute();
        $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
        ?>
        <h2>Compra de <?=$usuario->nombre_completo?></h2>
        <p>El pedido se enviará a: <?=$usuario->direccion?></p>
        
        <!-- Card de informacion de tarjeta -->
        <div class="card text-left" style="width: 20rem;">
          <div class="card-body">
            <h4 class="card-title">Información de tarjeta</h4>
            <form action="confirmacion.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre en la tarjeta</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre en la tarjeta">

                    <label for="numero">Número de tarjeta</label>
                    <input type="number" class="form-control" name="numero" id="numero" aria-describedby="helpId" placeholder="Numero de tarjeta">

                    <label for="expiracion">Expiración</label>
                    <input type="month" class="form-control" name="expiracion" id="expiracion">

                    <label for="ccv">CCV</label>
                    <input type="number" class="form-control" name="ccv" id="ccv">

                    <input type="submit" value="Continuar" class="btn btn-success form-control">
                </div>
            </form>
          </div>
        </div>
        <!-- FIN -->    
    <?php else : ?>
        <h2>Inicia sesión para poder comprar.</h2>
        <a href="login.php">Iniciar sesión</a>
    <?php endif ?>
</div>

<?php include 'pie.php'; ?>