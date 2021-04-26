<!DOCTYPE html>


<!-- INICIAR SESSÃO PHP -->

<?php 
     session_start();
     include 'conexao.php';
    
     $idConteudo = $_GET['idConteudo']; //pegou o id que foi passado pelo href na página de visualizar com GET
    // $sql = "SELECT nomeProva FROM prova WHERE idprova = '$idProva';";
     $sql= "SELECT * FROM conteudo WHERE idConteudo = '$idConteudo';";
     $res = mysqli_query($conn, $sql); //fez o SELECT e puxou os dados do banco de dados

//     $linhasAfetadas = mysqli_affected_rows($conn);

     $dados = mysqli_fetch_array($res);
        
     $nomeConteudo = $dados['nomeConteudo'];
     $linkConteudo = $dados['linkConteudo'];
     $nomeMateria = $dados['materiaConteudo'];
     $idMateria = $dados['idMateria'];

?>

<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Editar Conteúdo</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pagina_cadastro_conteudo.css">

    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <!-- LINK JAVASCRIPT -->
    <script src="js/cadastrar_conteudo.js"></script>



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


        <form method="POST" action="edita_cadastro_conteudo.php">
            <div class="form-group">
                <h3> Editar conteúdo</h3>

                <p class="mensagem" style="color:red">
                    <?php if(isset($_SESSION['mensagem_erro'])){ 
                                echo $_SESSION['mensagem_erro'];
                                unset ($_SESSION['mensagem_erro']);
                            }?>
                </p>


                <div class="row">
                    <div class="col-sm-12">

                        <label for="input-nome-conteudo" class="form-label">Nome do Conteúdo</label>

                        <input type="hidden" value="<?php echo $idConteudo ?>" name="id_conteudo" class="form-control" id="input-id-conteudo">

                        <input type="text" value="<?php echo $nomeConteudo ?>" name="nome_conteudo" class="form-control" id="input-nome-conteudo">

                        <p id="mensagem-erro-nome"></p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label for="dropdown-materia-conteudo" class="form-label" id="label-dropdown-materia-conteudo">Matéria do Conteúdo </label>

                        <div class="dropdown">

                            <select name="materia_conteudo" id="select-dropdown-materia-conteudo" class="btn btn-outline-info dropdown-toggle font-color">

                                <option class="dropdown-item" type="button" id="item-dropdown-selecione" value="selecione" selected>Selecione</option>


                                <?php 
    
                                $sql = "SELECT * FROM materia ORDER BY nomeMateria;";
                                $result = mysqli_query($conn, $sql);

                                while($dados = mysqli_fetch_assoc($result)){
                                $id_materia = $dados['idMateria'];                                              
                                $nome_materia = $dados['nomeMateria'];

                                ?>

                                <option class="dropdown-item" type="button" value="<?php echo $id_materia;?>" <?=($id_materia == $idMateria)?'selected':''?>><?php echo $nome_materia; ?>
                                </option>


                                <?php     
                                }
                                ?>



                            </select>
                        </div>
                        <p id="mensagem-erro-materia"></p>

                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label for="input-link-conteudo" class="form-label">Link de recomendação sobre o conteúdo</label>
                        <input type="url" value="<?php echo $linkConteudo?>" name="link_conteudo" class="form-control" id="input-link-conteudo" placeholder="Digite o link de recomendação do conteúdo">
                    </div>
                </div>
                <p id="mensagem-erro-link"></p>

            </div>


            <button type="submit" class="btn cadastrar" id="botao_salvar_conteudo" value="salvar" name="salvar">Salvar</button>

        </form>
    </div>

</body>

</html>
