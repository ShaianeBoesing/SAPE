$(document).ready(function () {

    $('#botao_cadastrar_conteudo').click(Enviar);

})



// ------------------------ NOME ----------------------------

function verificaNomeConteudo() {


    var nome = $('#input-nome-conteudo').val().trim();
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

// ------------------------ MATÉRIA ----------------------------

function verificaMateriaConteudo() {

    // obtendo o valor do atributo value da tag option
    var valorEscolhido = $("#select-dropdown-materia-conteudo").val();

    if (valorEscolhido == "selecione") {
        $('#mensagem-erro-materia').html('Selecione uma matéria');
        $('#mensagem-erro-materia').addClass('erro');
        $('.mensagem').html('');
        return false;
    } else {
        $('#mensagem-erro-materia').html('');
        return true;
    }

}

// ------------------------ LINK ----------------------------

function verificaLinkConteudo() {

    var link = $('#input-link-conteudo').val();
    var tamanhoLink = link.length;

    if (tamanhoLink > 0) {
        $('#mensagem-erro-link').html('');
        return true;
    } else {
        $('#mensagem-erro-link').html('Informe um link');
        $('#mensagem-erro-link').addClass('erro');
        $('.mensagem').html('');
        return false;
    }

}

// ------------------------ BOTÃO ENVIAR ----------------------------


function Enviar(e) {
    var nomeok = verificaNomeConteudo();
    var materiaok = verificaMateriaConteudo();
    var linkok = verificaLinkConteudo();

    if (nomeok == false || materiaok == false || linkok == false) {
        e.preventDefault(); // cancela a submissão do formulário  
    }
}
