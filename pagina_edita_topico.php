<!DOCTYPE html>


<!-- INICIAR SESSÃO PHP -->

<?php 
     session_start();
     include 'conexao.php';
    
     $idTopico = $_GET['idTopico']; //pegou o id que foi passado pelo href na página de visualizar com GET
     $sql= "SELECT * FROM topico WHERE idTopico = '$idTopico';";
     $res = mysqli_query($conn, $sql); //fez o SELECT e puxou os dados do banco de dados
     $dados = mysqli_fetch_array($res); 
     $nomeTopico = $dados['nomeTopico'];
     $linkTopico = $dados['linkTopico'];
     $conteudoTopico = $dados['conteudoTopico'];
     $idConteudo = $dados['idConteudo'];

?>

<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Editar Tópicos</title>
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
    <script src="js/cadastrar_topico.js"></script>



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


        <form method="POST" action="edita_cadastro_topico.php">
            <div class="form-group">
                <h3> Editar tópico</h3>
                
                <p class="mensagem" style="color:red">
                    <?php if(isset($_SESSION['mensagem_erro'])){ 
                                echo $_SESSION['mensagem_erro'];
                                unset ($_SESSION['mensagem_erro']);
                            }?>
                </p>

                <div class="row">
                    <div class="col-sm-12">

                        <label for="input-nome-topico" class="form-label">Nome do Tópico</label>

                        <input type="hidden" value="<?php echo $idTopico?>" name="id_topico" class="form-control" id="input-id-topico">
                        <input type="text" value="<?php echo $nomeTopico?>" name="nome_topico" class="form-control" id="input-nome-topico">

                        <p id="mensagem-erro-nome"></p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="dropdown-conteudo-topico" class="form-label" id="label-dropdown-conteudo-topico">Conteúdo do Tópico</label>

                        <div class="dropdown">

                            <select name="conteudo_topico" id="select-dropdown-conteudo-topico" class="btn btn-outline-info dropdown-toggle font-color">

                                <option class="dropdown-item" type="button" id="item-dropdown-selecione" value="selecione" selected>Selecione</option>

                                <?php 
                                $sql = "SELECT * FROM conteudo;";
                                $result = mysqli_query($conn, $sql);
                                
                                while($dados = mysqli_fetch_assoc($result)){
                                    
                                $id_conteudo = $dados['idConteudo'];   
                                    
                                $nome_conteudo = $dados['nomeConteudo'];

                                ?>

                                <option class="dropdown-item" type="button" value="<?php echo $id_conteudo;?>" <?=($id_conteudo == $idConteudo)?'selected':''?>> <?php echo $nome_conteudo; ?>

                                <?php     
                                }
                                ?>

                            </select>
                        </div>
                        <p id="mensagem-erro-conteudo"></p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label for="input-link-topico" class="form-label">Link de recomendação sobre o tópico</label>

                        <input type="url" value="<?php echo $linkTopico ?>"name="link_topico" class="form-control" id="input-link-topico" placeholder="Informe um link de recomendação">
                    </div>
                </div>
                <p id="mensagem-erro-link"></p>

            </div>
            <button type="submit" class="btn cadastrar" id=botao_editar_topico name="salvar">Salvar</button>

        </form>
    </div>

</body>

</html>
