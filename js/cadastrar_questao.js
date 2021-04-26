$(document).ready(function () {

    $('#botao-cadastrar-questao').click(Enviar);



})


// ------------------------ Select Dropdown PROVA  ----------------------------



function verificaProvaQuestao() {

    var falso = 0;


    // obtendo o valor do atributo value da tag option
    var prova = $("#select-dropdown-prova-questao").val();
    var area = $("#select-dropdown-area-questao").val();
    var materia = $("#select-dropdown-materia-questao").val();
    var conteudo = $("#select-dropdown-conteudo-questao").val();


    //PROVA
    if (prova == "Selecione") {
        $('#mensagem-erro-prova-questao').html('Selecione uma prova');
        $('#mensagem-erro-prova-questao').addClass('erro');
        $('#select-dropdown-prova-questao').removeClass('btn-info');
        $('#select-dropdown-prova-questao').addClass('btn-danger');

        falso += 1;
    } else {
        $('#mensagem-erro-prova-questao').html('');
        $('#select-dropdown-prova-questao').addClass('btn-info');
        $('#select-dropdown-prova-questao').removeClass('btn-danger');

    }

    //AREA
    if (area == "Selecione") {
        $('#mensagem-erro-area-questao').html('Selecione uma área');
        $('#mensagem-erro-area-questao').addClass('erro');
        $('#select-dropdown-area-questao').removeClass('btn-info');
        $('#select-dropdown-area-questao').addClass('btn-danger');

        falso += 1;
    } else {
        $('#mensagem-erro-area-questao').html('');
        $('#select-dropdown-area-questao').addClass('btn-info');
        $('#select-dropdown-area-questao').removeClass('btn-danger');

    }

    //MATERIA
    if (materia == "Selecione") {
        $('#mensagem-erro-materia-questao').html('Selecione uma matéria');
        $('#mensagem-erro-materia-questao').addClass('erro');
        $('#select-dropdown-materia-questao').removeClass('btn-info');
        $('#select-dropdown-materia-questao').addClass('btn-danger');

        falso += 1;
    } else {
        $('#mensagem-erro-materia-questao').html('');
        $('#select-dropdown-materia-questao').addClass('btn-info');
        $('#select-dropdown-materia-questao').removeClass('btn-danger');

    }

    //CONTEUOD
    if (conteudo == "Selecione") {
        $('#mensagem-erro-conteudo-questao').html('Selecione um conteúdo');
        $('#mensagem-erro-conteudo-questao').addClass('erro');
        $('#select-dropdown-conteudo-questao').removeClass('btn-info');
        $('#select-dropdown-conteudo-questao').addClass('btn-danger');

        falso += 1;
    } else {
        $('#mensagem-erro-conteudo-questao').html('');
        $('#select-dropdown-conteudo-questao').addClass('btn-info');
        $('#select-dropdown-conteudo-questao').removeClass('btn-danger');

    }

    //TOPICO
    if (conteudo == "Selecione") {
        $('#mensagem-erro-topico-questao').html('Selecione um tópico');
        $('#mensagem-erro-topico-questao').addClass('erro');
        $('#select-dropdown-topico-questao').removeClass('btn-info');
        $('#select-dropdown-topico-questao').addClass('btn-danger');

        falso += 1;
        
    } else {
        $('#mensagem-erro-topico-questao').html('');
        $('#select-dropdown-topico-questao').addClass('btn-info');
        $('#select-dropdown-topico-questao').removeClass('btn-danger');

    }

    if (falso != 0) {
        $('.mensagem').html('');
        return false;
    } else {
        return true;
    }


}



// ------------------------ ENUNCIADO ----------------------------

function verificaEnunciadoQuestao() {


    var enunciado = $('#textarea-enunciado').val().trim();
    var tamanhoEnunciado = enunciado.length;

    if (tamanhoEnunciado > 0) {
        $('#mensagem-erro-enunciado').html('');
        return true;

    } else {
        $('#mensagem-erro-enunciado').html('Informe o enunciado da questão');
        $('#mensagem-erro-enunciado').addClass('erro');

        return false;
    }

}


// ------------------------ ALTERNATIVA  ----------------------------

function verificaAlternativa() {

    var falso = 0;
    // A
    var alternativaA = $('#textarea-alternativaA').val().trim();
    var tamanhoAlternativaA = alternativaA.length;

    if (tamanhoAlternativaA > 0) {
        $('#mensagem-erro-alternativaA').html('');

    } else {
        $('#mensagem-erro-alternativaA').html('Informe o texto da Alternativa A');
        $('#mensagem-erro-alternativaA').addClass('erro');
        falso += 1;
    }

    // B
    var alternativaB = $('#textarea-alternativaB').val().trim();
    var tamanhoAlternativaB = alternativaB.length;

    if (tamanhoAlternativaB > 0) {
        $('#mensagem-erro-alternativaB').html('');

    } else {
        $('#mensagem-erro-alternativaB').html('Informe o texto da Alternativa B');
        $('#mensagem-erro-alternativaB').addClass('erro');
        falso += 1;
    }

    // C
    var alternativaC = $('#textarea-alternativaC').val().trim();
    var tamanhoAlternativaC = alternativaC.length;

    if (tamanhoAlternativaC > 0) {
        $('#mensagem-erro-alternativaC').html('');

    } else {
        $('#mensagem-erro-alternativaC').html('Informe o texto da Alternativa C');
        $('#mensagem-erro-alternativaC').addClass('erro');
        falso += 1;
    }

    // D
    var alternativaD = $('#textarea-alternativaD').val().trim();
    var tamanhoAlternativaD = alternativaD.length;

    if (tamanhoAlternativaD > 0) {
        $('#mensagem-erro-alternativaD').html('');

    } else {
        $('#mensagem-erro-alternativaD').html('Informe o texto da Alternativa D');
        $('#mensagem-erro-alternativaD').addClass('erro');
        falso += 1;
    }

    // E
    var alternativaE = $('#textarea-alternativaE').val().trim();
    var tamanhoAlternativaE = alternativaE.length;

    if (tamanhoAlternativaE > 0) {
        $('#mensagem-erro-alternativaE').html('');

    } else {
        $('#mensagem-erro-alternativaE').html('Informe o texto da Alternativa E');
        $('#mensagem-erro-alternativaE').addClass('erro');
        falso += 1;
    }

    if (falso != 0) {
        return false;
    } else {
        return true;
    }

}

// ------------------------ ALTERNATIVA CORRETA -------------

function verificaAlternativaCorreta() {



    var alternativaCorreta = $("#select-alternativa-correta :checked").val();

    //alert (alternativaCorreta);

    if (alternativaCorreta == undefined) {
        $('#mensagem-erro-alternativaCorreta').html('Selecione uma alternativa');
        $('#mensagem-erro-alternativaCorreta').addClass('erro');

        return false;

    } else {

        $('#mensagem-erro-alternativaCorreta').html('');
        return true;

    }
}


// ------------------------ RESOLUÇÃO ----------------------------

function verificaResolucao() {

    var resolucao = $('#textarea-resolucao').val().trim();
    $('#textarea-resolucao').html(resolucao);
    var tamanhoResolucao = resolucao.length;

    if (tamanhoResolucao > 0) {
        $('#mensagem-erro-resolucao').html('');
        return true;

    } else {
        $('#mensagem-erro-resolucao').html('Informe a resolução da questão');
        $('#mensagem-erro-resolucao').addClass('erro');
        return false;
    }
}


// ------------------------ BOTÃO ENVIAR ----------------------------


function Enviar(e) {
    var enunciadook = verificaEnunciadoQuestao();
    var alternativaok = verificaAlternativa();
    var alternativaCorretaok = verificaAlternativaCorreta();
    var resolucaook = verificaResolucao();
    var provaquestaook = verificaProvaQuestao();

    if (enunciadook == false || alternativaok == false || alternativaCorretaok == false || resolucaook == false || provaquestaook == false) {
        e.preventDefault(); // cancela a submissão do formulário  
        $('#verifica-pagina').html('Verifique se todos os campos obrigatórios estão preenchidos');
        $('#verifica-pagina').addClass('erro');
    }

}
