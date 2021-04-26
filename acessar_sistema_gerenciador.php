<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Acessar sistema </title>

    <?php
    session_start();
    include_once("conexao.php");    
    ?>

    <!---------------------------CSS--------------------------->
    <link rel="stylesheet" type="text/css" href="css/pagina_cadastro_estudante.css">

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
    $email = $_POST["email"]; //campo name do html -- traz o email do gerenciador
    $senha = $_POST["senha"]; //campo name do html -- traz a senha do gerenciador
    
    if (($email != "") && ($senha !="")){
        
    
    
    /* VERIFICANDO SE O ESTUDANTE JÁ ESTÁ CADASTRADA */
    $sqlVerifica= "SELECT * FROM usuario WHERE emailUsuario = '$email' AND tipoUsuario = 'G';";
    mysqli_query($conn, $sqlVerifica);
    $linhasAfetadas = mysqli_affected_rows($conn);
//    echo $sqlVerificaEstudante;

    if ($linhasAfetadas == 1){
        
        $result = mysqli_query($conn, $sqlVerifica); 
        $dados = mysqli_fetch_assoc($result); 
        $senha_bd = $dados['senhaUsuario']; // traz a senha do usuario.

        if ($senha == $senha_bd){
            header('location: pagina_inicial_gerenciador.php');
        die();  

        } else {
            $_SESSION['mensagem_erro']= "O e-mail ou a senha estão incorretos.";
            header('location: pagina_acesso_gerenciador.php');
        

        }
    
    } else {
    
         $_SESSION['mensagem_erro']= "Não existe uma conta cadastrada nesse endereço de e-mail";
        header('location: pagina_acesso_gerenciador.php');

    }
    } else {
        $_SESSION['mensagem_erro']= "Informe o email e a senha.";
        header('location: pagina_acesso_gerenciador.php');

    }

    mysqli_close($conn);
    
    ?>

</body>

</html>
