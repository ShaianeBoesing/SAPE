<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Cadastro de Tópico </title>


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
    session_start();
    include_once("conexao.php");    


    /* PEGANDO VALORES ATRAVÉS DO CAMPO NAME DO HTML */
    $nome_topico = $_POST["nome_topico"]; //campo name do html -- traz o nome da matéria que foi digitado
    $conteudo_topico = $_POST["conteudo_topico"]; //campo name do html -- traz o id da área que foi selecionada
    $link_topico = $_POST["link_topico"]; //campo name do html -- traz o link do conteúdo que foi digitado


    $sql_nome_conteudo = "SELECT nomeConteudo FROM conteudo WHERE idConteudo = $conteudo_topico;"; //busca a o conteúdo pelo id
    $result = mysqli_query($conn, $sql_nome_conteudo);
    $dados = mysqli_fetch_assoc($result);
    $nome_conteudo = $dados['nomeConteudo']; // traz o nome da área do banco de dados.


    /* VERIFICANDO SE A MATÉRIA JÁ ESTÁ CADASTRADA */
    $sqlVerificaTopico= "SELECT nomeTopico FROM topico WHERE nomeTopico = '$nome_topico';";
    mysqli_query($conn, $sqlVerificaTopico);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas != 0){
        
        $_SESSION['mensagem_erro']= "Esse tópico já foi cadastrado.";
        echo "<script language='javascript'>history.back()</script>";
        die();
        
    } else {
        

        /*ENVIANDO OS DADOS INFORMADOS PARA BANCO DE DADOS*/
        $sqlInsert = "INSERT INTO topico ( nomeTopico, linkTopico, conteudoTopico, idConteudo)
        VALUES ('$nome_topico', '$link_topico', '$nome_conteudo', $conteudo_topico);";

        $result_topico = mysqli_query($conn, $sqlInsert);

        if (mysqli_error($conn)) {
            
            $_SESSION['mensagem_erro']= "Ocorreu um erro ao cadastrar este tópico.";
            echo "<script language='javascript'>history.back()</script>";
            die();                


        } else {
            
            $_SESSION['mensagem_acerto']= "Tópico cadastrado com sucesso.";
            header('location:pagina_cadastro_topico.php');
            die();                

        }
    }

    // if((mysqli_query($conn, $result_area)) == TRUE){
    //
    // exit();
    //
    // }else{
    //
    // echo "Erro " . $result_area . mysqli_error($conn);
    // }
    //
    mysqli_close($conn);

    ?>

</body>

</html>
