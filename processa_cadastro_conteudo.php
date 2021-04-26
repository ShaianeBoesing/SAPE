<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Cadastro de Matéria </title>

    <?php
    session_start();
    include_once("conexao.php");    
    ?>

    <!---------------------------CSS--------------------------->
    <link rel="stylesheet" type="text/css" href="css/pagina_cadastro_conteudo.css">

    <!--------------------------JQUERY------------------------------------>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js'></script>

    <!---------------------------JS----------------------------->
    <script type="text/javascript" src="js/cadastrar_materia.js"></script>


</head>

<body>



    <!-- -------------------------------------------------------------- -->
    <?php
    
    /*  PEGANDO VALORES ATRAVÉS DO CAMPO NAME DO HTML */
    $nome_conteudo = $_POST["nome_conteudo"]; //campo name do html -- traz o nome da matéria que foi digitado
    $materia_conteudo = $_POST["materia_conteudo"]; //campo name do html -- traz o id da área que foi selecionada 
    $link_conteudo = $_POST["link_conteudo"]; //campo name do html -- traz o link do conteúdo que foi digitado
    
    
    $sql_nome_materia = "SELECT nomeMateria FROM materia WHERE idMateria = $materia_conteudo;"; //busca a área pelo id
    $result = mysqli_query($conn, $sql_nome_materia); 
    $dados = mysqli_fetch_assoc($result); 
    $nome_materia = $dados['nomeMateria']; // traz o nome da área do banco de dados.
    
    
    /* VERIFICANDO SE A MATÉRIA JÁ ESTÁ CADASTRADA */
    $sqlVerificaConteudo= "SELECT nomeConteudo FROM conteudo WHERE nomeConteudo = '$nome_conteudo';";
    mysqli_query($conn, $sqlVerificaConteudo);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas != 0){
        
        $_SESSION['mensagem_erro']= "Esse conteúdo já foi cadastrado.";
        echo "<script language='javascript'>history.back()</script>";
        die();  
        
    } else {
    
        /*ENVIANDO OS DADOS INFORMADOS PARA BANCO DE DADOS*/
        $sqlInsert = "INSERT INTO conteudo ( nomeConteudo, linkConteudo, materiaConteudo, idMateria) 
        VALUES ('$nome_conteudo', '$link_conteudo', '$nome_materia', '$materia_conteudo');"; 

        $result_conteudo = mysqli_query($conn, $sqlInsert); 


        if (mysqli_error($conn)) {

            $_SESSION['mensagem_erro']= "Ocorreu um erro ao cadastrar este conteúdo.";
            echo "<script language='javascript'>history.back()</script>";
            die();                
            
        } else {
            
            $_SESSION['mensagem_acerto']= "Conteúdo cadastrado com sucesso.";
            header('location:pagina_cadastro_conteudo.php');
            die();                

        }
    } 

    mysqli_close($conn);
    
    ?>

</body>

</html>
