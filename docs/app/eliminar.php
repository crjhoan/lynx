<?php
include 'conexion.php';
$errores="";
$correcto="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
        $sql="SELECT * FROM articulo WHERE id_articulo=:id";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':id',$id);
        $sentencia->execute();
        $datos=$sentencia->fetch(PDO::FETCH_NAMED);
        if($datos==false){
            $errores="ID de registro no existente";
        }
        $producto= $datos['nombre'];
        $imagen= $datos['dir_imagen'];
        //$cantidad=$datos['cant'];
    }else{
        $errores="Falta proporcionar parametro ID";
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['id'])){
        $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        $sql="DELETE FROM articulo WHERE id_articulo=:id";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':id',$id);
        $sentencia->execute();
        if($sentencia->fetch()!=false){
            $errores="Error al eliminar";
        }
        else if($sentencia!=1){
            $errores="No se deberia haber eliminado más de uno";
        }
        else{
            $correcto="Registro eliminado";
            header("Location: index.php?error=$correcto");
        }
    }else{
        $errores="Falta proporcionar parametro ID";
    }
}
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Eliminar</title>
        <!-- Required meta tags -->
        <?php include 'encabezado.php' ?>

        <div class="container">
            <h1 class="text-center m-5">Eliminar</h1>
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
            <div class="text-center">
            <?php else:?>
            <?php
            //echo 'Eliminar materia: ';
            //echo $producto.'<br>'.$cantidad.'<br>';
            //echo '¿Esta seguro?';
            ?>
            <div class="text-center">
            <h3 class="text-center">Desea eliminar el siguiente articulo</h2>
            <img src="<?=$imagen?>" alt="" class="img-fluid">
            <h4><?=$producto?></h4>
            
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <button type="submit" class="btn btn-danger m-2">Eliminar</button>
                    <a href="index.php" class="btn btn-info m-2">Cancelar</a>
                </form>
                </div>
                <?php endif?>
                </div>
        </div>


    <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Aviso!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Estas seguro de borrar todo?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button id="btn-borrar" type="button" class="btn btn-danger" data-dismiss="modal">Borrar</button>
        </div>
      </div>
    </div>
  </div>
  <script src="funciones.js"></script>
    <?php include 'pie.php'?>