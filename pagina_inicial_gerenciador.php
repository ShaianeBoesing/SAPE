<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Página Inicial do Gerenciador</title>
    <link rel="icon" href="images/sape-logo-icon.png" class="img-responsive pull-right" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pagina_inicial_gerenciador.css">

    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <?php
        session_start();
        include_once("conexao.php");    
    ?>



</head>

<body>
    <?php 
    
    if ( empty($_SESSION['usuario_logado']) ) {
        echo "<script>alert('Você precisa estar logado');";
        echo "javascript:window.location='index.php';</script>";


    } else {
    
    $email_usuario = $_SESSION['usuario_logado'];
    $sql =  "SELECT nomeUsuario, tipoUsuario FROM usuario WHERE emailUsuario = $email_usuario;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $nome_usuario = $dados['nomeUsuario']; // traz o nome do usuário do banco de dados.
    $tipo_usuario = $dados['tipoUsuario']; // traz o tipo de usuário do banco de dados.

        if ($tipo_usuario != "G"){
        echo "<script>alert('Você precisa estar logado');";
        echo "javascript:window.location='index.php';</script>";


        }
    }
    $_SESSION['mensagem_erro'] = '';
    $_SESSION['mensagem_acerto'] = '';

    ?>


    <!--    CABEÇALHO DO SITE -->
    <div class="div_cabecalho">
        <div class="div_logotipo">
            <a href="pagina_inicial_gerenciador.php" id="link_logotipo">
                <img src="images/sape-logo.png" id="logotipo">
            </a>
        </div>
    </div>


    <!--   NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample01">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="pagina_inicial_gerenciador.php">Página Inicial<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gerar Relatórios</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="gera_relatorio_estudantes.php" target='_blank'>Estudantes</a>
                        <a class="dropdown-item" href="gera_relatorio_questoes.php" target="_blank">Questões</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo $nome_usuario ?> </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" id="sair" href="processa_saida.php"> Sair </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ajuda_gerenciador.php" target="_blank">Ajuda (?)</a>
                </li>


            </ul>
        </div>
    </nav>



    <!-- CORPO -->

    <div class="container-fluid">
        <!-- PROVA -->
        <div class="row">
            <div class="col-sm-12 group-rows" id="col_prova">
                <h4 class="cadastros" id="prova_h4"> Prova </h4>
                <div class="botoes_cadastros">
                    <a href="pagina_cadastro_prova.php">
                        <button>
                            <img src="images/add_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                    <a href="./pagina_visualizar_provas.php">
                        <button>
                            <img src="images/searc_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- ÁREA -->
        <div class="row">
            <div class="col-sm-12 group-rows">
                <h4 class="cadastros" id="area_h4"> Área </h4>
                <div class="botoes_cadastros">
                    <a href="pagina_cadastro_area.php">
                        <button>
                            <img src="images/add_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                    <a href="./pagina_visualizar_areas.php">
                        <button>
                            <img src="images/searc_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- MATÉRIA -->
        <div class="row">
            <div class="col-sm-12 group-rows" id="col_materia">
                <h4 class="cadastros" id="materia_h4"> Matéria </h4>
                <div class="botoes_cadastros">
                    <a href="pagina_cadastro_materia2.php">
                        <button>
                            <img src="images/add_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                    <a href="./pagina_visualizar_materias.php">
                        <button>
                            <img src="images/searc_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- CONTEÚDO  -->
        <div class="row">
            <div class="col-sm-12 group-rows">
                <h4 class="cadastros" id="conteudo_h4"> Conteúdo </h4>
                <div class="botoes_cadastros">
                    <a href="pagina_cadastro_conteudo.php">
                        <button>
                            <img src="images/add_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                    <a href="./pagina_visualizar_conteudos.php">
                        <button>
                            <img src="images/searc_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- TÓPICO -->
        <div class="row">
            <div class="col-sm-12 group-rows">
                <h4 class="cadastros" id="topico_h4"> Tópico </h4>
                <div class="botoes_cadastros">
                    <a href="pagina_cadastro_topico.php">
                        <button>
                            <img src="images/add_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                    <a href="./pagina_visualizar_topicos.php">
                        <button>
                            <img src="images/searc_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!--  QUESTÃO   -->
        <div class="row">
            <div class="col-sm-12 group-rows">
                <h4 class="cadastros" id="questao_h4"> Questão </h4>
                <div class="botoes_cadastros">
                    <a href="pagina_cadastro_questao.php">
                        <button>
                            <img src="images/add_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                    <a href="./pagina_visualizar_questoes.php">
                        <button>
                            <img src="images/searc_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 group-rows">
                <h4 class="cadastros" id="questao_h4"> Estudantes </h4>
                <div class="botoes_cadastros">
                    <a href="./pagina_visualizar_estudantes.php">
                        <button>
                            <img src="images/searc_icon.png" class="img-responsive pull-right">
                        </button>
                    </a>
                </div>
            </div>
        </div>

    </div>


</body>

</html>
