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
    <link rel="stylesheet" type="text/css" href="css/pagina_cadastro_materia.css">

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
    $nome_materia = $_POST["nome_materia"]; //campo name do html -- traz o nome da matéria que foi digitado
    $area_materia = $_POST["area_materia"]; //campo name do html -- traz o id da área que foi selecionada 
    
    
    $sql_nome_area = "SELECT nomeArea FROM area WHERE idArea = $area_materia;"; //busca a área pelo id
    $result = mysqli_query($conn, $sql_nome_area); 
    $dados = mysqli_fetch_assoc($result); 
    $nome_area = $dados['nomeArea']; // traz o nome da área do banco de dados.
    
    
    /* VERIFICANDO SE A MATÉRIA JÁ ESTÁ CADASTRADA */
    $sqlVerificaMateria= "SELECT nomeMateria FROM materia WHERE nomeMateria = '$nome_materia';";
    mysqli_query($conn, $sqlVerificaMateria);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas != 0){
        
        $_SESSION['mensagem_erro']= "Essa matéria já foi cadastrada.";
        echo "<script language='javascript'>history.back()</script>";
        die(); 
        
    } else {
        
    
        /*ENVIANDO OS DADOS INFORMADOS PARA BANCO DE DADOS*/
        $sqlInsert = "INSERT INTO materia ( nomeMateria, areaMateria, idArea) 
        VALUES ('$nome_materia', '$nome_area', $area_materia);"; 

        $result_prova = mysqli_query($conn, $sqlInsert); 

        if (mysqli_error($conn)) {

            $_SESSION['mensagem_erro']= "Ocorreu um erro ao cadastrar esta matéria.";
            echo "<script language='javascript'>history.back()</script>";
            die();                

            
        } else {
            
            $_SESSION['mensagem_acerto']= "Matéria cadastrada com sucesso.";
            header('location:pagina_cadastro_materia2.php');
            die();                


        } 
        
    }
    mysqli_close($conn);
    
    ?>

</body>

</html>
