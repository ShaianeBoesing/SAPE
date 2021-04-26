<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Cadastrar Prova</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pagina_cadastro_prova.css">

    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- INICIAR SESSÃO PHP -->
    <?php 
        session_start();
        include 'conexao.php';
    ?>


    <!-- LINK JAVASCRIPT -->
    <script src="js/cadastrar_prova.js"></script>




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
        <form method="post" action="processa_cadastro_prova.php">
            <div class="form-group">
                <h3> Cadastrar Prova</h3>

                <p class="mensagem" style="color:red">
                    <?php if(isset($_SESSION['mensagem_erro'])){ 
                                echo $_SESSION['mensagem_erro'];
                                unset ($_SESSION['mensagem_erro']);
                            }?>
                </p>
                <p class="mensagem" style="color:green">
                    <?php if(isset($_SESSION['mensagem_acerto'])){ 
                                echo $_SESSION['mensagem_acerto'];
                                unset ($_SESSION['mensagem_acerto']);
                            }?>
                </p>

                <label for="input-nome-prova" class="form-label">Nome da Prova</label>
                <input type="text" class="form-control" id="input-nome-prova" name="nome_prova" placeholder="Digite o nome da prova">
                <p id="mensagem-erro-nome"></p>

                <div class="row">
                    <div class="col-sm-6">
                        <label for="input-sigla-prova" class="form-label">Sigla da prova</label> <input type="text" class="form-control" id="input-sigla-prova" name="sigla_prova" placeholder="Digite a sigla da prova">
                        <p id="mensagem-erro-sigla"></p>


                    </div>
                    <div class="col-sm-6">
                        <label for="input-ano-prova" class="form-label">Ano da prova</label>
                        <input type="text" class="form-control" id="input-ano-prova" name="ano_prova" placeholder="Digite o ano da prova">
                        <p id="mensagem-erro-ano"></p>

                    </div>
                </div>
            </div>
            <button type="submit" class="btn cadastrar" id="botao_cadastrar_prova">Cadastrar</button>


        </form>
    </div>
</body>

</html>
