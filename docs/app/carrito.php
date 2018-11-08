<?php
    include 'conexion.php';

    $total = 0;

    if(isset($_COOKIE['num_carrito']) == true)
    {
        $carrito = unserialize($_COOKIE['carrito']);
        $correcto = true;
    }
    else
    {
        $correcto = false;
    }

?>
<!doctype html>
<html lang="en">

<head>
    <title>Carrito</title>

<?php include 'encabezado.php'; ?>

    <!-- Tabla de articulos INICIA -->
    <div class="container row my-5">
        <?php if($correcto == true) : ?>
            <table class="table table-bordered my-auto mx-5 col-8">
                <thead>
                    <tr>
                        <th></th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($carrito as $id) :
                        $sql ="SELECT * FROM articulo where id_articulo=:id";
                        $sentencia=$conexion->prepare($sql);
                        $sentencia->bindValue(':id',$id);
                        $sentencia->execute();
                        $articulo = $sentencia->fetch(PDO::FETCH_OBJ);
                        $total += $articulo->precio;
                        ?>
                        <tr>
                            <td class="text-center"><img src="<?=$articulo->dir_imagen?>" height="60" width="80" alt=""></td>
                            <td><?=$articulo->nombre?></td>
                            <td><?=$articulo->precio?></td>
                            <td><a href="eliminar_carrito.php?id=<?=$articulo->id_articulo?>">Eliminar</a></td>
                        </tr>
                    <?php endforeach ?>
                    <?php $_SESSION['total'] = $total; ?>
                </tbody>
            </table>

            <!-- Resumen de compra INICIA -->
            <div class="card text-left my-5">
            <div class="card-body">
                <h4 class="card-title">Resumen</h4>
                <p>Total a pagar: <?=$total?></p>
                <a href="pago.php" class="btn btn-warning">Proceder al pago</a>
            </div>
            </div>
            <!-- Resumen de compra TERMINA -->
        <?php else : ?>
            <h2 class="my-5 py-5 px-3">Tu carrito de compra está vacío. ¡Agrega algo para comenzar a comprar!</h2>
        <?php endif ?>
        <!-- Tabla de articulos TERMINA -->
    </div>    

<?php include 'pie.php'; ?>

