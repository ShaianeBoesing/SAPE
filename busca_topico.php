<?php

    session_start();
    include 'conexao.php';

    $sqlBuscaTopico = "SELECT * FROM topico WHERE idConteudo= ".$_POST["idConteudo"]." ORDER BY nomeTopico";
    $result = mysqli_query($conn, $sqlBuscaTopico);
    echo '<option class="dropdown-item" type="button" id="item-dropdown-selecione" value="Selecione" selected>Selecione</option>';
    
   while ($dados = mysqli_fetch_array($result)){

        echo '<option class="dropdown-item" type="button" id="item-dropdown-selecione" value='. $dados["idTopico"].'>' . $dados["nomeTopico"]. '</option>';
    }

    
?>
