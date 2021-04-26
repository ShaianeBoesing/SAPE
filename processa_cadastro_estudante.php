<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Cadastro de Estudante </title>

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
    $nome_estudante = $_POST["nome_estudante"]; //campo name do html -- traz o nome do estudante que foi digitado
    $genero_estudante = $_POST["genero"]; //campo name do html -- traz o id da genero do estudante 
    $data_nascimento = $_POST["data_nascimento"]; //campo name do html -- traz a data de nascimento do estudante 
    $email_estudante = $_POST["email_estudante"]; //campo name do html -- traz a data de nascimento do estudante 
    $senha_estudante = $_POST["senha_estudante"]; //campo name do html -- traz a data de nascimento do estudante 
    
    
    
    /* VERIFICANDO SE JÁ  EXISTE UM CADASTRO COM ESTE MESMO E-MAIL */
    $sqlVerificaEstudante= "SELECT emailUsuario FROM usuario WHERE emailUsuario = '$email_estudante';";
    mysqli_query($conn, $sqlVerificaEstudante);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas != 0){
        
         $_SESSION['mensagem_erro']= "Uma conta já está cadastrada com este endereço de e-mail.";
            echo "<script language='javascript'>history.back()</script>";
            die();                
        
    } else {
    
            
        $crip = md5($senha_estudante);

        /*ENVIANDO OS DADOS INFORMADOS PARA BANCO DE DADOS*/
        $sqlInsert = "INSERT INTO usuario ( tipoUsuario, nomeUsuario, dataNascimentoUsuario, emailUsuario, senhaUsuario, generoUsuario) 
        VALUES ('E', '$nome_estudante',  '$data_nascimento', '$email_estudante', '$crip', '$genero_estudante');"; 

        $result_estudante = mysqli_query($conn, $sqlInsert); 


    
    //PARA TESTAR E VER SE OCORREU ALGUM ERRO    
        if (mysqli_error($conn)) {

        $_SESSION['mensagem_erro']= "Ocorreu um erro ao cadastrar este e-mail.";
        echo "<script language='javascript'>history.back()</script>";
        die();                

        } else {
        $_SESSION['usuario_logado'] = "'$email_estudante'";
        header('location: pagina_jornada_estudante.php');
        die();  

        } 
    }

    mysqli_close($conn);
    
    ?>

</body>

</html>
