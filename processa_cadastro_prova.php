<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Cadastro de Prova </title>

    <?php
    session_start();
    include_once("conexao.php");    
    ?>

    <!---------------------------CSS--------------------------->
    <link rel="stylesheet" type="text/css" href="css/pagina_cadastro_area.css">

    <!--------------------------JQUERY------------------------------------>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js'></script>

    <!---------------------------JS----------------------------->
    <script type="text/javascript" src="js/cadastrar_area.js"></script>


</head>

<body>



    <!-- -------------------------------------------------------------- -->
    <?php
    
    /*  PEGANDO VALORES ATRAVÉS DO CAMPO NAME DO HTML */
    $nome_prova = $_POST["nome_prova"]; //campo name do html
    $sigla_prova = $_POST["sigla_prova"]; //campo name do html
    $ano_prova = $_POST["ano_prova"]; //campo name do html


    /* VERIFICANDO SE A ÁREA JÁ ESTÁ CADASTRADO (ATRAVÉS DO CAMPO NOME DO BANCO)*/
    
    $sql = "SELECT nomeProva, anoAplicacao FROM prova WHERE nomeProva = '$nome_prova' AND anoAplicacao = $ano_prova;";
    mysqli_query($conn, $sql );
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas != 0){
        
        $_SESSION['mensagem_erro']= "Essa prova já foi cadastrada.";
        echo "<script language='javascript'>history.back()</script>";
        die();                

    } else {
        
    
        /*ENVIANDO OS DADOS DIGITADOS PARA BANCO DE DADOS*/
        $sql = "INSERT INTO prova ( nomeProva, siglaProva, anoAplicacao ) 
        VALUES ('$nome_prova', '$sigla_prova', $ano_prova);"; 
        $result_prova = mysqli_query($conn, $sql); 

    
    
        if (mysqli_error($conn)) {
            
            $_SESSION['mensagem_erro']= "Ocorreu um erro ao cadastrar esta prova.";
            echo "<script language='javascript'>history.back()</script>";
            die();                

        } else {
            
            $_SESSION['mensagem_acerto']= "Cadastrado com sucesso.";
            header('location: pagina_cadastro_prova.php');


        } 
    }

    mysqli_close($conn);
    
    ?>

</body>

</html>
