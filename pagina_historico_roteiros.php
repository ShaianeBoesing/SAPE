<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Histórico </title>
    <link rel="icon" href="images/sape-logo-icon.png" class="img-responsive pull-right" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar_estudante.css">
    <link rel="stylesheet" href="css/pagina_inicial_estudante.css">
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


    <!--   NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: var(--header-color-background);">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample01">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="pagina_inicial_estudante.php">Roteiros<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="pagina_historico_roteiros.php">Histórico</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pagina_visualiza_desempenho.php">Desempenho</a>
                </li>


            </ul>
        </div>
    </nav>

    <!-- SIDE BAR -->
    <aside class="sidebar">
        <nav>
            <ul class="sidebar__nav">
                <li class="nav-iten-active">
                    <a href="#" class="sidebar__nav__link">
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

                <li>
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

        <div class="container-roteiro">
            <div class="row">

                <?php 
    
    
                $sqlBuscaRoteirosRespondidos = "SELECT 1 FROM roteiro WHERE roteiroRespondido=TRUE AND idUsuario=$id_usuario";
                $resultBuscaRoteirosRespondidos = mysqli_query($conn, $sqlBuscaRoteirosRespondidos);
                $affectedRows = mysqli_affected_rows($conn);

                
                if ($affectedRows > 0){
                    //VARIVEIS
                    $idUsado = 0;

                    $sqlBuscaJornada = "SELECT idJornada FROM jornada WHERE idUsuario=$id_usuario";
                    $resultBuscaJornada = mysqli_query($conn, $sqlBuscaJornada);


                    $dadosBuscaJornada = mysqli_fetch_row($resultBuscaJornada);
                    $idJornada = $dadosBuscaJornada[0];

                    $sqlBuscaSemana= "SELECT idRoteiro, idQuestao, semana, roteiroRespondido FROM roteiro WHERE idJornada=$idJornada ORDER BY idRoteiro DESC";
                    $resultBuscaSemana = mysqli_query($conn, $sqlBuscaSemana);



                    while($dadosBuscaSemana = mysqli_fetch_assoc($resultBuscaSemana)){

                        $semana = $dadosBuscaSemana["semana"];
                        $idRoteiro = $dadosBuscaSemana["idRoteiro"];
                        $idQuestao = $dadosBuscaSemana["idQuestao"];
                        $roteiroRespondido = $dadosBuscaSemana["roteiroRespondido"];


                            if($idRoteiro != $idUsado && $roteiroRespondido == TRUE){
                                
                                echo "<div class='col-sm-4'>
                                    <div class='tituloRoteiro'>

                                        <label> SEMANA  $semana </label>

                                    </div>


                                    <div class='corpoRoteiro'>
                                        <a href='pagina_visualizar_roteiro?idRoteiro=$idRoteiro'id='btn-visualizar_roteiro' title='visualizarRoteiro' value='visualizarRoteiro' name='visualizarRoteiro'> 
                                        <button class='btn btn-info'> VER </button>
                                        </a>
                                    </div>

                                </div>";

                            }


                        $idUsado = $idRoteiro;

                    }
                } else {
                     echo "<div class='vazio'>
                        <label> Você ainda não respondeu nenhum roteiro. </label>
                    </div>";

                }

            ?>



            </div>
        </div>


    </div>


</body>

</html>
