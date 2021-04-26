<?php
    session_start();
    include_once("conexao.php");    



    $email_usuario = $_SESSION['usuario_logado'];
echo $email_usuario . "<br>";
    $sqlBuscaIdUsuario = "SELECT idUsuario FROM usuario WHERE emailUsuario = $email_usuario";
echo $sqlBuscaIdUsuario . "<br>";
    $resultBuscaIdUsuario = mysqli_query($conn, $sqlBuscaIdUsuario);
    $dadosBuscaIdUsuario = mysqli_fetch_assoc($resultBuscaIdUsuario);
    $idUsuario = $dadosBuscaIdUsuario["idUsuario"];
echo $idUsuario . "<br>";
    
    //VARIVEIS
    $alternativaEscolhida = '';
    
    $quantidadeQuestao = $_POST["quantidadeQuestoes"];
echo $quantidadeQuestao . "<br>";
    $idRoteiro = $_POST["idRoteiro"];
echo $idRoteiro. "<br>";
            
    for ($i=1; $i<=$quantidadeQuestao; $i++){
        
        $alternativaSelecionada = "alternativaSelecionada$i";
echo $alternativaSelecionada. "<br>";
        $alternativaCorreta = "alternativaCorreta$i";
echo $alternativaCorreta. "<br>";
        $idQuest = "idQuestao$i";
        $alternativaEscolhida = $_POST["$alternativaSelecionada"];
echo $alternativaEscolhida. "<br>";
        $idQuestao = $_POST["$idQuest"]; 
echo $idQuestao. "<br>";
        $alternativaCerta = $_POST["$alternativaCorreta"];
echo $alternativaCerta. "<br>";
        
        if ($alternativaEscolhida == $alternativaCerta){
            
            // alterar a tabela de roteiro e mandar CERTO 
            $sqlEnviaResposta = "UPDATE roteiro SET roteiroRespondido=TRUE, horaDataRespostaRoteiro=now(), acertoErroRoteiro=TRUE, alternativaEscolhida='$alternativaEscolhida' WHERE idRoteiro=$idRoteiro AND idQuestao=$idQuestao";
            $resultEnviaResposta = mysqli_query($conn, $sqlEnviaResposta);

            echo $sqlEnviaResposta. "<br>";
            include('pagina_visualizar_roteiro?idRoteiro='.$idRoteiro.'.php');
            header('location: pagina_visualizar_roteiro?idRoteiro='.$idRoteiro);



        } else {

                    
            //alterar a tabela de roteiro e mandar ERRADO 
            $sqlEnviaResposta = "UPDATE roteiro SET roteiroRespondido=TRUE, horaDataRespostaRoteiro=now(), acertoErroRoteiro=FALSE, alternativaEscolhida='$alternativaEscolhida' WHERE idRoteiro=$idRoteiro AND idQuestao=$idQuestao";
            $resultEnviaResposta = mysqli_query($conn, $sqlEnviaResposta);
            
            echo $sqlEnviaResposta;
//            include('pagina_visualiza_desempenho');
            include('pagina_visualizar_roteiro?idRoteiro='.$idRoteiro.'.php');
            header('location: pagina_visualizar_roteiro?idRoteiro='.$idRoteiro);

        } 


    }
        
        
    mysqli_close($conn);
    
    ?>
