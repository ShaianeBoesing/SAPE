$(document).ready(function () {

    $('#botao_cadastrar_materia').click(Enviar);

})



// ------------------------ NOME ----------------------------

function verificaNomeMateria() {


    var nome = $('#input-nome-materia').val().trim();
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

// ------------------------ ÁREA ----------------------------

function verificaAreaMateria() {

    // obtendo o valor do atributo value da tag option
    var valorEscolhido = $("#select-dropdown-area-materia").val();

    if (valorEscolhido == "Selecione") {
        $('#mensagem-erro-area').html('Selecione uma área');
        $('#mensagem-erro-area').addClass('erro');
        $('.mensagem').html('');
        return false;
    } else {
        $('#mensagem-erro-area').html('');
        return true;
    }

}

// ------------------------ BOTÃO ENVIAR ----------------------------


function Enviar(e) {
    var nomeok = verificaNomeMateria();
    var areaok = verificaAreaMateria();

    if (nomeok == false || areaok == false) {
        e.preventDefault(); // cancela a submissão do formulário  
    }
}
