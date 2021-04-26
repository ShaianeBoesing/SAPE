<?php 

session_start();
include_once("conexao.php");    
    
if (isset($_POST['salvar'])){

    
    $idConteudo= $_POST["id_conteudo"];
    $nomeConteudo= $_POST["nome_conteudo"];
    $materiaConteudo= $_POST["materia_conteudo"]; // vai passar o id da area da matéria
    $linkConteudo= $_POST["link_conteudo"]; // vai passar o id da area da matéria
    
    $sql_nome_materia = "SELECT nomeMateria FROM materia WHERE idMateria = $materiaConteudo;"; //busca a área pelo id
    $result_nome_materia = mysqli_query($conn, $sql_nome_materia); 
    $dados = mysqli_fetch_assoc($result_nome_materia); 
    $nomeMateria = $dados['nomeMateria']; // traz o nome da matéria do banco de dados.
    
    $sql_nome_conteudo = "SELECT nomeConteudo, idConteudo FROM conteudo WHERE nomeConteudo = '$nomeConteudo';";
    $result_nome_conteudo = mysqli_query($conn, $sql_nome_conteudo);
    $linhasAfetadas = mysqli_affected_rows($conn);
    $dado = mysqli_fetch_assoc($result_nome_conteudo);
    $id_conteudo = $dado["idConteudo"];

    if (($linhasAfetadas > 0) && ($idConteudo != $id_conteudo)){
            $_SESSION['mensagem_erro']= "Já existe um conteúdo cadastrado com este mesmo nome.";
            echo "<script language='javascript'>history.back()</script>";
            die();                

    } else { 


            $sql_atualiza_conteudo="UPDATE conteudo SET nomeConteudo='$nomeConteudo', linkConteudo = '$linkConteudo', materiaConteudo='$nomeMateria', idMateria=$materiaConteudo WHERE idConteudo=$idConteudo;";
            $result_conteudo = mysqli_query($conn, $sql_atualiza_conteudo); 
            header('location: pagina_visualizar_conteudos.php');
            die();                

    }
}

?>
