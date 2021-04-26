<?php 

session_start();
include_once("conexao.php");    
    


if (isset($_POST['salvar'])){
    $idProva= $_POST["id_prova"];
    $nomeProva= $_POST["nome_prova"];
    $siglaProva= $_POST["sigla_prova"];
    $anoProva= $_POST["ano_prova"];
    
    
    $sql_nome_prova = "SELECT nomeProva, anoAplicacao, idProva FROM prova WHERE nomeProva = '$nomeProva' AND anoAplicacao='$anoProva';";
    $result_nome_prova = mysqli_query($conn, $sql_nome_prova);
    $linhasAfetadas = mysqli_affected_rows($conn);
    $dado = mysqli_fetch_assoc($result_nome_prova);
    $id_prova = $dado["idProva"];

    if (($linhasAfetadas > 0) && ($idProva != $id_prova)){
            
        $_SESSION['mensagem_erro']= "Já existe uma prova cadastrada com este nome e ano.";
        echo "<script language='javascript'>history.back()</script>";
        die();                

    } else { 


    $sql="UPDATE prova SET nomeProva='$nomeProva', siglaProva='$siglaProva', anoAplicacao=$anoProva WHERE idProva=$idProva ";
    $result = mysqli_query($conn,$sql);
    header('location: pagina_visualizar_provas.php');
    die();                

}
}
?>
