<?php
include 'conexion.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $comentario=filter_input(INPUT_POST,'comentario',FILTER_SANITIZE_STRING);
    $calificacion=filter_input(INPUT_POST,'calificacion',FILTER_SANITIZE_STRING);
    $id_usuario=filter_input(INPUT_POST,'id_usuario',FILTER_SANITIZE_STRING);
    $id_articulo=filter_input(INPUT_POST,'id_articulo',FILTER_SANITIZE_STRING);
    $sql="INSERT INTO comentario (comentario,id_usuario,id_articulo,calificacion) VALUES (:com, :id_u,:id_a,:cal)";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':com',$comentario);
    $sentencia->bindValue(':id_u',$id_usuario);
    $sentencia->bindValue(':id_a',$id_articulo);
    $sentencia->bindValue(':cal',$calificacion);
    $sentencia->execute();
    if($sentencia->fetch()!=false){
        die("Error al momento de insertar en la base de datos");
    }
    header("Location: producto.php?id=$id_articulo");
}

$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
$sql ="SELECT * FROM articulo where id_articulo=:id";
$sql1 ="SELECT * FROM comentario where id_articulo=:id";
$sentencia=$conexion->prepare($sql);
$sentencia1=$conexion->prepare($sql1);
$sentencia->bindValue(':id',$id);
$sentencia1->bindValue(':id',$id);
$sentencia->execute();
$sentencia1->execute();

if($sentencia!=false)
{
    $calificaciones = $sentencia->fetch(PDO::FETCH_OBJ);
}else 
{
    die('Error en la consulta');
}
if($sentencia1!=false)
{
    $comentarios = $sentencia1->fetchAll(PDO :: FETCH_NAMED);
}else 
{
    die('Error en la consulta');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Producto</title>
<?php include 'encabezado.php';?>
<?php
    if(isset($_SESSION['usuario']) == true)
    {
        $sql2 ="SELECT * FROM usuario where usernam=:usernam";
        $sentencia2=$conexion->prepare($sql2);
        $sentencia2->bindValue(':usernam',$_SESSION['usuario']);
        $sentencia2->execute();

        if($sentencia!=false)
        {
            $calificaciones2 = $sentencia2->fetch(PDO::FETCH_OBJ);
        }else 
        {
            die('Error en la consulta');
        }
    }
?>

    <nav class="breadcrumb px-4 mb-0">
        <a class="breadcrumb-item" href="index.php">Inicio</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselId" class="carousel slide m-4 p-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner " role="listbox">
                        <div class="carousel-item active">
                            <img class="img-fluid" src="<?=$calificaciones->dir_imagen?>" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="m-4 p-4">
                    <h1 class="text-center"><?=$calificaciones->nombre?></h1>
                    <p>Precio: $ <?=$calificaciones->precio?></p>
                    <p>Cantidad:</p>
                    <a href="agregar_carrito.php?id=<?=$calificaciones->id_articulo?>" class="btn btn-success">Agregar</a>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#caracteristicas" role="tab" aria-controls="home" aria-selected="true">Caracteristícas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#descripcion" role="tab" aria-controls="profile" aria-selected="false">Descripción del producto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#comentarios" role="tab" aria-controls="contact" aria-selected="false">Opiniones * * * * *</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#dcomentario" role="tab" aria-controls="contact" aria-selected="false">Dejar comentario</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="caracteristicas" role="tabpanel" aria-labelledby="home-tab">
                <div>
                <p><?=$calificaciones->caracteristicas?></p>
                </div>
            </div>
            <div class="tab-pane fade" id="descripcion" role="tabpanel" aria-labelledby="profile-tab">
                <div>
                <p><?=$calificaciones->descripcion?></p>
                </div>
            </div>
            <div class="tab-pane fade" id="comentarios" role="tabpanel" aria-labelledby="contact-tab">
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Comentario</th>
                                <th>Calificaciòn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($comentarios as $comentario) :
                                $sql = "SELECT * FROM usuario WHERE id_usuario = :id";
                                $sentencia = $conexion->prepare($sql);
                                $sentencia->bindValue(':id', $comentario['id_usuario']);
                                $sentencia->execute();
                                if($sentencia == true)
                                {
                                    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);
                                }
                                ?>
                                <tr>
                                    <td><?=$usuario->usernam?></td>
                                    <td><?=$comentario['comentario']?></td>
                                    <td><?=$comentario['calificacion']?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Dejar comentario -->
            <?php if(isset($_SESSION['usuario'])) : ?>
                <div class="tab-pane fade" id="dcomentario" role="tabpanel" aria-labelledby="profile-tab">
                    <form action="" method="POST">
                        <div class="form-group">
                        <label for="comentario">Comentario: </label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                        <label >Calificación:</label>
                        <input type="range" list="tickmarks" name="calificacion">
                        <datalist id="tickmarks">
                        <option value="0" label="0%">
                        <option value="10">
                        <option value="20">
                        <option value="30">
                        <option value="40">
                        <option value="50" label="50%">
                        <option value="60">
                        <option value="70">
                        <option value="80">
                        <option value="90">
                        <option value="100" label="100%">
                        </datalist>
                        </div>
                        <input type="hidden" name="id_usuario" value="<?=$calificaciones2->id_usuario?>">
                        <input type="hidden" name="id_articulo" value="<?=$id?>">
                        <input name="enviar" id="enviar" class="btn btn-info" type="submit" value="Enviar">
                    </form>
                </div>
            <?php else : ?>
                <div class="tab-pane fade text-center my-3" id="dcomentario" role="tabpanel" aria-labelledby="profile-tab">
                    <h2>Inicia sesión para dejar un comentario</h2>
                </div>
            <?php endif ?>
            <!-- Dejar comentario FIN -->

        </div>
    </div>


    <!-- /Cuerpo -->

    <?php include 'pie.php';?>