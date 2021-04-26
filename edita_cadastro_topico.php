<?php 

session_start();
include_once("conexao.php");    
    
if (isset($_POST['salvar'])){

    
    $idTopico= $_POST["id_topico"];
    $nomeTopico= $_POST["nome_topico"];
    $conteudoTopico= $_POST["conteudo_topico"]; // vai passar o id da area da matéria
    $linkTopico= $_POST["link_topico"]; // vai passar o id da area da matéria
    
    $sql_nome_conteudo = "SELECT nomeConteudo FROM conteudo WHERE idConteudo = $conteudoTopico;"; //busca a área pelo id
    $result_nome_conteudo = mysqli_query($conn, $sql_nome_conteudo); 
    $dados = mysqli_fetch_assoc($result_nome_conteudo); 
    $nomeConteudo = $dados['nomeConteudo']; // traz o nome do conteúdo do banco de dados.
    
    $sql_nome_topico = "SELECT nomeTopico, idTopico FROM topico WHERE nomeTopico = '$nomeTopico';";
    $result_nome_topico = mysqli_query($conn, $sql_nome_topico);
    $linhasAfetadas = mysqli_affected_rows($conn);
    $dado  = mysqli_fetch_assoc($result_nome_topico);
    $id_topico = $dado["idTopico"];

    if (($linhasAfetadas > 0) && ($idTopico != $id_topico) ){
        
            $_SESSION['mensagem_erro']= "Já existe um tópico cadastrado com este mesmo nome.";
            echo "<script language='javascript'>history.back()</script>";
            die();                
        

    } else { 


            $sql_atualiza_topico="UPDATE topico SET nomeTopico='$nomeTopico', linkTopico = '$linkTopico', conteudoTopico='$nomeConteudo', idConteudo=$conteudoTopico WHERE idTopico=$idTopico;";
            $result_topico = mysqli_query($conn, $sql_atualiza_topico);
            header('location: pagina_visualizar_topicos.php');
            die();                

            
    }
}

?>
