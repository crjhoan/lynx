<?php
session_start();
include 'conexion.php';
if(isset($_COOKIE['num_carrito']) == true)
{
    $carrito = unserialize($_COOKIE['carrito']);
    $usuario = $_SESSION['usuario'];
    $sql ="SELECT * FROM usuario where usernam=:usuario";
    $sentencia=$conexion->prepare($sql);
    $sentencia->bindValue(':usuario',$usuario);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_OBJ);

    $numero = $_COOKIE['num_tarjeta'];
    $total = $_SESSION['total'];
    $sql = "INSERT INTO venta (total, id_usuario, num_tarjeta)
            VALUES (:total, :idUsuario, :num)";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':total', $total);
    $sentencia->bindValue(':idUsuario', $usuario->id_usuario);
    $sentencia->bindValue(':num', $numero);
    $sentencia->execute();

    if($sentencia == false)
    {
        die("Error");
    }
    $id_venta = $conexion->lastInsertId();

    foreach($carrito as $producto)
    {
        $sql ="SELECT * FROM articulo where id_articulo=:id";
        $sentencia=$conexion->prepare($sql);
        $sentencia->bindValue(':id',$producto);
        $sentencia->execute();
        $articulo = $sentencia->fetch(PDO::FETCH_OBJ);

        $sql = "INSERT INTO detalle_venta (id_articulo, subtotal, id_venta)
                VALUES (:idArticulo, :subtotal, :idVenta)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':idArticulo', $producto);
        $sentencia->bindValue(':subtotal', $articulo->precio);
        $sentencia->bindValue(':idVenta', $id_venta);
        $sentencia->execute();
    }
    unset($_SESSION['total']);
    unset($_COOKIE['carrito']);
    unset($_COOKIE['num_carrito']);
    unset($_COOKIE['num_tarjeta']);
    setcookie('carrito', '', time() - 3600);
    setcookie('num_carrito', '', time() - 3600);
    setcookie('num_tarjeta', '', time() -3600);

    header('Location: index.php');
}
else
{
    header('Location: error_venta.php');
}