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
    //VARIAVEIS
    $id_usuario = 0;
    
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
        $sqlBuscaRoteiro = "SELECT * FROM roteiro WHERE idRoteiro=$idRoteiro AND idUsuario = $id_usuario";
        $resultadoBuscaRoteiro = mysqli_query($conn, $sqlBuscaRoteiro);
        $quantidadeQuestoes = mysqli_affected_rows($conn);
        
        //VARIAVEIS
        $numeroQuestao = 0;
                            echo "<br>  <a href='pagina_historico_roteiros.php' > <button type='button' class='btn btn-info'> VOLTAR </button> </a>";


                while ($dadosBuscaRoteiro = mysqli_fetch_assoc($resultadoBuscaRoteiro)){
                    $idQuestao = $dadosBuscaRoteiro["idQuestao"];
                    $idArea = $dadosBuscaRoteiro["idArea"];
                    
                    $sqlBuscaQuestao = "SELECT * FROM questao WHERE idQuestao = $idQuestao AND idArea = $idArea";
                    $resultBuscaQuestao = mysqli_query($conn, $sqlBuscaQuestao);
                    
                    $sqlBuscaAlternativaEscolhida = "SELECT alternativaEscolhida FROM roteiro WHERE idQuestao = $idQuestao AND idArea = $idArea AND idUsuario = $id_usuario";
                    $resultBuscaAlternativaEscolhida = mysqli_query($conn, $sqlBuscaAlternativaEscolhida);
                    $dadoAlternativaEscolhida = mysqli_fetch_assoc($resultBuscaAlternativaEscolhida);
                    $alternativaEscolhida = $dadoAlternativaEscolhida["alternativaEscolhida"];
                    
                    while ($dadosBuscaQuestao = mysqli_fetch_assoc($resultBuscaQuestao)){
                        
                        $idConteudo = $dadosBuscaQuestao["idConteudo"];
                        $idTopico = $dadosBuscaQuestao["idTopico"];
                        $nomeConteudo = $dadosBuscaQuestao["conteudoQuestao"];
                        $nomeTopico = $dadosBuscaQuestao["topicoQuestao"];
                        $nomeProva = $dadosBuscaQuestao["provaQuestao"];
                        $enunciadoQuestao = $dadosBuscaQuestao["enunciadoQuestao"];
                        $alternativaA = $dadosBuscaQuestao["alternativaA"];
                        $alternativaB = $dadosBuscaQuestao["alternativaB"];
                        $alternativaC = $dadosBuscaQuestao["alternativaC"];
                        $alternativaD = $dadosBuscaQuestao["alternativaD"];
                        $alternativaE = $dadosBuscaQuestao["alternativaE"];
                        $alternativaCorreta = $dadosBuscaQuestao["alternativaCorreta"];
                        $resolucaoQuestao = $dadosBuscaQuestao["resolucaoQuestao"];
                        
                        $sqlBuscaLinkConteudo = "SELECT linkConteudo FROM conteudo WHERE idConteudo=$idConteudo";
                        $sqlBuscaLinkTopico = "SELECT linkTopico FROM topico WHERE idTopico=$idTopico";
                        $resulBuscaLinkConteudo = mysqli_query($conn, $sqlBuscaLinkConteudo);
                        $resulBuscaLinkTopico = mysqli_query($conn, $sqlBuscaLinkTopico);
                        $dadosBuscaLinkConteudo = mysqli_fetch_assoc($resulBuscaLinkConteudo);
                        $dadosBuscaLinkTopico = mysqli_fetch_assoc($resulBuscaLinkTopico);
                        $linkConteudo = $dadosBuscaLinkConteudo["linkConteudo"];
                        $linkTopico = $dadosBuscaLinkTopico["linkTopico"];
                        
                        
                        
                        $numeroQuestao++;

                        ?>

        <input type="hidden" id="idQuestao<?php echo $numeroQuestao ?>" name="idQuestao<?php echo $numeroQuestao ?>" value='<?php echo $idQuestao?>'>

        <div class='form-group' id='alternativaSelecionada<?php echo $numeroQuestao?>'>
            <table>

                <div class="row">
                    <div class="col-sm-10"> <br /> <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <b>QUESTÃO <?php echo "$numeroQuestao" ?> </b> <?php echo "- ($nomeProva) $enunciadoQuestao" ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10" <?php if('A' == $alternativaCorreta){ 
                                    echo "style='background-color: rgba(146, 239, 146, 0.63);'";
                               } else if ('A' == $alternativaEscolhida) {
                                    echo "style='background-color: rgba(255, 37, 37, 0.71);'";
                                } else {
                                echo "";
                                }
                            ?>>
                        <input class='form-check-input' type='radio' name='alternativaSelecionada<?php echo $numeroQuestao?>' id='alternativaSelecionadaA<?php echo $numeroQuestao?>' value='A' <?='A' == $alternativaEscolhida?'checked':'disabled'; ?>>
                        a) <?php echo $alternativaA; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10" <?php if('B' == $alternativaCorreta){ 
                                    echo "style='background-color: rgba(146, 239, 146, 0.63);'";
                               } else if ('B' == $alternativaEscolhida) {
                                    echo "style='background-color: rgba(255, 37, 37, 0.71);'";
                                } else {
                                echo "";
                                }
                            ?>>
                        <input class='form-check-input' type='radio' name='alternativaSelecionada<?php echo $numeroQuestao?>' id='alternativaSelecionadaB<?php echo $numeroQuestao?>' value='B' <?='B' == $alternativaEscolhida?'checked':'disabled'; ?>>
                        b) <?php echo $alternativaB; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10" <?php if('C' == $alternativaCorreta){ 
                                    echo "style='background-color: rgba(146, 239, 146, 0.63);'";
                               } else if ('C' == $alternativaEscolhida) {
                                    echo "style='background-color: rgba(255, 37, 37, 0.71);'";
                                } else {
                                echo "";
                                }
                            ?>>
                        <input class='form-check-input' type='radio' name='alternativaSelecionada<?php echo $numeroQuestao?>' id='alternativaSelecionadaC<?php echo $numeroQuestao?>' value='C' <?='C' == $alternativaEscolhida?'checked':'disabled'; ?>>
                        c) <?php echo $alternativaC; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10" <?php if('D' == $alternativaCorreta){ 
                                    echo "style='background-color: rgba(146, 239, 146, 0.63);'";
                               } else if ('D' == $alternativaEscolhida) {
                                    echo "style='background-color: rgba(255, 37, 37, 0.71);'";
                                } else {
                                echo "";
                                }
                            ?>>
                        <input class='form-check-input' type='radio' name='alternativaSelecionada<?php echo $numeroQuestao?>' id='alternativaSelecionadaD<?php echo $numeroQuestao?>' value='D' <?='D' == $alternativaEscolhida?'checked':'disabled'; ?>>
                        d) <?php echo $alternativaD; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10" <?php if('E' == $alternativaCorreta){ 
                                    echo "style='background-color: rgba(146, 239, 146, 0.63);'";
                               } else if ('E' == $alternativaEscolhida) {
                                    echo "style='background-color: rgba(255, 37, 37, 0.71);'";
                                } else {
                                echo "";
                                }
                            ?>>
                        <input class='form-check-input' type='radio' name='alternativaSelecionada<?php echo $numeroQuestao?>' id='alternativaSelecionadaE<?php echo $numeroQuestao?>' value='E' <?='E' == $alternativaEscolhida?'checked':'disabled'; ?>>
                        e) <?php echo $alternativaE; ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <?php echo "
                         <br>        
                         <br>        
                         <b>Resolução:</b> $resolucaoQuestao 
                         <br>
                         <br>                         
                         <b>Conteúdo:</b> $nomeConteudo 
                         <br>
                         <br>
                         <b> Saiba mais sobre este conteúdo em: </b> <a href='$linkConteudo' target='_blank'> $linkConteudo</a> <br> <a href='$linkTopico' target='_blank'> $linkTopico</a>
                         <br>
                         <br>
                        ";?>
                    </div>
                </div>



            </table>
        </div>

        <?php
                    }

                }
            ?>
        <br /> <br />
    </div>



</body>
