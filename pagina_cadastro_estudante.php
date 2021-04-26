<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Cadastrar Estudante</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar_estudante.css">
    <link rel="stylesheet" href="css/pagina_cadastro_estudante.css">

    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <!--     INICIAR SESSÃO PHP -->
    <?php 
        session_start();
        include 'conexao.php';
    ?>


    <!-- LINK JAVASCRIPT -->
    <script src="js/cadastrar_estudante.js"></script>


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
        <form method="POST" action="processa_cadastro_estudante.php">
            <div class="form-group">
                <h3 id="cadastrese"> Cadastre-se</h3>

                <p class='mensagem' style="color:red" >
                    <?php 
                if (isset($_SESSION['mensagem_erro'])){
                    
                    echo $_SESSION['mensagem_erro'];
                    unset ($_SESSION['mensagem_erro']);
                }
                ?>
                </p>


                <div class="row">

                    <!-- NOME DO ESTUDANTE -->
                    <div class="col-sm-12">

                        <label for="input-nome-estudante" class="form-label">Nome</label>

                        <input type="text" name="nome_estudante" class="form-control" id="input-nome-estudante" placeholder="Informe seu nome completo">

                        <p id="mensagem-erro-nome"></p>

                    </div>

                    <!-- GENERO DO ESTUDANTE -->
                    <div class="col-sm-12">
                        <div id="select-genero">
                            <label for="btn-group" class="form-label"> Informe seu gênero </label>
                            <br />
                            <div class="btn-group" data-toggle="buttons">

                                <label class="btn btn-info">
                                    <input type="radio" value="F" autocomplete="off" name="genero" id="feminino"> Feminino
                                </label>

                                <label class="btn btn-info">
                                    <input type="radio" value="M" autocomplete="off" name="genero" id="masculino"> Masculino
                                </label>

                                <label class="btn btn-info">
                                    <input type="radio" value="NB" autocomplete="off" name="genero" id="nao_binario"> Não-binário
                                </label>


                            </div>

                        </div>

                        <p id="mensagem-erro-genero"></p>
                    </div>


                    <!-- DATA DE NASC DO ESTUDANTE -->
                    <div class="col-sm-12">
                        <label for="date-input" class="form-label"> Informe sua data de nascimento </label>
                        <br />
                        <div class="row">
                            <div class="col-12">
                                <input class="form-control" type="date" name="data_nascimento" value="" id="date-input">


                            </div>

                        </div>

                        <p id="mensagem-erro-data"></p>
                    </div>

                    <!-- EMAIL DO ESTUDANTE -->
                    <div class="col-sm-12">

                        <label for="input-email-estudante" class="form-label">E-mail</label>

                        <input type="email" name="email_estudante" class="form-control" id="input-email-estudante" placeholder="Informe seu melhor e-mail">

                        <p id="mensagem-erro-email"></p>

                    </div>

                    <!-- SENHA DO ESTUDANTE -->

                    <div class="col-sm-12">

                        <label for="input-senha-estudante" class="form-label">Senha</label>

                        <input type="password" name="senha_estudante" class="form-control" id="input-senha-estudante" placeholder="Crie uma senha">

                        <p id="mensagem-erro-senha"></p>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn cadastrar" id="botao_cadastrar_estudante">Cadastrar</button>

        </form>
    </div>
</body>

</html>
