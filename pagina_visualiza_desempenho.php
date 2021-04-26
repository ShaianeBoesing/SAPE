<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Desempenho </title>
    <link rel="icon" href="images/sape-logo-icon.png" class="img-responsive pull-right" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar_estudante.css">
    <link rel="stylesheet" href="css/pagina_desempenho_estudante.css">
    <link rel="stylesheet" href="css/sidebar.css">


    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


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
                <li class="nav-item">
                    <a class="nav-link" href="pagina_historico_roteiros.php">Histórico</a>
                </li>
                <li class="nav-item active">
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
        <h3 class="titulo-principal"> Meu Desempenho </h3>

        <?php 
    
            
$emailUsuario = $_SESSION['usuario_logado'];
$idJornada = $_SESSION['idJornada'];

$sqlBuscaAreasJornada = "SELECT areaJornada FROM jornada WHERE idJornada=$idJornada";
$resultBuscaAreasJornada = mysqli_query($conn, $sqlBuscaAreasJornada);
$dadosAreasJornada = mysqli_fetch_assoc($resultBuscaAreasJornada);
$stringAreasJornada = $dadosAreasJornada["areaJornada"];
$arrayAreaJornada = explode(',', $stringAreasJornada);
$quantidadeArea = sizeof($arrayAreaJornada);

$sql = "SELECT * FROM roteiro 
        WHERE idJornada = $idJornada 
        AND roteiroRespondido = TRUE";

    $sqlVerificaRoteiros = "SELECT *
                           FROM roteiro 
                           WHERE idJornada=$idJornada AND roteiroRespondido = TRUE";
    $resultVerificaRoteiros = mysqli_query($conn, $sqlVerificaRoteiros);
    $roteirosTotais = mysqli_affected_rows($conn);
    $roteirosCertos = 0;
    $roteirosErrados = 0;

    if($roteirosTotais > 0) {
        
        $roteirosTotais;
        $roteirosCertos = "SELECT *
                           FROM roteiro 
                           WHERE idJornada=$idJornada 
                           AND roteiroRespondido = TRUE 
                           AND acertoErroRoteiro=TRUE";
        
        $resultVerificaRoteirosCertos = mysqli_query($conn, $roteirosCertos);
        $roteirosCertos = mysqli_affected_rows($conn);
        
        $roteirosErrados = $roteirosTotais - $roteirosCertos;
        


        for ($i=0; $i<$quantidadeArea; $i++){

            //BUSCA O TOTAL DE QUESTÕES DA ÁREA
            $sqlBuscaQuestoesArea = "SELECT * FROM roteiro 
                                     WHERE roteiroRespondido=TRUE 
                                     AND idArea=$arrayAreaJornada[$i] 
                                     AND idJornada = $idJornada";

            $resultBuscaQuestoesArea = mysqli_query($conn, $sqlBuscaQuestoesArea);
            $totalQuestoesArea = mysqli_affected_rows($conn);


            //BUSCA TODAS AS QUESTÕES ERRADAS DA ÁREA
            $sqlBuscaQuestoesErradasArea = "SELECT * FROM roteiro 
                                            WHERE roteiroRespondido=TRUE 
                                            AND acertoErroRoteiro = FALSE 
                                            AND idArea=$arrayAreaJornada[$i] 
                                            AND idJornada = $idJornada";

            $resultBuscaQuestoesErradasArea = mysqli_query($conn, $sqlBuscaQuestoesErradasArea);
            $totalQuestoesErradasArea = mysqli_affected_rows($conn);

            $totalQuestoesCertasArea = $totalQuestoesArea - $totalQuestoesErradasArea;
            
            $certoPorcentagem = round((100/$totalQuestoesArea)*$totalQuestoesCertasArea);
            $erradoPorcentagem = round((100/$totalQuestoesArea)*$totalQuestoesErradasArea);

            $sqlBuscaNomeArea = "SELECT nomeArea 
                                 FROM area 
                                 WHERE idArea=$arrayAreaJornada[$i]";

            $resultBuscaNomeArea = mysqli_query($conn, $sqlBuscaNomeArea);
            $dadosBuscaNomeArea = mysqli_fetch_assoc($resultBuscaNomeArea);
            $nomeArea = $dadosBuscaNomeArea["nomeArea"];
//            echo "area: " . $nomeArea . "<br>";
//            echo "certo: ". $certoPorcentagem . "% <br>";
//            echo "errado: ". $erradoPorcentagem . "% <br>";

            // IF nunca foi inserido esse idJornada

            $sqlBuscaDesempenho = "SELECT 1 
                                   FROM desempenho 
                                   WHERE idJornada=$idJornada 
                                   AND idArea = $arrayAreaJornada[$i]";
            $resultBuscaDesempenho = mysqli_query($conn, $sqlBuscaDesempenho);
            $linhasAfetadasDesempenho = mysqli_affected_rows($conn);

            if ($linhasAfetadasDesempenho == 0){
            $sqlDesempenho = "INSERT INTO desempenho (idArea, totalQuestoes, totalAcertos, totalErros, idJornada) VALUES ($arrayAreaJornada[$i],$totalQuestoesArea, $totalQuestoesCertasArea, $totalQuestoesErradasArea, $idJornada)";
            $resultDesempenho = mysqli_query($conn, $sqlDesempenho);

            } else {
            $sqlDesempenho = "UPDATE desempenho 
                            SET totalQuestoes = $totalQuestoesArea, 
                            totalAcertos = $totalQuestoesCertasArea,
                            totalErros = $totalQuestoesErradasArea 
                            WHERE idJornada = $idJornada 
                            AND idArea = $arrayAreaJornada[$i]";
            $resultDesempenho = mysqli_query($conn, $sqlDesempenho);

            }
            
                    echo "<h4 id='areas' class='titulo'> $nomeArea  </h4>";


                    echo "<h5 id='acertos' class='valor'> ACERTOS:  $certoPorcentagem% </h5>";
            
            
                    echo "<h5 id='erros' class='valor'> ERROS:  $erradoPorcentagem%   </h5>";

        }
        
                    echo "<h4 id='areas' class='titulo'> Desempenho Geral  </h4>";
                    echo "<h5 id='erros' class='valor'> TOTAL:  $roteirosTotais | CERTAS:  $roteirosCertos | ERRADAS:  $roteirosErrados   </h5>";

                    echo "<div id='piechart' style='width: 100%; height: 100%; display:flex;'></div>";


    } else {
    
        echo "<div class='vazio'>
            <label> Você ainda não respondeu nenhum roteiro. </label>
        </div>";

}

    
                    ?>
    </div>
</body>

</html>


<?php 

?>
                    <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Questões', 'Acertos E Erros'],
                            ['Certo:', <?=$roteirosCertos ?>],
                            ['Errado', <?=$roteirosErrados ?>],
                        ]);

                        var options = {
                            title: ' '
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                        

                    </script>
