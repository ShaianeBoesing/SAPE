<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Chave de Acesso </title>

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



    <?php
    
    /*  PEGANDO VALORES ATRAVÉS DO CAMPO NAME DO HTML */
    $chave = $_POST["chave"]; //campo name do html -- traz o nome da matéria que foi digitado
    
    
    /* VERIFICANDO SE A MATÉRIA JÁ ESTÁ CADASTRADA */
    $sql_chave = "SELECT chave FROM chaves WHERE chave = $chave;"; 
    mysqli_query($conn, $sql_chave);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas == 1){
        $sqlRemove = "DELETE FROM chaves WHERE chave=$chave;"; 

        $result = mysqli_query($conn, $sqlRemove); 


        echo"<script language='javascript' type='text/javascript'>
          location.href='pagina_cadastro_gerenciador.php'
        </script>";
        die();                
    } else {
        header('location: pagina_chave_acesso_gerenciador.php');
        die();

    }    
    
    mysqli_close($conn);
    
    ?>

</body>

</html>
