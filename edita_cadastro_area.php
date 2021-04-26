<?php 

session_start();
include_once("conexao.php");    
    


if (isset($_POST['salvar'])){
    
    $idArea= $_POST["id_area"];
    $nomeArea= $_POST["nome_area"];
    
    $sql_nome_area =  "SELECT nomeArea, idArea FROM area WHERE nomeArea = '$nomeArea';";
    $result_nome_area = mysqli_query($conn, $sql_nome_area);
    $linhasAfetadas = mysqli_affected_rows($conn);
    $dado = mysqli_fetch_assoc($result_nome_area);
    $id_area = $dado["idArea"];

    echo $linhasAfetadas;
    if (($linhasAfetadas > 0) && ($idArea != $id_area)){
        
            $_SESSION['mensagem_erro']= "Já existe uma área cadastrada com este mesmo nome.";
            echo "<script language='javascript'>history.back()</script>";
            die();                

    } else { 

            $sql="UPDATE area SET nomeArea='$nomeArea' WHERE idArea='$idArea'";
            $result_area = mysqli_query($conn,$sql);
            header('location: pagina_visualizar_areas.php');
            die();                

    }
}
?>
