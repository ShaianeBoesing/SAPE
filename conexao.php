<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$bd = "teste_php";

$conn = mysqli_connect($host, $usuario, $senha, $bd) or die(mysqli_connect_error()); 


mysqli_set_charset($conn,"utf8");
    
if (mysqli_connect_errno())
{
    echo "Falha na conexão com MySQL: " . mysqli_connect_error();
}
?>
