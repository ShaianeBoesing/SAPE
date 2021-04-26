<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Cadastro de Gerenciador </title>

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
    $nome_gerenciador = $_POST["nome_gerenciador"]; //campo name do html -- traz o nome do estudante que foi digitado
    $cpf_gerenciador = $_POST["cpf_gerenciador"]; //campo name do html -- traz o id da genero do estudante 
    $data_nascimento = $_POST["data_nascimento"]; //campo name do html -- traz a data de nascimento do estudante 
    $email_gerenciador = $_POST["email_gerenciador"]; //campo name do html -- traz a data de nascimento do estudante 
    $senha_gerenciador = $_POST["senha_gerenciador"]; //campo name do html -- traz a data de nascimento do estudante 
    
    
    
    /* VERIFICANDO SE O ESTUDANTE JÁ ESTÁ CADASTRADA */
    $sqlVerificaGerenciador= "SELECT emailUsuario FROM usuario WHERE emailUsuario = '$email_gerenciador';";
    mysqli_query($conn, $sqlVerificaGerenciador);
    $linhasAfetadas = mysqli_affected_rows($conn);
//    echo $sqlVerificaEstudante;

    if ($linhasAfetadas != 0){
        echo "aq";

         $_SESSION['mensagem_erro']= "Uma conta já está cadastrada com este endereço de e-mail.";
        echo "<script language='javascript'>history.back()</script>";
        die();  
        
    } else {

        
    $crip = md5($senha_gerenciador);
    
    /*ENVIANDO OS DADOS INFORMADOS PARA BANCO DE DADOS*/
    $sqlInsert = "INSERT INTO usuario ( tipoUsuario, nomeUsuario, dataNascimentoUsuario, emailUsuario, senhaUsuario, cpfUsuario) 
    VALUES ('G', '$nome_gerenciador',  '$data_nascimento', '$email_gerenciador', '$crip', $cpf_gerenciador);"; 

    $result_gerenciador = mysqli_query($conn, $sqlInsert); 

    
    
    //PARA TESTAR E VER SE OCORREU ALGUM ERRO    
        if (mysqli_error($conn)) {
            $_SESSION['mensagem_erro']= "Ocorreu um erro ao tentar cadastrar.";
        header('location: pagina_cadastro_gerenciador.php');
            die();  

    
        } else {

        $_SESSION['usuario_logado'] = "'$email_gerenciador'";
        header('location: pagina_inicial_gerenciador.php');
        die();  

        } 
    }

    mysqli_close($conn);
    
    ?>

</body>

</html>
