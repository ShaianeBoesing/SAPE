$(document).ready(function () {

    $('#botao_cadastrar_prova').click(Enviar);

})



// ------------------------ NOME ----------------------------

function verificaNomeProva() {


    var nome = $('#input-nome-prova').val().trim();
    var tamanhoNome = nome.length;

    if (tamanhoNome > 0) {
        $('#mensagem-erro-nome').html('')
        return true;
    } else {
        $('#mensagem-erro-nome').html('Nome inválido');
        $('#mensagem-erro-nome').addClass('erro');
        $('.mensagem').html('');
        return false;
    }

}

// ------------------------ SIGLA ----------------------------

function verificaSiglaProva() {


    var sigla = $('#input-sigla-prova').val().trim();
    var tamanhoSigla = sigla.length;
    sigla = sigla.toUpperCase();


    if (tamanhoSigla > 0 && tamanhoSigla <= 20) {
        $('#mensagem-erro-sigla').html('');
        return true;
    } else {
        $('#mensagem-erro-sigla').html('Sigla inválida');
        $('#mensagem-erro-sigla').addClass('erro');
        $('.mensagem').html('');
        return false;
    }

}

// ------------------------ ANO ----------------------------

function verificaAnoProva() {


    var ano = $('#input-ano-prova').val().trim();
    var tamanhoAno = ano.length;


    if ((tamanhoAno == 4) && (isNaN(ano) == false)) {
        $('#mensagem-erro-sigla').html('');
        return true;
    } else {
        $('#mensagem-erro-ano').html('Ano inválido');
        $('#mensagem-erro-ano').addClass('erro');
        $('.mensagem').html('');
        return false;
    }

}

// ------------------------ BOTÃO ENVIAR ----------------------------


function Enviar(e) {
    var nomeok = verificaNomeProva();
    var siglaok = verificaSiglaProva();
    var anook = verificaAnoProva();


    if (nomeok == false || siglaok == false || anook == false) {
        e.preventDefault(); // cancela a submissão do formulário  
    }
}
