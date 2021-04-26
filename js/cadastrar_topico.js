$(document).ready(function () {

    $('#botao_cadastrar_topico').click(Enviar);

})



// ------------------------ NOME ----------------------------

function verificaNomeTopico() {


    var nome = $('#input-nome-topico').val().trim();
    var tamanhoNome = nome.length;

    if (tamanhoNome > 0) {
        $('#mensagem-erro-nome').html('');
        var nomeFormatado = ((nome[0].toUpperCase()) + ((nome.substr(1)).toLowerCase()));
        nome = nomeFormatado;
        return true;
    } else {
        $('#mensagem-erro-nome').html('Nome inválido');
        $('#mensagem-erro-nome').addClass('erro');
        $('.mensagem').html('');
        return false;
    }

}

// ------------------------ CONTEÚDO ----------------------------

function verificaConteudoTopico() {

    // obtendo o valor do atributo value da tag option
    var valorEscolhido = $("#select-dropdown-conteudo-topico option:selected").val();

    if (valorEscolhido == "selecione") {
        $('#mensagem-erro-conteudo').html('Selecione um conteúdo');
        $('#mensagem-erro-conteudo').addClass('erro');
        $('.mensagem').html('');

        return false;
    } else {
        $('#mensagem-erro-conteudo').html('');
        return true;
    }

}

// ------------------------ LINK ----------------------------

/* html verifica link */

// ------------------------ BOTÃO ENVIAR ----------------------------


function Enviar(e) {
    var nomeok = verificaNomeTopico();
    var conteudok = verificaConteudoTopico();

    if (nomeok == false || conteudok == false) {
        e.preventDefault(); // cancela a submissão do formulário  
    }
}
