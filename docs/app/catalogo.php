<?php

include 'conexion.php';
$sql ="SELECT * FROM articulo";
$resultado = $conexion->query($sql);
if($resultado!=false)
{
    $calificaciones = $resultado->fetchAll(PDO :: FETCH_NAMED);
}else 
{
    die('Error en la consulta');
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Catalogo</title>

<?php include 'encabezado.php' ?>

<nav class="breadcrumb px-4 mb-0">
<a class="breadcrumb-item" href="#">Inicio</a>
<span class="breadcrumb-item active"></span>
</nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->

    <div class="row ">
        <div class="col-2 bg-info text-white">
            <p class="p-4">Catálogo</p>
        </div>
        <div class="col-10">
            <div class="row bg-info p-3">
                <div class="col-4 ml-auto">
                </div>
            </div>
            <form action="" method="POST">
                <?php $cont=0;?>
                <?php foreach($calificaciones as $calificacion): ?>

                <?php if($cont==0):?>
                <div class="row">
                    <?php endif ?>
                    <?php if($cont<3):?>
                    <div class="col-md-4">
                        <div class="card border-primary m-2">
                        <a href="producto.php?id=<?=$calificacion['id_articulo']?>">
                            <img class="card-img-top" src="<?=$calificacion['dir_imagen']?>" alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <strong>
                                        <?=$calificacion['nombre']?>
                                    </strong>
                                </h4>
                                <p class="card-text">Precio: $
                                    <?=$calificacion['precio']?>
                                </p>
                                <?php if(isset($_SESSION['usuario'])): ?>
                                <?php if($_SESSION['usuario']=="admin"): ?>
                                <a href="" id="<?=$calificacion['id_articulo']?>" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?=$calificacion['id_articulo']?>">Eliminar</a>
                                <a href="modificar.php?id=<?=$calificacion['id_articulo']?>" class="btn btn-primary">Modificar</a>
                                <input type="hidden" id="<?=$calificacion['id_articulo']?>">                                                                              <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?=$calificacion['id_articulo']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¡Aviso!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        ¿Estás seguro de eliminar el articulo:<?=$calificacion['nombre']?>?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button id="<?=$calificacion['id_articulo']?>" onclick="eliminar(this)" type="button" class="btn btn-danger" data-dismiss="modal">Borrar</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <?php endif ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php $cont++;?>
                    </div>
                    <?php else:?>
                    <?php $cont=0;?>
                    <div class="col-md-4">
                        <div class="card border-primary m-2">
                        <a href="producto.php?id=<?=$calificacion['id_articulo']?>">
                            <img class="card-img-top" src="<?=$calificacion['dir_imagen']?>" alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <strong>
                                        <?=$calificacion['nombre']?>
                                    </strong>
                                </h4>
                                <p class="card-text">Precio: 
                                    <?=$calificacion['precio']?>
                                </p>
                                <?php if(isset($_SESSION['usuario'])): ?>
                                <?php if($_SESSION['usuario']=="admin"): ?>
                                <a href="" id="<?=$calificacion['id_articulo']?>" data-toggle="modal" data-target="#exampleModal<?=$calificacion['id_articulo']?>" class="btn btn-danger">Eliminar</a>
                                <a href="modificar.php?id=<?=$calificacion['id_articulo']?>" class="btn btn-primary">Modificar</a>
                                <input type="hidden" id="<?=$calificacion['id_articulo']?>">
                                                  <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?=$calificacion['id_articulo']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¡Aviso!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        ¿Estás seguro de eliminar el articulo:<?=$calificacion['nombre']?>?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button id="<?=$calificacion['id_articulo']?>" onclick="eliminar(this)" type="button" class="btn btn-danger" data-dismiss="modal">Borrar</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <?php endif ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php $cont++;?>
                    </div>
                    <?php endif ?>

                    <?php endforeach ?>
                    <?php if($cont!=0):?>
                </div>
                <?php endif ?>

                <?php if(isset($_GET['error'])):?>
                <strong>
                    <?=$_GET['error']?>
                </strong>
                <?php endif ?>

                <div class="m-5 text-center">
                    <!-- <button type="submit text-center" class="btn btn-primary">Enviar formulario</button> -->
                    <?php if(isset($_SESSION['usuario'])): ?>
                    <?php if($_SESSION['usuario']=="admin"): ?>
                    <a href="agregar.php" class="btn btn-info">Agregar</a>
                    <?php endif ?>
                    <?php else: ?>
                    <a href="login.php" class="btn btn-success">Iniciar sesión</a>
                    <?php endif ?>
                </div>
            </form>
        </div>
    </div>

    <!-- /Cuerpo -->
    <script src="js/funciones.js"></script>
    <?php include 'pie.php'?>