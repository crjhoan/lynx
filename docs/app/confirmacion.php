<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        setcookie('num_tarjeta', $_POST['numero'], time() + 3600);
    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Confirmación de compra</title>

<?php 
    include 'encabezado.php';
    include 'conexion.php';
    $usuario = $_SESSION['usuario'];
    $sql ="SELECT * FROM usuario where usernam=:usuario";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':usuario',$usuario);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
?>

    <!-- Cuerpo -->
    <div class="container">
        <div class="row my-5">
            <div class="col-md-2">
            </div>
            <div class="col-md-6">
                <h2 class="">Confirmación de compra</h2>
                <h5 class="">Pedido de: <?=$_SESSION['usuario']?></h5>
                <h5 class="">Cantidad de productos: <?=$_COOKIE['num_carrito']?></h5>
                <br>
                <p>Precio sin envio: $<?=$_SESSION['total']?></p>
                <br>
                <h4>Dirección de envio</h4>
                <p><?=$usuario->direccion?></p>
            </div>
            <div class="col-md-3 border border-secondary">
                <h5>Resumen de compra</h5>
                <h6>Envío: $200</h6>
                <h6>Descuento: 0%</h6>
                <br>
                <h5>Total: $<?=$_SESSION['total'] + 200?></h5>
                <a href="generar_venta.php" class="btn btn-secondary">Finalizar compra</a>
                <a href="index.php" class="btn btn-danger">Cancelar compra</a>
            </div>
        </div>
    </div>
    <!-- /Cuerpo -->

    <?php include 'pie.php'?>