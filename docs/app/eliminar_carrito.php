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

if(isset($_COOKIE['carrito']) == true)
{
    $num = $_COOKIE['num_carrito'];
    if($num == 0)
    {
        unset($_COOKIE['carrito']);
        unset($_COOKIE['num_carrito']);
        $res = setcookie('carrito', '', time() - 3600);
        $res = setcookie('num_carrito', '', time() - 3600);
    }
    else
    {
        $carrito = unserialize($_COOKIE['carrito']);
        $num--;
        $llave = array_search($producto->id_articulo);
        array_splice($carrito, $llave, 1);
        setcookie('carrito', serialize($carrito), time() + 3600);
        setcookie('num_carrito', $num);
    }
}

//var_dump($carrito);
header('Location: carrito.php');