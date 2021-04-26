<!DOCTYPE html>


<!-- INICIAR SESSÃO PHP -->

<?php 
     session_start();
     include 'conexao.php';
    
     $idQuestao = $_GET['idQuestao']; //pegou o id que foi passado pelo href na página de visualizar com GET

//     echo "id " . $idQuestao;
     $sql= "SELECT * FROM questao WHERE idQuestao = '$idQuestao';";
     $result = mysqli_query($conn, $sql); //fez o SELECT e puxou os dados do banco de dados
     $dado = mysqli_fetch_assoc($result);
                            
    //CRIANDO AS VARIAVEIS QUE ARMAZENAM OS DADOS VINDOS DO BANCO
     $prova = $dado["provaQuestao"];
     $area = $dado["areaQuestao"];
     $materia = $dado["materiaQuestao"];
     $conteudo = $dado["conteudoQuestao"];
     $topico = $dado["topicoQuestao"];
                            
     $enunciado=$dado["enunciadoQuestao"];
     $alternativaA=$dado["alternativaA"];
     $alternativaB=$dado["alternativaB"];
     $alternativaC=$dado["alternativaC"];
     $alternativaD=$dado["alternativaD"];
     $alternativaE=$dado["alternativaE"];

     $alternativaCorreta=$dado["alternativaCorreta"];
     
     $resolucao=$dado["resolucaoQuestao"];

     $idProva = $dado["idProva"];
     $idArea = $dado["idArea"];
     $idMateria = $dado["idMateria"];
     $idConteudo = $dado["idConteudo"];
     $idTopico = $dado["idTopico"];


?>

<html>

<head>
    <!--   GERAL       -->
    <meta charset="UTF-8">
    <title>SAPE - Editar Questão</title>
    <link rel="icon" href="images/sape-logo-icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--    CSS    -->
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pagina_cadastro_questao.css">

    <!--    BIBLIOTECAS BOOTSTRAP   -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="Jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <!-- LINK JAVASCRIPT -->
    <script src="js/cadastrar_questao.js"></script>



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


        <form method="POST" action="edita_cadastro_questao.php" id="cadastrar-questao" enctype="multipart/form-data">
            <div class="form-group">
                <h3> Editar Questão</h3>

                <p class="mensagem" style="color:red">
                    <?php if(isset($_SESSION['mensagem_erro'])){ 
                                echo $_SESSION['mensagem_erro'];
                                unset ($_SESSION['mensagem_erro']);
                            }?>
                </p>


                <span id="mensagem-cadastrado-sucesso" style="color:green"></span>
                <div class="row">

                    <input value="<?php echo $idQuestao; ?>" type="hidden" name="id_questao" class="form-control" id="input-id-prova">


                    <!-- SELECIONAR PROVA -->
                    <div class="col-sm-2">

                        <label for="btn-dropdown-prova-questao" class="form-label" id="label-dropdown-prova-questao">Prova</label>

                        <div class="dropdown obrigatorio">

                            <select name="prova_questao" value="Selecione" id="select-dropdown-prova-questao" class="btn btn-info dropdown-toggle-selects font-color">



                                <?php 
                                $sql = "SELECT * FROM prova ORDER BY anoAplicacao;";
                                $result = mysqli_query($conn, $sql);
                                
                                while($dados = mysqli_fetch_assoc($result)){
                                $id_prova = $dados['idProva'];
                                $siglaProva = $dados['siglaProva'];
                                $anoProva = $dados['anoAplicacao'];
                                ?>



                                <option class="dropdown-item" type="button" value="<?php echo $idProva;?>" <?=($id_prova == $idProva)?'selected':''?>><?php echo $siglaProva . ' ( '. $anoProva . ' )'; ?>
                                </option>


                                <?php     
                                }
                                ?>

                            </select>
                        </div>
                    </div>



                    <!-- SELECIONAR ÁREA -->
                    <div class="col-sm-2">
                        <label for="btn-dropdown-area-questao" class="form-label" id="label-dropdown-area-questao">Área</label>
                        <div class="dropdown obrigatorio">

                            <select name="area_questao" value="Selecione" id="select-dropdown-area-questao" class="btn btn-info dropdown-toggle-selects font-color">


                                <?php 
                                $sql = "SELECT * FROM area ;";
                                $result = mysqli_query($conn, $sql);
                                
                                while($dados = mysqli_fetch_assoc($result)){
                                $id_area = $dados['idArea'];
                                $nome_area = $dados['nomeArea'];
                                ?>



                                <option class="dropdown-item" type="button" value="<?php echo $id_area;?>" <?=($id_area == $idArea)?'selected':''?>><?php echo $nome_area; ?>
                                </option>



                                <?php     
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <!-- SELECIONAR MATÉRIA -->
                    <div class="col-sm-2">
                        <label for="btn-dropdown-materia-questao" class="form-label" id="label-dropdown-materia-questao">Materia</label>
                        <div class="dropdown obrigatorio">

                            <select name="materia_questao" value="Selecione" id="select-dropdown-materia-questao" class="btn btn-info dropdown-toggle-selects font-color">
                                <?php 
                                $sql = "SELECT * FROM materia WHERE idArea = $idArea ORDER BY nomeMateria;";
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
                    </div>

                    <!-- SELECIONAR CONTEÚDO -->
                    <div class="col-sm-2">
                        <label for="btn-dropdown-conteudo-questao" class="form-label" id="label-dropdown-conteudo-questao">Conteúdo</label>
                        <div class="dropdown obrigatorio">

                            <select name="conteudo_questao" value="Selecione" id="select-dropdown-conteudo-questao" class="btn btn-info dropdown-toggle-selects font-color">
                                <?php 
                                $sql = "SELECT * FROM conteudo WHERE idMateria= $idMateria ORDER BY nomeConteudo ;";
                                $result = mysqli_query($conn, $sql);
                                
                                while($dados = mysqli_fetch_assoc($result)){
                                $id_conteudo = $dados['idConteudo'];
                                $nome_conteudo = $dados['nomeConteudo'];
                                ?>



                                <option class="dropdown-item" type="button" value="<?php echo $id_conteudo;?>" <?=($id_conteudo == $idConteudo)?'selected':''?>><?php echo $nome_conteudo; ?>
                                </option>


                                <?php     
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                    <!-- SELECIONAR TÓPICO -->
                    <div class="col-sm-2">
                        <label for="btn-dropdown-topico-questao" class="form-label" id="label-dropdown-topico-questao">Tópico</label>
                        <div class="dropdown">
                            <select name="topico_questao" value="Selecione" id="select-dropdown-topico-questao" class="btn btn-info dropdown-toggle-selects font-color">
                                <?php 
                                $sql = "SELECT * FROM topico WHERE idConteudo= $idConteudo ORDER BY nomeTopico ;";
                                $result = mysqli_query($conn, $sql);
                                
                                while($dados = mysqli_fetch_assoc($result)){
                                $id_topico = $dados['idTopico'];
                                $nome_topico = $dados['nomeTopico'];
                                ?>



                                <option class="dropdown-item" type="button" value="<?php echo $id_topico;?>" <?=($id_topico == $idTopico)?'selected':''?>><?php echo $nome_topico; ?>
                                </option>


                                <?php     
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
                <p id="mensagem-erro-prova-questao"> </p>
                <p id="mensagem-erro-area-questao"> </p>
                <p id="mensagem-erro-materia-questao"> </p>
                <p id="mensagem-erro-conteudo-questao"> </p>

                <!-- ENUNCIADO -->
                <div class="row">
                    <div class="col-sm-12" id="enunciado">
                        <div class="form-group">
                            <label for="textarea-enunciado" class="form-label">Enunciado da questão</label>

                            <textarea type="text" name="enunciado_questao" class="form-control" id="textarea-enunciado" placeholder="Digite o enunciado da questão"><?php echo $enunciado?></textarea>
                        </div>
                        <p id="mensagem-erro-enunciado"></p>
                    </div>
                </div>



                <!-- ALTERNATIVA A -->
                <div class="row">
                    <div class="col-sm-12" id="alternativaA">
                        <div class="form-group">
                            <label for="textarea-alternativaA" class="form-label">Alternativa A</label>
                            <textarea type="text" class="form-control" name="alternativaA" id="textarea-alternativaA" placeholder="Digite a alternativa A aqui"><?php echo  $alternativaA ?></textarea>
                        </div>
                        <p id="mensagem-erro-alternativaA"></p>
                    </div>
                </div>

                <!-- ALTERNATIVA B -->
                <div class="row">
                    <div class="col-sm-12" id="alternativaB">
                        <div class="form-group" id="form-group-alternativab">
                            <label for="textarea_alternativaB" class="form-label">Alternativa B</label>
                            <textarea type="text" class="form-control" name="alternativaB" id="textarea-alternativaB" placeholder="Digite a alternativa B aqui"><?php echo  $alternativaB ?></textarea>
                        </div>
                        <p id="mensagem-erro-alternativaB"></p>
                    </div>
                </div>



                <!-- ALTERNATIVA C -->

                <div class="row">
                    <div class="col-sm-12" id="alternativaC">
                        <div class="form-group">
                            <label for="textarea_alternativaC" class="form-label">Alternativa C</label>
                            <textarea type="text" class="form-control" name="alternativaC" id="textarea-alternativaC" placeholder="Digite a alternativa C aqui"><?php echo  $alternativaC ?></textarea>
                        </div>
                        <p id="mensagem-erro-alternativaC"></p>
                    </div>
                </div>




                <!-- ALTERNATIVA D -->

                <div class="row">
                    <div class="col-sm-12" id="alternativaD">
                        <div class="form-group">
                            <label for="textarea_alternativaD" class="form-label">Alternativa D</label>
                            <textarea type="text" class="form-control" name="alternativaD" id="textarea-alternativaD" placeholder="Digite a alternativa D aqui"><?php echo  $alternativaD ?></textarea>
                        </div>
                        <p id="mensagem-erro-alternativaD"></p>
                    </div>
                </div>



                <!-- ALTERNATIVA E -->

                <div class="row">
                    <div class="col-sm-12" id="alternativaE">
                        <div class="form-group">
                            <label for="textarea_alternativaE" class="form-label">Alternativa E</label>
                            <textarea type="text" class="form-control" name="alternativaE" id="textarea-alternativaE" placeholder="Digite a alternativa E aqui"><?php echo  $alternativaE ?></textarea>
                        </div>
                        <p id="mensagem-erro-alternativaE"></p>
                    </div>
                </div>



                <!-- ALTERNATIVA CORRETA -->
                <div class="form-group" id="select-alternativa-correta">
                    <label for="btn-group" class="form-label"> Alternativa correta: </label>

                    <div class="btn-group" data-toggle="buttons">


                        <label class="btn btn-outline-success">
                            <input type="radio" value="A" autocomplete="off" name="alternativa-correta" id="alternativa-correta-a" <?=("A" == $alternativaCorreta)?'checked':''?>> A
                        </label>

                        <label class="btn btn-outline-success">
                            <input type="radio" value="B" autocomplete="off" name="alternativa-correta" id="alternativa-correta-b" <?=("B" == $alternativaCorreta)?'checked':''?>> B
                        </label>

                        <label class="btn btn-outline-success">
                            <input type="radio" value="C" autocomplete="off" name="alternativa-correta" id="alternativa-correta-c" <?=("C" == $alternativaCorreta)?'checked':''?>> C
                        </label>

                        <label class="btn btn-outline-success">
                            <input type="radio" value="D" autocomplete="off" name="alternativa-correta" id="alternativa-correta-d" <?=("D" == $alternativaCorreta)?'checked':''?>> D
                        </label>

                        <label class="btn btn-outline-success">
                            <input type="radio" value="E" autocomplete="off" name="alternativa-correta" id="alternativa-correta-d" <?=("E" == $alternativaCorreta)?'checked':''?>> E
                        </label>

                    </div>

                </div>
                <p id="mensagem-erro-alternativaCorreta"></p>


                <!-- RESOLUÇÃO -->


                <div class="row">
                    <div class="col-sm-12" id="resolucao">
                        <div class="form-group">
                            <label for="textarea-resolucao" class="form-label">Resolução da questão</label>
                            <textarea type="text" name="resolucao_questao" class="form-control" id="textarea-resolucao" placeholder="Digite a resolução da questão"><?php echo $resolucao ?></textarea>
                        </div>
                        <p id="mensagem-erro-resolucao"></p>
                    </div>
                </div>

            </div>
            <p id="verifica-pagina"></p>
            <button type="submit" name="salvar" class="btn cadastrar" id="botao-atualizar-questao">Salvar</button>

        </form>
    </div>

</body>

</html>



<script>
    // SELECTS DROPDOWN DINÂMICOS 
    $(document).ready(function() {

        // MATERIA DA QUESTÃO
        $("#select-dropdown-area-questao").change(function() {

            var idArea = $("#select-dropdown-area-questao").val();
            $.ajax({

                url: 'busca_materia.php',
                type: 'POST',
                data: {
                    idArea: idArea
                },
                success: function(data) {
                    $("#select-dropdown-materia-questao").html(data);
                },
                error: function(data) {
                    $("#select-dropdown-materia-questao").html("Houve um erro ao carregar os dados");
                }

            });

        });

        //CONTEUDO DA QUESTAO
        $("#select-dropdown-materia-questao").change(function() {

            var idMateria = $("#select-dropdown-materia-questao").val();


            $.ajax({

                url: 'busca_conteudo.php',
                type: 'POST',
                data: {
                    idMateria: idMateria
                },
                success: function(data) {
                    $("#select-dropdown-conteudo-questao").html(data);

                },
                error: function(data) {
                    $("#select-dropdown-conteudo-questao").html("Houve um erro ao carregar os dados");

                }

            });

        });

        // TOPICO DA QUESTÃO
        $("#select-dropdown-conteudo-questao").change(function() {

            var idConteudo = $("#select-dropdown-conteudo-questao").val();

            $.ajax({

                url: 'busca_topico.php',
                type: 'POST',
                data: {
                    idConteudo: idConteudo
                },
                success: function(data) {
                    $("#select-dropdown-topico-questao").html(data);
                },
                error: function(data) {
                    $("#select-dropdown-topico-questao").html("Houve um erro ao carregar os dados");
                }

            });

        });

    });

</script>
