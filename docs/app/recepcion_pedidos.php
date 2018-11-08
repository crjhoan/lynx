<?php
    include 'conexion.php';

    $sql = "SELECT * FROM venta";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();

    if($sentencia == true)
    {
        $ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>Recepcion de pedidos</title>

<?php include 'encabezado.php';?>

    <nav class="breadcrumb px-4 mb-0">
        <a class="breadcrumb-item" href="#">Inicio</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->
<div class="container">
    <div class="row my-4">
        <div class="col-md-12">
    <h1 class="Display-2 text-center">Lista de Pedidos</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Pedido</th>
                    <th>Dirección</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ventas as $venta) : 
                    $sql = "SELECT * FROM usuario WHERE id_usuario=:id";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindValue(':id', $venta->id_usuario);
                    $sentencia->execute();
                    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
                    ?>
                    <tr>
                        <td scope="row"><?=$usuario->nombre_completo?></td>
                        <td><?=$venta->id_venta?></td>
                        <td><?=$usuario->direccion?></td>
                        <td><?=$venta->total?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

    <!-- /Cuerpo -->

    <?php include 'pie.php';?>