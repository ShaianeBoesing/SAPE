    <!DOCTYPE html>
    <html>

    <head>
        <!--   GERAL       -->
        <meta charset="UTF-8">
        <title>SAPE - Sistema de Auxílio e Planejamento de Estudos</title>
        <link rel="icon" href="images/sape-logo-icon.png" class="img-responsive pull-right" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--    CSS    -->
        <link rel="stylesheet" href="css/root.css">
        <link rel="stylesheet" href="css/navbar_index.css">
        <link rel="stylesheet" href="css/index.css">

        <!--    BIBLIOTECAS BOOTSTRAP   -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="Jquery/jquery-3.5.1.min.js"></script>
        <script src="bootstrap/js/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>


    </head>

    <body>

        <!--    CABEÇALHO DO SITE -->
        <div class="div_cabecalho">
            <div class="row row_cabecalho">
                <div class="col-sm-6 cabecalho">
                    <div class="div_logotipo">
                        <a href="index.php" id="link_logotipo">
                            <img src="images/sape-logo.png" id="logotipo">
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 cabecalho">
                    <form method="POST" action="processa_chave_gerenciador">

                        <div class="formulario">
                            <h3 id="titulo_chave"> Chave de acesso </h3>
                            <input type="text" name="chave" class="btn btn-outline-info" id="chave" placeholder="Digite sua chave de acesso">
                            <input type="submit" class="btn btn-info" id="continuar" name="continuar" value="Continuar">

                        </div>
                    </form>

                </div>

            </div>
        </div>



        <div class="texto">
            <div class="row row_corpo">
                <div class="col-sm-1"></div>
                <div class="col-sm-9 corpo1">
                    <h1> BEM VINDO AO SAPE! </h1>
                </div>
            </div>
        </div>


        <!--    RODAPÉ DO SITE -->
        <div class="div_rodape">
            <div class="row rodape">
                <div class="col-sm-4 cabecalho">
                    <p class="texto-rodape" id="criadores"> <b> Criadores </b> </p>
                    <p class="texto-rodape criadores"> Shaiane Boesing Rodrigues Borges </p>
                </div>

                <div class="col-sm-4 cabecalho">
                    <p class="texto-rodape"> <b>Contato do Criador</b></p>
                    <p class="texto-rodape contato"> shaianeboesingrb@gmail.com</p>

                </div>
                <div class="col-sm-4 cabecalho">

                </div>


            </div>
        </div>




    </body>

    </html>
