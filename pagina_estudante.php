<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Jornada</title>
    <link rel="icon" href="images/sape-logo-icon.png" class="img-responsive pull-right" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar_estudante.css">
    <link rel="stylesheet" href="css/pagina_jornada_estudante.css">
    <link rel="stylesheet" href="css/sidebar.css">


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
    
    
    $genero = '';
    $email_usuario = $_SESSION['usuario_logado'];

        
    if ( empty($_SESSION['usuario_logado']) ) {
        $nome_usuario = "Logar"; // traz o nome da área do banco de dados.
        echo "<script>alert('Você precisa estar logado');";
        echo "javascript:window.location='index.php';</script>";


    } else {
    
    $email_usuario = $_SESSION['usuario_logado'];
    $sql =  "SELECT nomeUsuario, tipoUsuario FROM usuario WHERE emailUsuario = $email_usuario;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $nome_usuario = $dados['nomeUsuario']; // traz o nome do usuário do banco de dados.
    $tipo_usuario = $dados['tipoUsuario']; // traz o tipo de usuário do banco de dados.

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

    <!--   NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: var(--header-color-background);">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample01">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="processa_saida.php">Sair</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ajuda_estudante.php" target="_blank">Ajuda (?)</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- SIDE BAR -->
    <aside class="sidebar">
        <nav>
            <ul class="sidebar__nav">
                <li>
                    <a href="pagina_inicial_estudante.php" class="sidebar__nav__link">
                        <img src="images/roteiro-icon.png" class="icon img-fluid">
                        <span class="sidebar__nav__text">Roteiros</span>
                    </a>
                </li>
                <li>
                    <a href="pagina_jornada_estudante.php" class="sidebar__nav__link">
                        <img src="images/jornada-icon3.png" class="icon img-fluid">
                        <span class="sidebar__nav__text">Jornada</span>
                    </a>
                </li>

                <li class="nav-iten-active">
                    <a href="pagina_estudante.php" class="sidebar__nav__link">
                        <img src="images/usuario_icon.png" class="icon img-fluid">
                        <span class="sidebar__nav__text"><?php echo $nome_usuario ?> </span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- CORPO -->

    <div class="container">
        <div class="content">

            <h1 class="titulo-principal"> Meu Perfil</h1>




            <?php
        
                    //SELECT para buscar dados da jornada no banco de dados
                    $sql = "SELECT * FROM usuario WHERE emailUsuario = $email_usuario";
                    $result=mysqli_query($conn, $sql);
                    
                    $dado = mysqli_fetch_assoc($result);

                    // Atribuindo dados requeridos para variáveis
                    $idUsuario =$dado["idUsuario"];
                    $nomeUsuario =$dado["nomeUsuario"];
                    $dataNascimentoUsuario =$dado["dataNascimentoUsuario"];
                    $emailUsuario =$dado["emailUsuario"];
                    $senhaUsuario =$dado["senhaUsuario"];
                    $generoUsuario =$dado["generoUsuario"];
                        
                    // MANIPULANDO DATAS
                    $dataNascimentoUsuario = implode('/', array_reverse(explode('-', $dataNascimentoUsuario)));

                    // IMPRIMINDO INFORMAÇÕES NA TELA    
        
                    if ($generoUsuario=="M"){
                        $genero= 'Masculino';
                    } else if ($generoUsuario=="F") {
                        $genero= 'Feminino';
                    } else {
                        $genero= 'Não binário';
                    }    

                    echo "<h4 id='areas' class='titulo'> Nome <h5 class='conteudo'>" . $nomeUsuario . "</h5> </h4>";
                    echo "<h4 class='titulo'> Data nascimento <h5 class='conteudo'>". $dataNascimentoUsuario . "</h5> </h4>";
                    echo "<h4 class='titulo'> Gênero <h5 class='conteudo'>". $genero . "</h5> </h4>";
                    echo "<h4 class='titulo'> Email <h4 class='conteudo'>". $emailUsuario . "</h5></h4>";
                            
                                    

                 
                            
                    
                    
                    mysqli_close($conn);
                    ?>

            <a href='pagina_edita_estudante?emailUsuario=<?php echo $emailUsuario; ?>' class='btn btn-outline-info' id='botao_editar_estudante' title='Editar' value='editar' name='emailUsuario'>Editar</a>
        </div>
    </div>


</body>

</html>
