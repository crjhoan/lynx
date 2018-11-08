<?php

    include 'conexion.php';

    if($_SERVER['REQUEST_METHOD'] =='POST')
    {
        $busqueda = "%";
        $busqueda .= filter_input(INPUT_POST,'busqueda',FILTER_SANITIZE_STRING);
        $busqueda .= "%";
        $sql = "SELECT * FROM articulo WHERE nombre LIKE '$busqueda'";
        $resultado = $conexion->query($sql);
        if($resultado!=false)
        {
            $calificaciones = $resultado->fetchAll(PDO :: FETCH_NAMED);
        }else 
        {
            die('Error en la consulta');
        }
    }
    else
    {
        $sql ="SELECT * FROM articulo limit 8";
        $resultado = $conexion->query($sql);
        if($resultado!=false)
        {
            $calificaciones = $resultado->fetchAll(PDO :: FETCH_NAMED);
        }else 
        {
            die('Error en la consulta');
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>Principal</title>

<?php include 'encabezado.php';?>

    <nav class=" row breadcrumb px-4 mb-0">
        <div class="col-12">
            <a class="breadcrumb-item  text-info" href="index.php">Inicio</a>
            <span class="breadcrumb-item active"></span>
        </div>
    </nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->

    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselId" data-slide-to="0" class="active"></li>
            <li data-target="#carouselId" data-slide-to="1"></li>
            <li data-target="#carouselId" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="img-fluid" src="images/banner2.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/banner5.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="images/banner7.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    

    <div class="row my-4 px-4">
    <?php $cont=0;?>
    <?php foreach($calificaciones as $calificacion): ?>
<?php if($cont==0):?>
<div class="row">
    <?php endif ?>
    <?php if($cont<4):?>
    <div class="col-md-3">
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
                    <strong>$<?=$calificacion['precio']?></strong>
                </p>
            </div>
        </div>
        <?php $cont++;?>
    </div>
    <?php else:?>
    <?php $cont=0;?>
    <div class="col-md-3">
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
                    <strong>$<?=$calificacion['precio']?></strong>
                </p>
            </div>
        </div>
        <?php $cont++;?>
    </div>
    <?php endif ?>

    <?php endforeach ?>
    <?php if($cont!=0):?>
</div>
<?php endif ?>

    </div>

    <!-- /Cuerpo -->

    <?php include 'pie.php' ?>