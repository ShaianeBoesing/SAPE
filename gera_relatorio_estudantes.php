<head>
    <?php

        session_start();
        include_once("conexao.php");    
    
?>


</head>

<body>
    <?php 
    
        
    require_once __DIR__ . './mpdf/vendor/autoload.php';
    
    $sql = "SELECT * FROM usuario WHERE tipoUsuario='E' ORDER BY nomeUsuario ASC;";
    $html = "<img src='images/sape-logo.png' id='logotipo' style='width:20%'>
    
    <h2 style='font-family:sans-serif' id='titulo'> Relatório de Estudantes </h2>
    
    <table style='font-family:sans-serif'>
    <thead>
    <tr>
    <th scope='col' style='width:100px'>#</th>
    <th scope='col'  style='width:200px'>Nome</th>
    <th scope='col'  style='width:200px'>Data de Nascimento</th>
    <th scope='col'  style='width:100px'>E-mail</th>
    <th scope='col'  style='width:100px'>Gênero</th>
    </tr>            
    </thead>
    <tbody>";

    date_default_timezone_set('America/Sao_Paulo');

    $agora = date('d/m/Y H:i');

    $resultado_array[]=array();
    $resultado = mysqli_query($conn, $sql);
    while ($dados = $resultado->fetch_assoc()){
        $data = $dados['dataNascimentoUsuario'];
        $dataForm = date('d/m/Y', strtotime($data));


        $html .= "<tr> 
                  <td>".$dados['idUsuario']."</td>
                  <td>".$dados['nomeUsuario']."</td>
                  <td>".$dataForm."</td>
                  <td>".$dados['emailUsuario']."</td>
                  <td>".$dados['generoUsuario']."</td>
                  </tr>
                  ";
    }
    $html .= "</tbody> </table> <p> Relatório gerado em ".$agora."</p>
    
    ";
    
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetDisplayMode('fullpage');
    $css = file_get_contents('css/pagina_visualizar_relatorio.css');
    $mpdf->WriteHTML($css, 1);
    $mpdf->WriteHTML($html);
    $mpdf->Output();

?>
</body>
