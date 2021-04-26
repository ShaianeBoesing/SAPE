<?php

    session_start();
    include 'conexao.php';

    $sqlBuscaMateria = "SELECT * FROM materia WHERE idArea = ".$_POST["idArea"]." ORDER BY nomeMateria";
    $result = mysqli_query($conn, $sqlBuscaMateria);
    echo '<option class="dropdown-item" type="button" id="item-dropdown-selecione" value="Selecione" selected>Selecione</option>';
    
   while ($dados = mysqli_fetch_array($result)){

        echo '<option class="dropdown-item" type="button" id="item-dropdown-selecione" value='. $dados["idMateria"].'>' . $dados["nomeMateria"]. '</option>';
    }
    
//    $idArea= $_POST["idArea"];
//    $nomeProva= $_POST["nome_prova"];
//    $siglaProva= $_POST["sigla_prova"];
//    $anoProva= $_POST["ano_prova"];
    
    
?>
