<head>
    <?php

        session_start();
        include_once("conexao.php");    
    
?>


</head>

<body>
    <?php 
    
        
    require_once __DIR__ . './mpdf/vendor/autoload.php';
    
    $sql = "SELECT * FROM questao ORDER BY idQuestao ASC;";
    $html = "<img src='images/sape-logo.png' id='logotipo' style='width:20%'>
    
    <h2 style='font-family:sans-serif' id='titulo'> Relatório de Questões </h2>
    
    ";

    date_default_timezone_set('America/Sao_Paulo');

    $agora = date('d/m/Y H:i');

    $resultado_array[]=array();
    $resultado = mysqli_query($conn, $sql);
    while ($dados = $resultado->fetch_assoc()){

        $html .= "<table style='font-family:sans-serif'>
                  <thead>
                  <tr>
                  <th scope='col' style='width:200px'>Código</th>
                  <th scope='col' style='width:500px'>".$dados['idQuestao']."</th>
                  </tr>            
                  </thead>
                  <tbody>
                  <tr>    
                  <td> Enunciado </td>
                  <td>".$dados['enunciadoQuestao']."</td>
                  </tr> 
                  <tr>
                  <td> Alternativa A </td>
                  <td>". $dados['alternativaA']."</td>
                  </tr>
                  <tr>
                  <td> Alternativa B </td>
                  <td>". $dados['alternativaB']."</td>
                  </tr>
                  <tr>
                  <td> Alternativa C </td>
                  <td>". $dados['alternativaC']."</td>
                  </tr>
                  <tr>
                  <td> Alternativa D </td>
                  <td>". $dados['alternativaD']."</td>
                  </tr>
                  <tr>
                  <td> Alternativa E </td>
                  <td>". $dados['alternativaE']."</td>
                  </tr>
                  <tr>
                  <td> Alternativa Correta </td>
                  <td>". $dados['alternativaCorreta']."</td>
                  </tr>
                  <tr>
                  <td> Resolução </td>
                  <td>".$dados['resolucaoQuestao']."</td>
                  </tr>
                  <tr>
                  <td> Área do conhecimento </td>
                  <td>".$dados['areaQuestao']."</td>
                  </tr>
                  <tr>
                  <td> Matéria </td>
                  <td>".$dados['materiaQuestao']."</td>
                  </tr>
                  </tbody> 
                  </table>
                  ";
    }
    $html .= " <p> Relatório gerado em ".$agora."</p>
    
    ";
    
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetDisplayMode('fullpage');
    $css = file_get_contents('css/pagina_visualizar_relatorio.css');
    $mpdf->WriteHTML($css, 1);
    $mpdf->WriteHTML($html);
    $mpdf->Output();

?>
</body>
