<?php 

session_start();
include_once("conexao.php");    

if (isset($_POST['salvar'])){

    $idUsuario= $_POST["id_estudante"];
    
    $nomeUsuario= $_POST["nome_estudante"];
    $generoUsuario = $_POST["genero"]; // vai passar o id da area da matéria
    $dataNascimento= $_POST["data_nascimento"]; // vai passar o id da area da matéria
    $emailUsuario = $_POST["email_estudante"];
    
        
    $sqlVerifica = "SELECT emailUsuario FROM usuario WHERE idUsuario = '$idUsuario';";
        
    mysqli_query($conn, $sqlVerifica);
    $linhasAfetadas = mysqli_affected_rows($conn);

    if ($linhasAfetadas == 0){
        
        echo"<script language='javascript' type='text/javascript'>
          location.href='pagina_edita_estudante.php'
          </script>";
        die();                

    } else { 
            
            $sql_atualiza_estudante="UPDATE usuario SET nomeUsuario='$nomeUsuario', generoUsuario = '$generoUsuario', dataNascimentoUsuario='$dataNascimento', emailUsuario='$emailUsuario' WHERE idUsuario=$idUsuario;";
            echo $sql_atualiza_estudante;
            $result_estudante = mysqli_query($conn, $sql_atualiza_estudante); 
            
            
            if ($result_estudante) {
                
                $_SESSION['usuario_logado'] = "'$emailUsuario'";
               
                echo "<script language='javascript' type='text/javascript'>
                location.href='pagina_estudante.php'</script>";
            } else {
                
                echo "<script language='javascript' type='text/javascript'>
                location.href='pagina_estudante.php'</script>";
            }
    }
}

?>
