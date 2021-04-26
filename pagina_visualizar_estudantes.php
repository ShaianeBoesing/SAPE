<?php 
                                
    session_start();
    include 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Visualizar Estudantes</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pagina_visualizar.css">

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
        <br><br>

        <div class="tabela_visualizar">

            <form method="POST" action="pagina_visualizar_estudantes.php">

                <?php 
                                                //BUSCAR CADASTROS
                    if (isset($_GET['a'])) {
                        $a = $_GET['a'];
                        
                        //Se o botão clicado foi de buscar, ele faz uma busca baseada no texto que é digitado
                        if ($a == "buscar") {
                            
                            $palavra = trim($_POST['palavra']);
                            $sqlBusca = "SELECT * FROM usuario WHERE (nomeUsuario LIKE '%".$palavra."%' OR emailUsuario LIKE '".$palavra."%') AND tipoUsuario='E' ORDER BY nomeUsuario ASC";
                        
                        //Se o botão clicado foi de votlar, ele retorna para a pagina de visualizar padrão
                        } else if ($a == "voltar"){
                            header('location:pagina_visualizar_estudantes.php');
                        }
                        
                    // Se o botão de pesquisar não foi clicado, ele faz a busca comum e traz todos os dados    
                    }else{
                        $sqlBusca = "SELECT * from usuario WHERE tipoUsuario='E' ORDER BY nomeUsuario ASC;";
                    }
                
                        $result=mysqli_query($conn, $sqlBusca);

                        if (mysqli_affected_rows($conn)> 0) {
                        
                        
                        /* TABELA VISUALIZAR AREA */ 
                            echo "<table class='table'>
                            <thead>
                                <tr>
                                    <th scope='col'>#</th>
                                    <th scope='col'>Nome</th>
                                    <th scope='col'>Data de Nascimento</th>
                                    <th scope='col'>E-mail</th>
                                    <th scope='col'>Gênero</th>
                                </tr>            
                            </thead>"; 

                            while($dado = mysqli_fetch_row($result)){ 
                                
                                $codigo = $dado[0];
                                $tipo=$dado[1];
                                $nome=$dado[2];
                                $dataNascimento=$dado[3];
                                $email=$dado[4];
                                $genero=$dado[7];
                                
                                // Formatar data
                                $dataNasc=  date('d/m/Y', strtotime($dataNascimento));


                                echo "<tbody>";
                                    echo "<tr>";
                                        echo "<td>" . $codigo . "</td>";
                                        echo "<td>" . $nome . "</td>";   
                                        echo "<td>" . $dataNasc . "</td>";   
                                        echo "<td>" . $email . "</td>";   
                                        echo "<td>" . $genero . "</td>";   
                                    echo "</tr>";
                                echo "</tbody>";
                            }
                            echo "</table>";
                        } else {
                            echo "Nenhum dado foi encontrado ";

                        }
                    

                        
                    
                    mysqli_close($conn);

                    ?>

            </form>
        </div>
    </div>
</body>

</html>
