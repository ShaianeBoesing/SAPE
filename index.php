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

        <?php
        session_start();
        include_once("conexao.php");    
        
        if ( isset($_SESSION['usuario_logado']) ) {
           $_SESSION['usuario_logado'] = '';        }
    
        

        ?>

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
                    <form method="POST" action="processa_acesso.php">
                        <div class="formulario">

                            <label for="email" id="label-email" class="label-inputs"> E-mail</label> <br />
                            <input type="email" name="email" class="btn btn-outline-info" id="email">
                            <label for="senha" id="label-senha" class="label-inputs"> Senha </label> <br />
                            <input type="password" name="senha" class="btn btn-outline-info" id="senha">
                            <input type="submit" class="btn btn-info" id="enviar" name="enviar" value="Entrar">
                            <p id="cadastre"> <a href="pagina_cadastro_estudante" id="cadastrese"> ou cadastre-se </a></p>
                        </div>
                        <p id="mensagem">
                            <?php if(isset($_SESSION['mensagem_erro'])){ 
                                echo $_SESSION['mensagem_erro'];
                                unset ($_SESSION['mensagem_erro']);
                            }?>
                        </p>
                    </form>
                </div>
            </div>
        </div>



        <div class="texto">
            <div class="row row_corpo">
                <div class="col-sm-1"></div>
                <div class="col-sm-12 corpo1">
                    <h1> JUNTE-SE AO SAPE E SEJA O PRÓXIMO APROVADO! </h1>
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
                    <p class="texto-rodape"> <b>Gerenciador</b></p>
                    <p class="texto-rodape gerenciador"> <a href="pagina_chave_acesso_gerenciador.php">Novo Gerenciador? Cadastre-se aqui</a> </p>

                </div>


            </div>
        </div>


    </body>

    </html>
