$(document).ready(function () {

    $('#botao_cadastrar_area').click(Enviar);

})



// ------------------------ NOME ----------------------------

function verificaNomeArea() {


    var nome = $('#input-nome-area').val().trim();
    var tamanhoNome = nome.length;

    if (tamanhoNome > 0) {
        $('#mensagem-erro').html('');
        return true;
    } else {
        $('#mensagem-erro').html('Nome inválido');
        $('#mensagem-erro').addClass('erro');
        $('.mensagem').html('');

        return false;
    }

}

// ------------------------ BOTÃO ENVIAR ----------------------------


function Enviar(e) {
    var nomeok = verificaNomeArea();

    if (nomeok == false) {
        e.preventDefault(); // cancela a submissão do formulário  
    }
}
