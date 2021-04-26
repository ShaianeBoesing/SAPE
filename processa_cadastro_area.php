<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Cadastro de Área </title>

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
    $nome_area = $_POST["nome_area"]; //campo name do html


    /* VERIFICANDO SE A ÁREA JÁ ESTÁ CADASTRADO (ATRAVÉS DO CAMPO NOME DO BANCO)*/
    mysqli_query($conn, "SELECT nomeArea FROM area WHERE nomeArea = '$nome_area';");
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas != 0){
        
        $_SESSION['mensagem_erro']= "Essa área já foi cadastrada.";
        echo "<script language='javascript'>history.back()</script>";
        die();                

    } else {
    
    /*ENVIANDO OS DADOS DIGITADOS PARA BANCO DE DADOS*/
        $sql = "INSERT INTO area ( nomeArea ) 
        VALUES ('$nome_area');"; 
        $result_area = mysqli_query($conn, $sql); 

        if (mysqli_error($conn)) {

            $_SESSION['mensagem_erro']= "Ocorreu um erro ao cadastrar esta área.";
            echo "<script language='javascript'>history.back()</script>";
            die();                


        } else {

            $_SESSION['mensagem_acerto']= "Área cadastrada com sucesso.";
            header('location: pagina_cadastro_area.php');
            die();                


        } 

    }

    mysqli_close($conn);
    
    ?>

</body>

</html>
