<!--
<?php
    session_start();
    include 'conexao.php';

  $numero_dias = $_POST['dias'];
  $numero_questoes_por_dia = $_POST['questoes'];

  $semanas = (250 / ($numero_dias * $numero_questoes_por_dia));

  echo $semanas;
    
    
?>
