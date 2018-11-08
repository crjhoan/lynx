<?php
    include 'conexion.php';
    $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
    $sql ="SELECT * FROM detalle_venta where id_venta=:id";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':id',$id);
    $sentencia->execute();
    $articulos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Detalles de pedido</title>
<?php include 'encabezado.php'; ?>
<div class="container">
    <h1 class="mt-5">Detalles del pedido</h1>

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Id producto</th>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($articulos as $venta) : 
                $sql = "SELECT * FROM articulo WHERE id_articulo=:id";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindValue(':id', $venta->id_articulo);
                $sentencia->execute();
                $producto = $sentencia->fetch(PDO::FETCH_OBJ);
                ?>
                <tr>
                    <th scope="row"><?=$venta->id_articulo?></th>
                    <td><?=$producto->nombre?></td>
                    <td><?=$venta->subtotal?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <a href="perfil.php" class="btn btn-secondary mb-5">Regresar</a>
</div>


<?php include 'pie.php'; ?>