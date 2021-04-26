<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Acessar sistema </title>

    <!---------------------------CSS--------------------------->
    <link rel="stylesheet" type="text/css" href="css/pagina_cadastro_estudante.css">

    <!--------------------------JQUERY------------------------------------>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js'></script>

    <!---------------------------JS----------------------------->

    <?php
        session_start();
        include_once("conexao.php");    
    ?>

</head>

<body>



    <!-- -------------------------------------------------------------- -->
    <?php

    
    /*  PEGANDO VALORES ATRAVÉS DO CAMPO NAME DO HTML */
    $email = $_POST["email"]; //campo name do html -- traz o email do gerenciador
    $senha = $_POST["senha"]; //campo name do html -- traz a senha do gerenciador
    
    if (($email != "") && ($senha !="")){
        
    
    
    /* VERIFICANDO SE O ESTUDANTE JÁ ESTÁ CADASTRADA */
    $sqlVerifica= "SELECT * FROM usuario WHERE emailUsuario = '$email';";
    $result = mysqli_query($conn, $sqlVerifica);
    $linhasAfetadas = mysqli_affected_rows($conn);
        
    $dados = mysqli_fetch_assoc($result);
    $tipo_usuario = $dados['tipoUsuario']; // traz o nome da área do banco de dados.

//    echo $sqlVerificaEstudante;

    if ($linhasAfetadas > 0 ){
        
        $result = mysqli_query($conn, $sqlVerifica); 
        $dados = mysqli_fetch_assoc($result); 
        $senha_bd = $dados['senhaUsuario']; // traz a senha do usuario.

        if (md5($senha) == $senha_bd){
            
           if ($tipo_usuario == "G") {
 
                $_SESSION['usuario_logado']= "'$email'";
                header('location: pagina_inicial_gerenciador.php');
               
           }else if ($tipo_usuario == "E")  {

                $_SESSION['usuario_logado']= "'$email'";

                $sqlBuscaIdUsuario = "SELECT idUsuario FROM usuario WHERE emailUsuario='$email'";
                $resultBuscaIdUsuario = mysqli_query($conn, $sqlBuscaIdUsuario);
                $dadosBuscaIdUsuario = mysqli_fetch_assoc($resultBuscaIdUsuario);
                $idUsuario = $dadosBuscaIdUsuario["idUsuario"];

               $sqlBuscaJornada = "SELECT idJornada FROM jornada WHERE idUsuario=$idUsuario";
                $resultBuscaJornada = mysqli_query($conn, $sqlBuscaJornada);
                $linhasAfetadasBuscaJornada = mysqli_affected_rows($conn);
               
                if ($linhasAfetadasBuscaJornada > 0){
                    $dadosBuscaJornada = mysqli_fetch_assoc($resultBuscaJornada);
                    $idJornada = $dadosBuscaJornada["idJornada"];
                    $_SESSION['idJornada']= $idJornada;
                } 
            
                header('location: pagina_inicial_estudante.php');                           


           }
        die();  

        } else {
            $_SESSION['mensagem_erro']= "O e-mail ou a senha estão incorretos.";
            echo "<script language='javascript'>history.back()</script>";
            die();                
        }
    
    } else {
    
         $_SESSION['mensagem_erro']= "Não existe uma conta cadastrada neste endereço de e-mail";
        echo "<script language='javascript'>history.back()</script>";
        die();                

    }
    } else {
        $_SESSION['mensagem_erro']= "Informe o email e a senha.";
        echo "<script language='javascript'>history.back()</script>";
        die();                

    }

    mysqli_close($conn);
    
    ?>

</body>

</html>
