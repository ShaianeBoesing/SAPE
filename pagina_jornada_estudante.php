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
    <nav class="navbar" style="background-color: var(--header-color-background);">
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
                <li class="nav-iten-active">
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

        <?php 
    $sqlJornada =  "SELECT emailEstudante FROM jornada WHERE emailEstudante = $email_usuario;";
    mysqli_query($conn, $sqlJornada);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas < 1 ){
                    echo "<div class='div-texto'>";
                    echo "<p class='texto' >Olá, " . $nome_usuario . ". Tudo bem com você? Preparei uma explicação sobre como será a sua Jornada SAPE: </p>";
                    echo "<p  class='texto'>Você poderá escolher quantas vezes na semana pretende acessar o SAPE para estudar, adaptando os estudos à sua rotina. Em cada um desses acessos, um novo roteiro de questões estará disponível para que você pratique. Você também poderá escolher quantas questões quer em cada roteiro. Dessa maneira, nosso sistema calculará quanto tempo durará a sua jornada. Ao final dessa jornada, você terá respondido  <b> mais de 250 questões </b> e estará pronto para arrasar no ENEM!</p>";
                    echo "</div>";

    ?>

        <a href="pagina_cadastro_jornada.php"> <input type="button" class="botao-jornada" id="botao-criar-jornada" value="Crie sua Jornada"></a>

        <?php
    } else  {
        $sqlResgataIdJornada = "SELECT idJornada FROM jornada WHERE emailEstudante = $email_usuario";
        $resultSelect = mysqli_query($conn, $sqlResgataIdJornada);
        $dado = mysqli_fetch_assoc($resultSelect);
        $idJornada = $dado["idJornada"];
        $_SESSION['idJornada']= $idJornada;
                  

    ?>
        

        <h1 class="titulo-principal"> Minha Jornada SAPE</h1>


        <?php
        
                    //SELECT para buscar dados da jornada no banco de dados
                    $sql = "SELECT dataAtual, areaJornada, diasSemana, questoesRoteiro FROM jornada WHERE emailEstudante = $email_usuario";
                    $result=mysqli_query($conn, $sql);
                    
                    $dado = mysqli_fetch_assoc($result);

                    // Atribuindo dados requeridos para variáveis
                    $dataAtual =$dado["dataAtual"];
                    $areaJornada=$dado["areaJornada"];
                    $diasSemana=$dado["diasSemana"];
                    $questoesRoteiro =$dado["questoesRoteiro"];
                        
                    // MANIPULANDO DATAS
                    /* Calculando quantas semanas, em média, são necessárias para concluir a jornada, com base 
                    em quantas questões o usuário quer responder por roteiro, e quantas vezes na semana ele acessará
                    o sistema para praticar e estudar.*/
                    $semanas = ceil(250 / ($diasSemana*$questoesRoteiro));
                    
        
                    
        
                    /* Transformando semanas em dias e adicionando esse valor numa string que contém um número e a palavra 'day' para atribuir a uma função (strtotime) String para Tempo*/
                    $semanasEmDias = '' . ($semanas*7) .' days';
        
                    /* Formatando a data para o formato dd/mm/YYYY */
                    $dataEscolhida = implode('/', array_reverse(explode('-', $dataAtual)));
                    $dataAtual = implode('/', array_reverse(explode('.', $dataAtual)));
                    
                    /* Somando a data atual a quantidade estimada de dias para ter um resultado próximo de 
                    quando será finalizada a Jornada do estudante em questão */
                    $tempoEstimado = date('d/m/Y', strtotime($dataAtual . $semanasEmDias));
        
                    // MANIPULANDO AS ÁREAS 
                    /* Buscando o nome das áreas que se referem aos ids armazenados no array areaJornada */
                    $sqlBuscaNomeArea = "SELECT nomeArea FROM area WHERE idArea IN ($areaJornada)";
                    $resultBuscaNomeArea=mysqli_query($conn, $sqlBuscaNomeArea);
        
                    $areas = ""; // variavel string vazia que receberá conteudo em seguida
        
                    /* Atribuindo valores do array com o nome das áreas a uma String ($areas) para que esta seja impressa */ 
                    while($dados = mysqli_fetch_row($resultBuscaNomeArea)){
                        $areas .= ("<br />");
                        $areas .= ($dados[0]);        
                    }



                    // IMPRIMINDO INFORMAÇÕES NA TELA    
        
                    echo "<h4 id='areas' class='titulo'> Área(s) selecionada(s) <h5 class='conteudo'>" . $areas . "</h5> </h4>";
                    echo "<h4 class='titulo'> Quantas vezes irei estudar e praticar na semana <h5 class='conteudo'>". $diasSemana . "</h5> </h4>";
                    echo "<h4 class='titulo'> Quantas questões quero em cada roteiro <h5 class='conteudo'>". $questoesRoteiro . "</h5> </h4>";
                    echo "<h4 class='titulo'> Criei minha jornada em <h4 class='conteudo'>". $dataEscolhida . "</h5></h4>";
                    echo "<h4 class='titulo'> Terminarei minha jornada por volta de <h5 class='conteudo'>".  $tempoEstimado  . "<h5 class='conteudo'></h4>";

                    mysqli_close($conn);
                    ?>
        <?php
        }
    ?>


    </div>


</body>

</html>
