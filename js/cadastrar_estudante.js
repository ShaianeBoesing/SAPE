$(document).ready(function () {

    $('#botao_cadastrar_estudante').click(Enviar);

})



// ------------------------ NOME ----------------------------


function verificaNomeEstudante() {

    var soma = 0;
    var nome = $('#input-nome-estudante').val().trim();
    var tamanhoNome = nome.length;
    var posicaoEspacoBranco = nome.indexOf(" ");

    if (tamanhoNome > 0) {

        $('#mensagem-erro-nome').html('');
        $('#mensagem-erro-nome').removeClass('erro');
        soma++;
    } else {

        $('#mensagem-erro-nome').html('Informe seu nome');
        $('#mensagem-erro-nome').addClass('erro');
    }

    if (soma == 1) {
        if (posicaoEspacoBranco > 0) {
            $('#mensagem-erro-nome').html('');
            $('#mensagem-erro-nome').removeClass('erro');
            soma++;
        } else {
            $('#mensagem-erro-nome').html('Informe seu sobrenome');
            $('#mensagem-erro-nome').addClass('erro');

        }
    }


    if (soma == 2) {
        return true;
    } else {
        $('.mensagem').html('');
        return false;
    }

}

// ------------------------ GÊNERO ----------------------------


function verificaGenero() {

    var genero = $("#select-genero :checked").val();

    //alert (alternativaCorreta);

    if (genero == undefined) {
        $('#mensagem-erro-genero').html('Selecione um gênero');
        $('#mensagem-erro-genero').addClass('erro');
        $('.mensagem').html('');
        return false;

    } else {

        $('#mensagem-erro-genero').html('');
        $('#mensagem-erro-genero').removeClass('erro');
        return true;

    }
}


// ------------------------ DATA DE NASCIMENTO  ----------------------------

function verificaData() {
    var data = $("#date-input").val(); // pega o valor do input
    data = data.replace(/\//g, "-"); // substitui eventuais barras (ex. IE) "/" por hífen "-"
    var data_array = data.split("-"); // quebra a data em array

    // para o IE onde será inserido no formato dd/MM/yyyy
    if (data_array[0].length != 4) {
        data = data_array[2] + "-" + data_array[1] + "-" + data_array[0]; // remonto a data no formato yyyy/MM/dd
    }

    // comparo a data informada com o data atual
    if (data == "undefined-undefined-") {
        $('#mensagem-erro-data').html('Informe uma data');
        $('#mensagem-erro-data').addClass('erro');
        $('.mensagem').html('');
        return false;
        
    } else if (new Date(data) > new Date()) {
        $('#mensagem-erro-data').html('Data inválida');
        $('#mensagem-erro-data').addClass('erro');
        $('.mensagem').html('');
        return false;
        
    } else {
        $('#mensagem-erro-data').html('');
        $('#mensagem-erro-data').removeClass('erro');
        return true;

    }
}

// ------------------------ EMAIL ----------------------------


function verificaEmail() {


    var email = $('#input-email-estudante').val().trim();
    var tamanhoEmail = email.length;
    var posicaoArroba = email.indexOf("@");
    var posicaoPonto = email.lastIndexOf(".");
    var minusculas = email.toLowerCase();

    if (tamanhoEmail > 0) {

        if ((posicaoArroba >= 0) && (posicaoPonto > posicaoArroba)) {

            $('#mensagem-erro-email').html('');
            $('#mensagem-erro-email').removeClass('erro');
            return true;

        } else {

            $('#mensagem-erro-email').html('Email inválido');
            $('#mensagem-erro-email').addClass('erro');
            $('.mensagem').html('');
            return false;


        }

    } else {
        $('#mensagem-erro-email').html('Informe o e-mail');
        $('#mensagem-erro-email').addClass('erro');
        $('.mensagem').html('');
        return false;
    }




}

// ------------------------ SENHA ----------------------------


function verificaSenha() {


    var email = $('#input-senha-estudante').val().trim();
    var tamanhoSenha = email.length;

    if (tamanhoSenha < 6 && tamanhoSenha != 0) {

        $('#mensagem-erro-senha').html('Senha muito curta');
        $('#mensagem-erro-senha').addClass('erro');
        $('.mensagem').html('');
        return false;

    } else if (tamanhoSenha == 0) {

        $('#mensagem-erro-senha').html('Informe uma senha');
        $('#mensagem-erro-senha').addClass('erro');
        $('.mensagem').html('');
        return false;

    } else {

        $('#mensagem-erro-senha').html('');
        $('#mensagem-erro-senha').removeClass('erro');
        return true;

    }

}



// ------------------------ BOTÃO ENVIAR ----------------------------


function Enviar(e) {
    var nomeok = verificaNomeEstudante();
    var generook = verificaGenero();
    var dataok = verificaData();
    var emailok = verificaEmail();
    var senhaok = verificaSenha();

    if (nomeok == false || generook == false || dataok == false || emailok == false || senhaok == false) {
        e.preventDefault(); // cancela a submissão do formulário  
    }
}
