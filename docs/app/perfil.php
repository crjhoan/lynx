
<!doctype html>
<html lang="en">

<head>
    <title>Perfil</title>

<?php include 'encabezado.php';?>

<?php

    include 'conexion.php';
    $usuario=$_SESSION['usuario'];
    $sql ="SELECT * FROM usuario where usernam=:usuario";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':usuario',$usuario);
    $sentencia->execute();

    if($sentencia!=false)
    {
        $usuario = $sentencia->fetch(PDO::FETCH_OBJ);

        $sql ="SELECT * FROM venta where id_usuario=:idUsuario";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':idUsuario',$usuario->id_usuario);
        $sentencia->execute();
        $pedidos = $sentencia->fetchAll(PDO::FETCH_OBJ);
    }else 
    {
        die('Error en la consulta');
    }

?>

<nav class=" row breadcrumb px-4 mb-0">
        <div class="col-12">
            <a class="breadcrumb-item  text-info" href="#">Inicio</a>
            <span class="breadcrumb-item active"></span>
        </div>
    </nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->

    <div class="container">
        <div class="row my-5">
            <div class="col-md-3 border border-secondary">
                <ul>
                    <li><a href="#">Información personal</a></li>
                    <li><a href="#">Deseos</a></li>
                    <li><a href="#">Cupones</a></li>
                    <li><a href="#">Cambios y devoluciones</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3><?=$usuario->nombre_completo?></h3>
                <h5>Información <a type="button" href="actualizarRegistro.php" class="btn btn-dark"><i class="far fa-edit"></i></a></h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime perspiciatis eligendi quos nemo quam tempora quis vero, expedita officia rem, ab nostrum, dolore praesentium. Esse tenetur dolorum veritatis architecto dicta?</p>
            </div>
            <div class="col-md-5">
                <h3>Historial de compras</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id_pedido</th>
                            <th scope="col">Detalles</th>
                            <th scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pedidos as $venta) : ?>
                            <tr>
                                <th scope="row"><?=$venta->id_venta?></th>
                                <td><a href="detalles_pedido.php?id=<?=$venta->id_venta?>">Detalles de venta</a></td>
                                <td><?=$venta->total?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /Cuerpo -->

    <?php include 'pie.php';?>