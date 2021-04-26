<?php

    session_start();
    include 'conexao.php';

    $sqlBuscaConteudo = "SELECT * FROM conteudo WHERE idMateria= ".$_POST["idMateria"]." ORDER BY nomeConteudo";
    $result = mysqli_query($conn, $sqlBuscaConteudo);
    echo '<option class="dropdown-item" type="button" id="item-dropdown-selecione" value="Selecione" selected>Selecione</option>';
    
   while ($dados = mysqli_fetch_array($result)){

        echo '<option class="dropdown-item" type="button" id="item-dropdown-selecione" value='. $dados["idConteudo"].'>' . $dados["nomeConteudo"]. '</option>';
    }

    
?>


