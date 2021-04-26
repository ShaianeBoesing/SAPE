<?php
    
    session_start();
    include_once("conexao.php");    

//VARIAVEL
$nomeTopico = null; 

//SELECTS
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

    $sql_nome_prova = "SELECT siglaProva, anoAplicacao FROM prova WHERE idProva = $idProva;"; 
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

    $siglaProva = $dadosProva['siglaProva']; 
    $anoProva = $dadosProva['anoAplicacao']; 
    $prova = $siglaProva.' ('.$anoProva.')';
    $nomeArea = $dadosArea['nomeArea']; 
    $nomeMateria = $dadosMateria['nomeMateria']; 
    $nomeConteudo = $dadosConteudo['nomeConteudo']; 


    /* VERIFICANDO SE A QUESTÃO JÁ ESTÁ CADASTRADA */
    $sqlVerificaQuestao= "SELECT enunciadoQuestao FROM questao WHERE enunciadoQuestao = '$enunciado_questao';";
    mysqli_query($conn, $sqlVerificaQuestao);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas > 0){

        $_SESSION['mensagem_erro']= "Essa questão já foi cadastrada.";
        echo "<script language='javascript'>history.back()</script>";
        
        die();                
    } else {

    // INSERINDO


        $sqlInsert = "INSERT INTO questao ( 
        provaQuestao,
        areaQuestao,
        materiaQuestao,
        conteudoQuestao,
        topicoQuestao,
        enunciadoQuestao,
        alternativaA,
        alternativaB,
        alternativaC,
        alternativaD,
        alternativaE,
        alternativaCorreta,
        resolucaoQuestao,
        idProva,
        idArea,
        idMateria,
        idConteudo,
        idTopico
        )
        VALUES (
        '$prova',
        '$nomeArea',
        '$nomeMateria',
        '$nomeConteudo',
        '$nomeTopico',
        '$enunciado_questao',
        '$alternativaA',
        '$alternativaB',
        '$alternativaC',
        '$alternativaD',
        '$alternativaE',
        '$alternativaCorreta',
        '$resolucao_questao',
         $idProva,
         $idArea,
         $idMateria,
         $idConteudo,
         $idTopico
        );";


        $result_conteudo = mysqli_query($conn, $sqlInsert);

            if (mysqli_error($conn)) {

                $_SESSION['mensagem_erro']= "Ocorreu um erro ao cadastrar esta questão.";
                echo "<script language='javascript'>history.back()</script>";
                die();                

            } else {

                $_SESSION['mensagem_acerto']= "Cadastrado com sucesso.";
                header('location: pagina_cadastro_questao.php');

            } 
    }


    mysqli_close($conn);



?>
