<?php
include 'conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_FILES['archivo']['name']) == true)
    {
        $nombreArchivo=$_FILES['archivo']['name'];
        $temp=$_FILES['archivo']['tmp_name'];
        //move_uploaded_file($temp,"imagenes_arti/".$nombreArchivo);
        $destino = "imagenes_arti/".$nombreArchivo;
        copy($temp, $destino);
    }
    $calificacion=filter_input(INPUT_POST,'calificacion',FILTER_SANITIZE_STRING);
    $nombre=filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
    $precio=filter_input(INPUT_POST,'precio',FILTER_SANITIZE_STRING);
    $caracteristicas=filter_input(INPUT_POST,'caracteristicas',FILTER_SANITIZE_STRING);
    $descripcion=filter_input(INPUT_POST,'descripcion',FILTER_SANITIZE_STRING);
    $sql="INSERT INTO articulo (id_articulo,nombre,precio,calificacion,dir_imagen,caracteristicas,descripcion) VALUES (NULL,:nombre, :precio,:cali,:dir,:car,:descr)";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':nombre',$nombre);
    $sentencia->bindValue(':precio',$precio);
    $sentencia->bindValue(':cali',$calificacion);
    $sentencia->bindValue(':dir',$destino);
    $sentencia->bindValue(':car',$caracteristicas);
    $sentencia->bindValue(':descr',$descripcion);
    $sentencia->execute();
    if($sentencia->fetch()!=false){
        die("Error al momento de insertar en la base de datos");
    }
    header("Location: catalogo.php");
}
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Agregar</title>
        <!-- Required meta tags -->
        <?php include 'encabezado.php' ?>
        <div class="container">
            <form action="" method='POST' class="m-5" enctype="multipart/form-data">
            <h1 class="text-center">Agregar Articulo</h1>
                <div class="form-group">
                    <label for="producto">Nombre de articulo</label>
                    <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="number" class="form-control" name="cant" id="cant" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Precio</label>
                    <input type="number" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Calificacion</label>
                    <input type="number" class="form-control" name="calificacion" id="calificacion" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Caracteristicas</label>
                    <textarea rows="6" type="text" class="form-control" name="caracteristicas" id="caracteristicas" aria-describedby="helpId" placeholder=""></textarea>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea rows="6" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder=""></textarea>
                </div>
                <div class="form-group">
                  <label for="imagen">Cargue imagen</label>
                  <input type="file"
                    class="form-control" name="archivo" id="archivo" aria-describedby="helpId" placeholder="">
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
                <a href="index.php" class="btn btn-primary">Cancelar</a>
            </form>
        </div>

<?php include 'PIE.php' ?>