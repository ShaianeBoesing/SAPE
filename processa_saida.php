<?php
    session_start();
    include_once("conexao.php");    
    
    $sair = '#sair';
    
    if (isset($sair)) {
        $_SESSION['usuario_logado']= "";
        header('location: index.php');
    }

    mysqli_close($conn);
    
?>

