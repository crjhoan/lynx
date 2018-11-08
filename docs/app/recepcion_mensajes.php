<?php

include 'conexion.php';
$sql ="SELECT * FROM mensaje";
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
    <title>Recepcion de mensajes</title>

<?php include 'encabezado.php';?>

    <nav class="breadcrumb px-4 mb-0">
        <a class="breadcrumb-item" href="#">Inicio</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <!-- /Encabezado -->

    <!-- Cuerpo -->

    <div class="container">
        <h1 class="Display-2 m-3 text-center">Recepción de mensajes</h1>
        <div class="row m-4">
            <div class="col-md-6">
                <div class="table-responsive my-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id_mensaje</th>
                                <th>Nombre completo</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($calificaciones as $calificacion): ?>
                            <tr onclick="alerta(this)" id="<?=$calificacion['id_mensaje']?>">
                                <td scope="row" ><?=$calificacion['id_mensaje']?></td>
                                <td><?=$calificacion['nombre_completo']?></td>
                                <td><?=$calificacion['email']?></td>
                                <input type="hidden" id="<?=$calificacion['id_mensaje']?>username" value="<?=$calificacion['nombre_completo']?>">
                                <input type="hidden" id="<?=$calificacion['id_mensaje']?>mostrar" value="<?=$calificacion['mensaje']?>">
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 text-justify">
                <h1 id="username" class="text-capitalize Display-4">Usuario</h1>
                <p id="mensaje"></p>
                <textarea name="respuesta" id="" cols="50" rows="10" placeholder="Respuesta"></textarea>
                <div>
                <a href="#" class="btn btn-success">Responder</a>
                </div>
            </div>
        </div>
    </div>

    <!-- /Cuerpo -->
    <script src="js/funciones.js"></script>
    <?php include 'pie.php';?>