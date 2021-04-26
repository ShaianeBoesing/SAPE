<!DOCTYPE html>

<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Criar Minha Jornada</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar_estudante.css">
    <link rel="stylesheet" href="css/pagina_cadastro_jornada.css">

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
    <!--    <script src="js/cadastrar_jornada.js"></script>-->




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

    <!-- CORPO -->

    <div class="container">
        <form method="POST" action="processa_cadastro_jornada.php" id="cadastrar-questao" enctype="multipart/form-data">
            <div class="form-group">
                <h3 class="titulo"> CRIE SUA JORNADA </h3>

                <span id="mensagem-cadastrado-sucesso" style="color:green"></span>
                <div class="row">

                    <!-- SELECIONAR ÁREA -->
                    <div class="col-sm-12">
                        <label for="btn-checkbox-area" class="form-label" id="label-checkbox-area">Área(s) que quero na minha jornada</label>
                        <div class="checkbox obrigatorio">



                            <?php 
                                $sql = "SELECT * FROM area;";
                                $result = mysqli_query($conn, $sql);
                                
                                while($dados = mysqli_fetch_assoc($result)){
                                $idArea = $dados['idArea'];    
                                $nomeArea = $dados['nomeArea'];
                            ?>
                            <!--

                            <input name="area[]" type="checkbox" value="<?php echo  $idArea ?>" /> <label>
                                <?php echo  $nomeArea ?> </label>
                            <br> 
-->
                            <div class="col-md-12">
                                <label class="btn btn-outline-info">
                                    <input type="checkbox" value="<?php echo  $idArea ?>" autocomplete="off" name="area[]" > <?php echo  $nomeArea ?>
                                </label>
                            </div>


                            <?php     
                                }
                                ?>






                        </div>

                    </div>

                    <p id="mensagem-erro-genero"></p>
                </div>


                <!-- SELECIONAR VEZES NA SEMANA (DIAS) -->
                <div class="row">
                    <div class="col-sm-12">
                        <label for="btn-dropdown-dias" class="form-label" id="label-dropdown-dias">Quantos dias por semana irei estudar</label>
                        <div class="dropdown obrigatorio">
                            <select name="dias-jornada" value="Selecione" id="select-dropdown-dias" class="btn btn-info dropdown-toggle-selects font-color">

                                <option class="dropdown-item" type="button" id="item-dropdown-selecione" value="Selecione" selected>Selecione</option>

                                <option class="dropdown-item" type="button" value="4"> 4 </option>
                                <option class="dropdown-item" type="button" value="5"> 5 </option>
                                <option class="dropdown-item" type="button" value="6"> 6 </option>
                                <option class="dropdown-item" type="button" value="7"> 7 </option>

                            </select>
                        </div>
                    </div>
                </div>

                <!-- SELECIONAR QUESTÕES POR ROTEIRO -->
                <div class="row">
                    <div class="col-sm-12">
                        <label for="btn-dropdown-questoes" class="form-label" id="label-dropdown-prova-questao"> Quantas questões quero em cada roteiro? </label>
                        <div class="dropdown obrigatorio">
                            <select name="questoes-jornada" value="Selecione" id="select-dropdown-questoes" class="btn btn-info dropdown-toggle-selects font-color">

                                <option class="dropdown-item" type="button" id="item-dropdown-selecione" value="Selecione" selected>Selecione</option>

                                <option class="dropdown-item" type="button" value="4"> 4 </option>
                                <option class="dropdown-item" type="button" value="6"> 6 </option>
                                <option class="dropdown-item" type="button" value="8"> 8 </option>
                                <option class="dropdown-item" type="button" value="12"> 12 </option>

                            </select>
                        </div>
                    </div>
                    <!--
                </div>

                <p id="mensagem-erro-prova-questao"> </p>
                <p id="mensagem-erro-area-questao"> </p>
                <p id="mensagem-erro-materia-questao"> </p>
                <p id="mensagem-erro-conteudo-questao"> </p>
-->


                </div>
                <p id="verifica-pagina"></p>
                <!--
            <h5> Sua jornada durará:
                <h6 id="tempo-jornada"> </h6>
            </h5>
-->


                <button type="submit" name="botao-cadastrar-jornada" class="btn btn-outline-info cadastrar" id="botao-cadastrar-jornada">Criar </button>
            </div>
        </form>
    </div>
</body>

</html>
