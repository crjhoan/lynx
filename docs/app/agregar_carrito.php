<?php
session_start();

include 'conexion.php';
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
$sql ="SELECT * FROM articulo where id_articulo=:id";
$sentencia=$conexion->prepare($sql);
$sentencia->bindValue(':id',$id);
$sentencia->execute();

if($sentencia!=false)
{
    $producto = $sentencia->fetch(PDO::FETCH_OBJ);
}else 
{
    die('Error en la consulta');
}

// Agrega al carrito si existe, si no, crea el carrito en la sesión
if(isset($_COOKIE['carrito']) == true)
{
    $num = $_COOKIE['num_carrito'];
    $carrito = unserialize($_COOKIE['carrito']);
    $num++;
    $carrito[$num] = $producto->id_articulo;

    setcookie('carrito', serialize($carrito), time() + 360000);
    setcookie('num_carrito', $num);
}
else
{
    $carrito = array();
    $carrito[0] = $producto->id_articulo;
    setcookie('carrito', serialize($carrito), time() + 360000);
    setcookie('num_carrito', 0);
}

//var_dump($carrito);
header('Location: producto.php?id=' . $producto->id_articulo);