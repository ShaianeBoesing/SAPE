<?php 

session_start();
include_once("conexao.php");    
    

if (isset($_POST['salvar'])){
    

    $idMateria= $_POST["id_materia"];
    $nomeMateria= $_POST["nome_materia"];
    $areaMateria= $_POST["area_materia"]; // vai passar o id da area da matéria
    
    $sql_nome_area = "SELECT nomeArea FROM area WHERE idArea = $areaMateria;"; //busca a área pelo id
    $result_nome_area = mysqli_query($conn, $sql_nome_area); 
    $dados = mysqli_fetch_assoc($result_nome_area); 
    $nomeArea = $dados['nomeArea']; // traz o nome da área do banco de dados.
    
    $sql_nome_materia = "SELECT nomeMateria, idMateria FROM materia WHERE nomeMateria = '$nomeMateria';";
    $result_nome_materia = mysqli_query($conn, $sql_nome_materia);
    $linhasAfetadas = mysqli_affected_rows($conn);
    $dado = mysqli_fetch_assoc($result_nome_materia);
    $id_materia = $dado["idMateria"];


    if (($linhasAfetadas > 0) && ($idMateria != $id_materia)){
         
            $_SESSION['mensagem_erro']= "Já existe uma matéria cadastrada com este mesmo nome.";
            echo "<script language='javascript'>history.back()</script>";
            die();                

    } else { 



        $sql_atualiza_materia="UPDATE materia SET nomeMateria='$nomeMateria', areaMateria='$nomeArea', idArea=$areaMateria WHERE idMateria=$idMateria;";
        $result_materia = mysqli_query($conn, $sql_atualiza_materia); 
        header('location: pagina_visualizar_materias.php');
        die();                

    }
}

?>
