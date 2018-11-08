<?php
include 'conexion.php';
$errores="";
$correcto="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);;
        $sql="SELECT * FROM articulo WHERE id_articulo=:id";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':id',$id);
        $sentencia->execute();
        $datos=$sentencia->fetch(PDO::FETCH_NAMED);
        if($datos==false){
            $errores="ID de registro no existente";
        }
        $producto= $datos['nombre'];
        $precio=$datos['precio'];
        $cal=$datos['calificacion'];
        $dir=$datos['dir_imagen'];
        $caracteristicas=$datos['caracteristicas'];
        $descripcion=$datos['descripcion'];
    }else{
        $errores="Falta proporcionar parametro ID";
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['id'])){
        $nombreArchivo=$_FILES['archivo']['name'];
        $temp=$_FILES['archivo']['tmp_name'];
        move_uploaded_file($temp,"imagenes_arti/".$nombreArchivo);
        $dir="imagenes_arti/".$nombreArchivo;
        if($dir=="imagenes_arti/"){$dir=filter_input(INPUT_POST,'imagen',FILTER_SANITIZE_STRING);}
        $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        $articulo=filter_input(INPUT_POST,'producto',FILTER_SANITIZE_STRING);
        $precio=filter_input(INPUT_POST,'precio',FILTER_SANITIZE_STRING);
        $cal=filter_input(INPUT_POST,'cal',FILTER_SANITIZE_STRING);
        $caracteristicas=filter_input(INPUT_POST,'caracteristicas',FILTER_SANITIZE_STRING);
        $descripcion=filter_input(INPUT_POST,'descripcion',FILTER_SANITIZE_STRING);
        $sql="UPDATE articulo SET nombre=:producto,precio=:cantidad,calificacion=:cal,dir_imagen=:dir,caracteristicas=:car,descripcion=:descr WHERE id_articulo=:id";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':producto',$articulo);
        $sentencia->bindValue(':cantidad',$precio);
        $sentencia->bindValue(':cal',$cal);
        $sentencia->bindValue(':dir',$dir);
        $sentencia->bindValue(':id',$id);
        $sentencia->bindValue(':car',$caracteristicas);
        $sentencia->bindValue(':descr',$descripcion);
        $sentencia->execute();
        if($sentencia->fetch()!=false){
            $errores="Error al modificar";
        }
        else{
            $correcto="Registro actualizado";
            header("Location: catalogo.php?correcto=$correcto");
        }
    }else{
        $errores="Falta proporcionar parametro ID";
    }
}
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Modificar</title>
        <!-- Required meta tags -->
        <?php include 'encabezado.php' ?>

    <body>
        <div class="container">
            <?php if($correcto!=""):?>
            <div class="alert alert-success" role="alert">
                <strong>
                    <?=$correcto?>
                </strong>
            </div>
            <?php endif?>

            <?php if($errores!=""):?>
            <div class="alert alert-warning" role="alert">
                <strong>
                    <?=$errores?>
                </strong>
            </div>

            <?php else:?>


            <form action="" method="POST" class="m-5" enctype="multipart/form-data">
            <h1 class="text-center">Modificar</h1>
            <div class="text-center">
                <img src="<?=$dir?>" alt="">
                <input type="hidden" name="imagen" value="<?=$dir?>">
                </div>
                <div class="form-group">
                    <label for="producto">Articulo</label>
                    <input type="text" class="form-control" name="producto" id="producto" value="<?=$producto?>">
                </div>
                <div class="form-group">
                    <label for="cant">Precio</label>
                    <input type="number" class="form-control" name="precio" id="precio" value="<?=$precio?>">
                </div>
                <div class="form-group">
                    <label for="cant">Calificacion</label>
                    <input type="number" class="form-control" name="cal" id="cal" value="<?=$cal?>">
                </div>
                <div class="form-group">
                    <label for="">Caracteristicas</label>
                    <textarea rows="6" type="text" class="form-control" name="caracteristicas" id="caracteristicas" aria-describedby="helpId" placeholder=""><?=$caracteristicas?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea rows="6" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder=""><?=$descripcion?></textarea>
                </div>
                <div class="form-group">
                    <label for="cant">Imagen</label>
                    <input type="file" class="form-control" name="archivo" id="archivo" value="<?=$dir?>">
                </div>
                <input type="hidden" name="id" value="<?=$id?>">
                <div class="text-center">
                <button type="submit" class="btn btn-danger">Actualizar</button>
                <a href="catalogo.php" class="btn btn-info">Cancelar</a>
                </div>
            </form>
            <?php endif?>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <?php include 'PIE.php' ?>