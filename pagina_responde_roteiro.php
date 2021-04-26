<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Responder Roteiro </title>
    <link rel="icon" href="images/sape-logo-icon.png" class="img-responsive pull-right" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar_estudante.css">
    <link rel="stylesheet" href="css/pagina_responde_roteiro.css">
    <link rel="stylesheet" href="css/sidebar.css">


    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- JAVASCRIPT -->
    <script src="js/responder_roteiro.js"></script>
    
    <?php
        session_start();
        include_once("conexao.php");    
    ?>



</head>

<body>
    <?php 
    
    
    if ( empty($_SESSION['usuario_logado']) ) {
        $nome_usuario = "Logar"; // traz o nome da área do banco de dados.
        echo "<script>alert('Você precisa estar logado');";
        echo "javascript:window.location='index.php';</script>";


    } else {
    
    $email_usuario = $_SESSION['usuario_logado'];
    $sql =  "SELECT nomeUsuario, tipoUsuario, idUsuario FROM usuario WHERE emailUsuario = $email_usuario;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $nome_usuario = $dados['nomeUsuario']; // traz o nome do usuário do banco de dados.
    $tipo_usuario = $dados['tipoUsuario']; // traz o tipo de usuário do banco de dados.
    $id_usuario = $dados['idUsuario']; // traz o id de usuário do banco de dados.

        if ($tipo_usuario != "E"){
        echo "<script>alert('Você precisa estar logado');";
        echo "javascript:window.location='index.php';</script>";


        }

    }
    

    ?>


    <!--    CABEÇALHO DO SITE -->
    <div class="div_cabecalho">
        <div class="div_logotipo">
            <a href="pagina_inicial_estudante.php" id="link_logotipo">
                <img src="images/sape-logo.png" id="logotipo">
            </a>
        </div>
    </div>


    <div class="container">
        <?php 
        $idRoteiro = $_GET["idRoteiro"];
        $sqlBuscaRoteiro = "SELECT idQuestao, idArea FROM roteiro WHERE idRoteiro=$idRoteiro AND idUsuario = $id_usuario";
        $resultadoBuscaRoteiro = mysqli_query($conn, $sqlBuscaRoteiro);
        $quantidadeQuestoes = mysqli_affected_rows($conn);
        
        //VARIAVEIS
        $numeroQuestao = 0;
        ?>

        <form method='POST' action='responde_roteiro.php'>

            <input type="hidden" id='idRoteiro' name='idRoteiro' value='<?php echo $idRoteiro?>'>
            <input type='hidden' id='quantidadeQuestoes' name='quantidadeQuestoes' value='<?php echo $quantidadeQuestoes ?>'>


            <?php

        while ($dadosBuscaRoteiro = mysqli_fetch_assoc($resultadoBuscaRoteiro)){
            $idQuestao = $dadosBuscaRoteiro["idQuestao"];
            $idArea = $dadosBuscaRoteiro["idArea"];
//            echo $idQuestao . "<br>";
//            echo $idArea . "<br>"   ;
            
            $sqlBuscaQuestao = "SELECT * FROM questao WHERE idQuestao = $idQuestao AND idArea = $idArea";
//            echo $sqlBuscaQuestao . "<br>";
            $resultBuscaQuestao = mysqli_query($conn, $sqlBuscaQuestao);
            while ($dadosBuscaQuestao = mysqli_fetch_assoc($resultBuscaQuestao)){
                $nomeProva = $dadosBuscaQuestao["provaQuestao"];
                $enunciadoQuestao = $dadosBuscaQuestao["enunciadoQuestao"];
                $alternativaA = $dadosBuscaQuestao["alternativaA"];
                $alternativaB = $dadosBuscaQuestao["alternativaB"];
                $alternativaC = $dadosBuscaQuestao["alternativaC"];
                $alternativaD = $dadosBuscaQuestao["alternativaD"];
                $alternativaE = $dadosBuscaQuestao["alternativaE"];
                $alternativaCorreta = $dadosBuscaQuestao["alternativaCorreta"];
                $resolucaoQuestao = $dadosBuscaQuestao["resolucaoQuestao"];
                
                $numeroQuestao++;
                
                ?>
                
                <input type="hidden" id="idQuestao<?php echo $numeroQuestao ?>" name="idQuestao<?php echo $numeroQuestao ?>" value='<?php echo $idQuestao?>'> 
                
                <?php
                echo "
                <div class='form-group' id='selecionarAlternativa$numeroQuestao'>
                <table> 
                <tr><td class='espaço'> <br /> <br /><td></tr>
                        <tr> 
                            <td> 
                                QUESTÃO $numeroQuestao - ($nomeProva) $enunciadoQuestao 
                            <td/> 
                        </tr>
                        <tr> 
                            <td> 
                                <input class='form-check-input' type='radio'  name='alternativaSelecionada$numeroQuestao' id='alternativaSelecionadaA$numeroQuestao' value='A' required>
                               a) $alternativaA              
                            <td/> 
                        </tr>
                        <tr> 
                            <td> 
                                <input class='form-check-input' type='radio' 
                              name='alternativaSelecionada$numeroQuestao' id='alternativaSelecionadaB$numeroQuestao' value='B'>
                               b) $alternativaB           
                            <td/> 
                        </tr>
                        <tr> 
                            <td> 
                                <input class='form-check-input' type='radio' 
                                name='alternativaSelecionada$numeroQuestao' id='alternativaSelecionadaC$numeroQuestao' value='C'>
                               c) $alternativaC            
                            <td/> 
                        </tr>
                        <tr> 
                            <td> 
                                <input class='form-check-input' type='radio' 
                                name='alternativaSelecionada$numeroQuestao' id='alternativaSelecionadaD$numeroQuestao' value='D'>
                               d) $alternativaD           
                            <td/> 
                        </tr>
                        <tr> 
                            <td> 
                              <input class='form-check-input' type='radio' 
                              name='alternativaSelecionada$numeroQuestao' id='alternativaSelecionadaE$numeroQuestao' value='E'>
                               e) $alternativaE            
                            <td/> 
                        </tr>

                    </table> 
                    </div>
                    <input type='hidden' id='alternativaCorreta$numeroQuestao' name='alternativaCorreta$numeroQuestao' value='$alternativaCorreta'>
                    
                    ";
            }
            
        }
            ?>
            <br /> <br />
            <p id="mensagem-erro"> </p>
            <input type='submit' class="btn btn-info" id='enviarRespostas' value='Conferir'>

            <br /> <br />


        </form>
    </div>



</body>
