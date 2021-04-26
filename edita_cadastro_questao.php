<?php 

session_start();
include_once("conexao.php");    
    
if (isset($_POST['salvar'])){

    
//SELECTS
    
    $idQuestao = $_POST["id_questao"]; 
    $idProva = $_POST["prova_questao"]; 
    $idArea = $_POST["area_questao"]; 
    $idMateria = $_POST["materia_questao"]; 
    $idConteudo = $_POST["conteudo_questao"]; 
    $idTopico = $_POST["topico_questao"];
    
//ENUNCIADO
    
    $enunciado_questao = $_POST["enunciado_questao"];
    
//ALTERNATIVA A
    
    $alternativaA = $_POST["alternativaA"];
    
//ALTERNATIVA B
    
    $alternativaB = $_POST["alternativaB"];

//ALTERNATIVA C
    
    $alternativaC = $_POST["alternativaC"];

//ALTERNATIVA D
    
    $alternativaD = $_POST["alternativaD"];

//ALTERNATIVA E
    
    $alternativaE = $_POST["alternativaE"];
    
//ALTERNATIVA CORRETA

    $alternativaCorreta = $_POST["alternativa-correta"];

//RESOLUCAO
    
    $resolucao_questao = $_POST["resolucao_questao"];

// BUSCANDO NOME DOS ITENS SELECTS PELO ID 

    $sql_nome_prova = "SELECT nomeProva FROM prova WHERE idProva = $idProva;"; 
    $sql_nome_area = "SELECT nomeArea FROM area WHERE idArea = $idArea;"; 
    $sql_nome_materia = "SELECT nomeMateria FROM materia WHERE idMateria = $idMateria;"; 
    $sql_nome_conteudo = "SELECT nomeConteudo FROM conteudo WHERE idConteudo = $idConteudo;"; 
    $sql_nome_topico = "SELECT nomeTopico FROM topico WHERE idTopico = $idTopico;"; 


    $resultNomeProva = mysqli_query($conn, $sql_nome_prova);
    $resultNomeArea = mysqli_query($conn, $sql_nome_area);
    $resultNomeMateria = mysqli_query($conn, $sql_nome_materia);
    $resultNomeConteudo = mysqli_query($conn, $sql_nome_conteudo);
    $resultNomeTopico = mysqli_query($conn, $sql_nome_topico);

    $dadosProva = mysqli_fetch_assoc($resultNomeProva);
    $dadosArea = mysqli_fetch_assoc($resultNomeArea);
    $dadosMateria = mysqli_fetch_assoc($resultNomeMateria);
    $dadosConteudo = mysqli_fetch_assoc($resultNomeConteudo);
    $dadosTopico = mysqli_fetch_assoc($resultNomeTopico);

    $nomeProva = $dadosProva['nomeProva']; 
    $nomeArea = $dadosArea['nomeArea']; 
    $nomeMateria = $dadosMateria['nomeMateria']; 
    $nomeConteudo = $dadosConteudo['nomeConteudo']; 
    $nomeTopico = $dadosTopico['nomeTopico']; 

    
// VERIFICAR SE A QUESTÃO NÃO ESTA SENDO DUPLICADA
    
    $sql_verifica_materia = "SELECT enunciadoQuestao, idQuestao FROM questao WHERE enunciadoQuestao = '$enunciado_questao';";
    $result_enunciado = mysqli_query($conn, $sql_verifica_materia);
    $linhasAfetadas = mysqli_affected_rows($conn);
    $dado = mysqli_fetch_assoc($result_enunciado);
    $id_questao = $dado["idQuestao"];

    if (($linhasAfetadas > 0)&&( $idQuestao != $id_questao)){

            $_SESSION['mensagem_erro']= "Já existe uma questão cadastrada com este mesmo enunciado.";
            echo "<script language='javascript'>history.back()</script>";
            die();                

    } else {


    // ATUALIZANDO

        $sqlAtualizaQuestao = "UPDATE questao SET  
        provaQuestao = '$nomeProva',
        areaQuestao = '$nomeArea',
        materiaQuestao = '$nomeMateria',
        conteudoQuestao = '$nomeConteudo',
        topicoQuestao = '$nomeTopico',
        enunciadoQuestao = '$enunciado_questao',
        alternativaA = '$alternativaA',
        alternativaB = '$alternativaB',
        alternativaC = '$alternativaC',
        alternativaD = '$alternativaD',
        alternativaE = '$alternativaE',
        alternativaCorreta = '$alternativaCorreta',
        resolucaoQuestao = '$resolucao_questao',
        idProva = $idProva,
        idArea = $idArea,
        idMateria = $idMateria,
        idConteudo = $idConteudo,
        idTopico = $idTopico WHERE idQuestao = $idQuestao;";

        $result_questao = mysqli_query($conn, $sqlAtualizaQuestao);

        header('location: pagina_visualizar_questoes.php');
        die();                


    }
}



    mysqli_close($conn);
?>
