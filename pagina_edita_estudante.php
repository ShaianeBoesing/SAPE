<!DOCTYPE html>
<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Editar Estudante</title>
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
        
    $emailUsuario = $_GET['emailUsuario']; //pegou o id que foi passado pelo name do input hidden
     $sqlEstudante= "SELECT * FROM usuario WHERE emailUsuario = '$emailUsuario';";
     $res = mysqli_query($conn, $sqlEstudante); //fez o SELECT e puxou os dados do banco de dados

//     $linhasAfetadas = mysqli_affected_rows($conn);

     $dados = mysqli_fetch_array($res);
        
     $idUsuario = $dados['idUsuario'];
     $nomeUsuario = $dados['nomeUsuario'];
     $generoUsuario = $dados['generoUsuario'];
     $dataNascimento = $dados['dataNascimentoUsuario'];
     $senhaUsuario = $dados['senhaUsuario'];
     
    //FORMATAR A DATA
//    $dataNascimento = implode('/', array_reverse(explode('-', $dataNascimento)));

         

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
        <form method="POST" action="edita_cadastro_estudante.php">
            <div class="form-group">
                <h3 id="cadastrese"> Editar dados </h3>

                <p style="color:red">
                    <?php 
                if (isset($_SESSION['mensagem_erro'])){
                    
                    echo $_SESSION['mensagem_erro'];
                    unset ($_SESSION['mensagem_erro']);
                }
                ?>
                </p>

                <p style="color:green">
                    <?php 
                if (isset($_SESSION['mensagem_sucesso'])){
                    
                    echo $_SESSION['mensagem_sucesso'];
                    unset ($_SESSION['mensagem_sucesso']);
                }
                ?>
                </p>

                <div class="row">

                    <!-- NOME DO ESTUDANTE -->
                    <div class="col-sm-12">

                        <label for="input-nome-estudante" class="form-label">Nome</label>

                        <input type="hidden" name="id_estudante" class="form-control" id="input-id-estudante" value="<?php echo $idUsuario ?>">
                        <input type="text" name="nome_estudante" class="form-control" id="input-nome-estudante" value="<?php echo $nomeUsuario ?>">

                        <p id="mensagem-erro-nome"></p>

                    </div>

                    <!-- GENERO DO ESTUDANTE -->
                    <div class="col-sm-12">
                        <div id="select-genero">
                            <label for="btn-group" class="form-label"> Informe seu gênero </label>
                            <br />
                            <div class="btn-group" data-toggle="buttons">

                                <label class="btn btn-info">
                                    <input type="radio" value="F" autocomplete="off" name="genero" id="feminino" <?=($generoUsuario == "F")?'checked':''?>> Feminino
                                </label>

                                <label class="btn btn-info">
                                    <input type="radio" value="M" autocomplete="off" name="genero" id="masculino" <?=($generoUsuario == "M")?'checked':''?>> Masculino
                                </label>

                                <label class="btn btn-info">
                                    <input type="radio" value="NB" autocomplete="off" name="genero" id="nao_binario" <?=($generoUsuario == "NB")?'checked':''?>> Não-binário
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
                                <input class="form-control" type="date" name="data_nascimento" id="date-input" value="<?=$dataNascimento;?>">


                            </div>

                        </div>

                        <p id="mensagem-erro-data"></p>
                    </div>

                    <!-- EMAIL DO ESTUDANTE -->
                    <div class="col-sm-12">

                        <label for="input-email-estudante" class="form-label">E-mail</label>

                        <input type="email" name="email_estudante" class="form-control" id="input-email-estudante" value="<?php echo $emailUsuario?>">

                        <p id="mensagem-erro-email"></p>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn cadastrar" name="salvar" id="botao_atualizar_estudante">Salvar</button>

        </form>
    </div>
</body>

</html>
