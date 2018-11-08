<?php
include 'conexion.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
        $sql="DELETE FROM articulo WHERE id_articulo=:id";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':id',$id);
        $sentencia->execute();
        if($sentencia->fetch()!=false){
            $errores="Error al eliminar";
        }
        else{
            $correcto="Registro eliminado";
            header("Location:catalogo.php?error=$correcto");
        }
    }else{
        $errores="Falta proporcionar parametro ID";
    }
}