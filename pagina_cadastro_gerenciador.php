<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Cadastrar Gerenciador</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pagina_cadastro_estudante.css">

    <!--    BIBLIOTECAS BOOTSTRAP E JQUERY   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/jquery.mask.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <!--     INICIAR SESSÃO PHP -->
    <?php 
        session_start();
        include 'conexao.php';
    ?>


    <!-- LINK JAVASCRIPT -->
    <script src="js/cadastrar_gerenciador.js"></script>


</head>

<body>

    <!--    CABEÇALHO DO SITE -->
    <div class="div_cabecalho">
        <div class="div_logotipo">
            <a href="index.php" id="link_logotipo">
                <img src="images/sape-logo.png" id="logotipo">
            </a>
        </div>
    </div>


    <!-- CORPO -->

    <div class="container-fluid">
        <form method="POST" action="processa_cadastro_gerenciador.php">
            <div class="form-group">
                <h3 id="cadastrese"> Cadastre-se</h3>

                <p style="color:red">
                    <?php 
                if (isset($_SESSION['mensagem_erro'])){
                    
                    echo $_SESSION['mensagem_erro'];
                    unset ($_SESSION['mensagem_erro']);
                }
                ?>
                </p>

                <div class="row">

                    <!-- NOME DO GERENCIADOR -->
                    <div class="col-sm-12">

                        <label for="input-nome-gerenciador" class="form-label">Nome</label>

                        <input type="text" name="nome_gerenciador" class="form-control" id="input-nome-gerenciador" placeholder="Informe seu nome completo">

                        <p id="mensagem-erro-nome"></p>

                    </div>

                    <!-- CPF DO GERENCIADOR -->
                    <div class="col-sm-12">
                        <label for="input-cpf-gerenciador" class="form-label">CPF</label>

                        <input type="text" name="cpf_gerenciador" class="form-control" id="input-cpf-gerenciador" placeholder="Informe seu CPF">


                        <p id="mensagem-erro-cpf"></p>
                    </div>


                    <!-- DATA DE NASC DO ESTUDANTE -->
                    <div class="col-sm-12">
                        <label for="date-input" class="form-label"> Data de Nascimento </label>
                        <br />
                        <div class="row">
                            <div class="col-12">
                                <input class="form-control" type="date" name="data_nascimento" value="" id="date-input">


                            </div>

                        </div>

                        <p id="mensagem-erro-data"></p>
                    </div>

                    <!-- EMAIL DO GERENCIADOR -->
                    <div class="col-sm-12">

                        <label for="input-email-gerenciador" class="form-label">E-mail</label>

                        <input type="email" name="email_gerenciador" class="form-control" id="input-email-gerenciador" placeholder="Informe seu melhor e-mail">

                        <p id="mensagem-erro-email"></p>

                    </div>

                    <!-- SENHA DO ESTUDANTE -->

                    <div class="col-sm-12">

                        <label for="input-senha-gerenciador" class="form-label">Senha</label>

                        <input type="password" name="senha_gerenciador" class="form-control" id="input-senha-gerenciador" placeholder="Crie uma senha">

                        <p id="mensagem-erro-senha"></p>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn cadastrar" id="botao_cadastrar_gerenciador">Cadastrar</button>

        </form>
    </div>
</body>

</html>
