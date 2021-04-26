<?php 
                                
    session_start();
    include 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Visualizar Questões</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pagina_visualizar.css">
    <link rel="stylesheet" href="css/pagina_visualizar_questoes.css">

    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <!-- LINK JAVASCRIPT -->
    <!--    <script src="js/cadastrar_area.js"></script>-->

</head>

<body>
    <?php
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

        if ($tipo_usuario != "G"){
        echo "<script>alert('Você precisa estar logado');";
        echo "javascript:window.location='index.php';</script>";


        }

    }
    
    //VARIAVEIS
    $areaUsada = '';
    $a = '';


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
            </ul>
        </div>
    </nav>


    <!-- CORPO -->

    <div class="container-fluid">



        <!-- BOTÃO DE PESQUISAR E VOLTAR -->
        <div class="tabela_visualizar">
            <form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar">
                <input type="text" class="btn btn-outline-info" name="palavra" />
                <button type="submit" class="btn btn-info botao-pesquisar" value="Buscar"><img src="./images/search-white.png" class="btn-info" style="width:90%"></button>
            </form>
            <form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=voltar">
                <button type="submit" class="btn btn-info botao-voltar" value="Buscar">Voltar</button>
            </form>
        </div>


        <div class="tabela_visualizar">

            <form method="POST" action="pagina_visualizar_questoes.php">
                <!-- BOTOES EXCLUIR CADASTROS DE ÁREA -->
                <input type="hidden" value="f_del" name="f_del" placeholder="Excluir">
                <input type="submit" value="Excluir Cadastros Selecionados" class="btn excluir" style="background-color:#db6262; color:white;">
                <br />
                <br />


                <?php 
                    
                    //EXCLUIR CADASTROS SELECIONADOS    
                    if((isset($_POST['f_del'])) && (isset($_POST['selecionar'] ))) {

                        
                        foreach($_POST['selecionar'] as $cod){

                            
                            $sql="delete FROM questao WHERE idQuestao=$cod;";
                            $resultado = mysqli_query($conn, $sql);


                            echo "<p class='msg_sucesso'> Cadastro " . $cod . " excluído com sucesso </p>";
                        } 

                    } else if ((isset($_POST['f_del'])) && (empty($_POST['selecionar'] ))){
                         echo "Selecione o(s) cadastro(s) que deseja excluir";
                    }

                    
                    
                    // CRIAR TABELA DE VISUALIZAÇÃO
                    
    
                        $sqlArea = "SELECT areaQuestao FROM questao ORDER BY areaQuestao ASC";
                        $resArea=mysqli_query($conn, $sqlArea);


                        
                    
                    if (mysqli_affected_rows($conn)> 0) {

                    /*COMEÇANDO A ESTRUTURAR A TABELA*/
                    
                        while($dadoArea = mysqli_fetch_assoc($resArea)){

                        $nomeArea = $dadoArea["areaQuestao"];

                        if ($areaUsada != $nomeArea){

                        echo "<table class='table'>
                            <thead>
                                <tr>
                                    <th scope='col' style='width:100px'>#</th>
                                    <th scope='col' style='width:700px'>Enunciado</th>
                                    <th scope='col'>Editar</th>
                                    <th scope='col'>Excluir</th>
                                </tr>

                            </thead>
                            <tbody>";  


                        echo "<tr>" 
                                    .$nomeArea.
                            "</tr>";




                                                //BUSCAR CADASTROS
                        if (isset($_GET['a'])) {
                            $a = $_GET['a'];

                            //Se o botão clicado foi de buscar, ele faz uma busca baseada no texto que é digitado
                            if ($a == "buscar") {

                                $palavra = trim($_POST['palavra']);
                                $sqlBusca = "SELECT idQuestao, enunciadoQuestao FROM questao WHERE (enunciadoQuestao LIKE '".$palavra."%' OR idQuestao LIKE '".$palavra."%' OR areaQuestao LIKE '".$palavra."%' OR materiaQuestao LIKE '".$palavra."%' OR conteudoQuestao LIKE '".$palavra."%' OR topicoQuestao LIKE '".$palavra."%' OR provaQuestao LIKE '%".$palavra."%') AND (areaQuestao = '$nomeArea') ORDER BY enunciadoQuestao ASC";

                            // OR idQuestao LIKE '%".$palavra."%' OR areaQuestao LIKE '%".$palavra."%' OR materiaQuestao LIKE '%".$palavra."%' OR conteudoQuestao LIKE '%".$palavra."%' OR topicoQuestao LIKE '%".$palavra."%' 

                            //Se o botão clicado foi de votlar, ele retorna para a pagina de visualizar padrão
                            } else if ($a == "voltar"){
                                header('location:pagina_visualizar_questoes.php');
                            }

                        // Se o botão de pesquisar não foi clicado, ele faz a busca comum e traz todos os dados    
                        }else{

                            $sqlBusca = "SELECT idQuestao, enunciadoQuestao FROM questao WHERE areaQuestao = '$nomeArea' ORDER BY enunciadoQuestao ASC";
                        }

                            $res=mysqli_query($conn, $sqlBusca);
                            if( mysqli_affected_rows($conn) > 0){


                            while($dado = mysqli_fetch_assoc($res)){ 

                                //CRIANDO AS VARIAVEIS QUE ARMAZENANDO OS DADOS VINDOS DO BANCO
                                $codigo = $dado["idQuestao"];
                                $enunciado=$dado["enunciadoQuestao"];



                                echo "<tr>";
                                echo "<td>" . $codigo . "</td>";
                                echo "<td>" . $enunciado . "</td>";


                                echo "<td>
                                    <a href='pagina_edita_questao?idQuestao=$codigo' id='btn-editar' class='btn btn-info btn-sm' title='Editar' value='editar' name='codigo'>Editar</a>
                                </td>";
                                echo "<td>
                                    <a id='btn-excluir' class='btn btn-secondary btn-sm' title='Excluir'>
                                        <input type='checkbox' value= $codigo name='selecionar[]'>
                                        Excluir
                                    </a>
                                </td>";

                            echo "</tr>";

                            }
                            } else {
                                echo "  - <a style='color:red'>  Nenhum dado foi encontrado </a> ";

                            }
                                
                            echo "</tbody>";
                        echo "</table>";
                        }

                            $areaUsada = $nomeArea;

                        }

                } 
                    
                    mysqli_close($conn);

                    ?>


            </form>
        </div>
    </div>

</body>

</html>
