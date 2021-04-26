<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> SAPE - Cadastro de Jornada </title>

    <?php
    session_start();
    include_once("conexao.php");    
    ?>
</head>

<body>



    <!-- -------------------------------------------------------------- -->
    <?php
    
    /*  PEGANDO VALORES ATRAVÉS DO CAMPO NAME DO HTML */
    $numero_dias = $_POST['dias-jornada']; //campo name do html -- traz o numero de dias
    $numero_questoes = $_POST['questoes-jornada']; //campo name do html -- traz o numero de questoes
    $email_estudante = $_SESSION['usuario_logado'];
    
    $sqlBuscaEstudante = "SELECT idUsuario FROM usuario WHERE emailUsuario = $email_estudante";
    $resultBusca = mysqli_query($conn, $sqlBuscaEstudante); 
    $dados = mysqli_fetch_assoc($resultBusca); 
    $idEstudante = $dados['idUsuario']; // traz o nome da área do banco de dados.



    if(!empty($_POST['area']) && count($_POST['area']) ){
    $areas_selecionadas = implode(',', $_POST['area']);

    //ENVIANDO OS DADOS
    $sql = "INSERT INTO jornada (dataAtual, areaJornada, diasSemana, questoesRoteiro, emailEstudante, idUsuario) VALUES ( NOW(), '$areas_selecionadas', $numero_dias, $numero_questoes, $email_estudante, $idEstudante )";
    $resultInsert= mysqli_query($conn, $sql); 

        
    }

    
    
    //PARA TESTAR E VER SE OCORREU ALGUM ERRO    
    if (mysqli_error($conn)) {
        

//        $erro = mysqli_error($conn);    
    
    } else {
          
          echo"<script language='javascript' type='text/javascript'>
          location.href='pagina_inicial_estudante.php'</script>";
          $sqlResgataIdJornada = "SELECT idJornada FROM jornada WHERE idUsuario = $idEstudante";
          $resultSelect = mysqli_query($conn, $sqlResgataIdJornada);
          $dado = mysqli_fetch_assoc($resultSelect);
          $idJornada = $dado["idJornada"];
          $_SESSION['idJornada']= $idJornada;
        
        
        include("gera_roteiros.php");

    } 

    mysqli_close($conn);
    
    ?>

</body>

</html>
