<?php 

session_start();
include_once("conexao.php");

$email_usuario = $_SESSION['usuario_logado']; //variavel que carrega o email do usuário logado

if ( empty($_SESSION['usuario_logado']) ) {
    echo "<script>alert('Você precisa estar logado');";
    echo "javascript:window.location='index.php';</script>";

} else {
    
    $email_usuario = $_SESSION['usuario_logado'];
    $sql =  "SELECT idUsuario FROM usuario WHERE emailUsuario = $email_usuario;";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);
    $id_usuario = $dados['idUsuario']; // traz o tipo de usuário do banco de dados.
}

/* VARIAVEIS */
$numeroQuestoes = 0; //contador que vai distribuindo um numero de valor pelo array de questões
$areasQuestoes = []; // array (matriz) que armazena todas as áreas e o número de questões que cada área terá num roteiro
$areaQuestao = []; // separa a área e seu respectivo número de questão em um array individual
$valorAreaQuestao = []; // separa a área e seu respectivo número de questão em um array individual
$idArea = '';
$idQuestao = '';
$cont = 0;
$contador = 0;
$counter = 0;
$semana = 0;

// TRAZENDO DADOS DA JORNADA    
$idJornada = $_SESSION['idJornada'];
$sqlBuscaJornada = "SELECT * FROM jornada WHERE idJornada = $idJornada;";
$result = mysqli_query($conn, $sqlBuscaJornada);
$dados = mysqli_fetch_array($result);
$areas = $dados['areaJornada'];
$diasSemana = $dados['diasSemana'];
$questoesRoteiro = $dados['questoesRoteiro'];


// CALCULANDO QUANTAS SEMANAS SERÃO

$totalSemanas = ceil(250/($diasSemana*$questoesRoteiro));

echo "TOTAL DE SEMANAS: ".$totalSemanas . "<br>";

//TRANSFORMANDO O DADO tipo String 'areaJornada' EM UM ARRAY
$arrayArea = explode(",", $areas);


//ATRIBUINDO UM NUMERO DE QUESTÕES PRA CADA AREA SELECIONADA DE ACORDO COM O NÚMERO DE QUESTÕES MAXIMO SELECIONADO
for ($i=0; $i<$questoesRoteiro; $i){
    
    $numeroQuestoes++;
    
    for($j=0; $j<sizeof($arrayArea); $j++){
        
        $areasQuestoes[$j] = array($arrayArea[$j],$numeroQuestoes);
        $i++;        

        if ($i == $questoesRoteiro){
            break;
        }   

    }

}


    
    for($k=0; $k<$totalSemanas; $k++){
        
        $cont = 0;
        $contador = 0;
        $counter = 0;
    
        $semana++;
        echo "SEMANA: ".$semana . "<br>";
        

                    for($y=0; $y<$diasSemana; $y++){

            echo " <br> ROTEIRO: ".$y . "<br>";

            $counter = 0;

        

            //PEGA O VALOR DO INDICE 0 DO ARRAY (ID DAS ÁREAS SELECIONADAS) areasQuestoes E PASSA O VALOR PARA UM ARRAY areaQuestao QUE ARMAZENA.
            foreach($areasQuestoes as $indice) {

                $areaQuestao[$cont] = ( 
                    $indice[0]  //area
                );       

                $cont ++;
            }

            //PEGA O VALOR DO INDICE 1 DO ARRAY (NÚMERO DE QUESTÕES QUE SERÁ SELECIONADO PELA ÁREA) areasQuestoes E PASSA O VALOR PARA UM ARRAY areaQuestao QUE ARMAZENA.
            foreach($areasQuestoes as $indice) {

                $valorAreaQuestao[$contador] = (
                    $indice[1] //valor  
                );

                $contador ++;        
            }
        

                
                
            //BUSCA AS QUESTÕES NO BANCO DE DADOS QUESTÃO DE ACORDO COM O ID DA ÁREA E DE ACORDO COM O NÚMERO DE QUESTÕES ATRIBUIDOS A ESTA. 
            $sqlIdNovoRoteiro = "INSERT INTO sequencia(id) values (null)";
            $resultadoIdNovoRoteiro = mysqli_query($conn, $sqlIdNovoRoteiro);
            $codigo = mysqli_insert_id($conn);

        
                        
                

            while ($counter < sizeof($arrayArea)) {
                


                $sqlBuscaQuestoes = "SELECT idQuestao, idArea FROM questao WHERE idQuestao NOT IN (SELECT idQuestao FROM roteiro WHERE idArea=$areaQuestao[$counter] AND idJornada=$idJornada) AND idArea=$areaQuestao[$counter] ORDER BY rand() LIMIT $valorAreaQuestao[$counter];";


                $resultadoBuscaQuestoes = mysqli_query($conn, $sqlBuscaQuestoes);

                while($dadosBuscaQuestoes = mysqli_fetch_assoc($resultadoBuscaQuestoes)){ 

                    $idArea = $dadosBuscaQuestoes['idArea'];
                    $idQuestao = $dadosBuscaQuestoes['idQuestao'];

                    //AQUI VAI SER INSERIDO CADA ROTEIRO                    
                    $sqlInsertRoteiro = "INSERT INTO roteiro (idRoteiro, idQuestao, roteiroRespondido, semana, idArea, idJornada, idUsuario) VALUE ($codigo, $idQuestao, FALSE, $semana, $idArea, $idJornada, $id_usuario);";
                    $resultInsert = mysqli_query($conn, $sqlInsertRoteiro);
                    echo $sqlInsertRoteiro . "<br>";
                } 

                $counter ++;
            }
        
            }

    }
?>
