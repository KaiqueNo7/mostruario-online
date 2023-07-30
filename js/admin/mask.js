$(document).ready(function() {
    $('#preco_produto').maskMoney({
        prefix: 'R$ ',
        groupSeparator: '.',
        radixPoint: ',',
        autoGroup: true,
        digits: 2,
        rightAlign: false,
        unmaskAsNumber: true
    });

    $('.percentage').maskMoney({
        prefix: '',
        suffix: '%',
        precision: 0,
        allowNegative: false,
        allowEmpty: true
    });  

    $('.decimal').maskMoney({
        thousands: '',
        decimal: '.',
        allowZero: true,
        precision: 1
    });

});

const maskNomeProduto = document.getElementById('nome_produto');

maskNomeProduto.addEventListener('input', function(event) {
    const valorDigitado = event.target.value;
    const regexApenasLetras = /[^a-zA-ZÀ-ÿÇç ]/g;

    if (regexApenasLetras.test(valorDigitado)) {
        event.target.value = valorDigitado.replace(regexApenasLetras, '');
    }
});

const maskDescricaoProduto = document.getElementById('descricao_produto');

maskDescricaoProduto.addEventListener('input', function(event) {
    const valorDigitado = event.target.value;
    const regexApenasLetras = /[^a-zA-ZÀ-ÿÇç ]/g;

    if (regexApenasLetras.test(valorDigitado)) {
        event.target.value = valorDigitado.replace(regexApenasLetras, '');
    }
});

const maskNomeCategoria = document.getElementById('nome_categoria');

maskNomeCategoria.addEventListener('input', function(event) {
    const valorDigitado = event.target.value;
    const regexApenasLetras = /[^a-zA-ZÀ-ÿÇç ]/g;

    if (regexApenasLetras.test(valorDigitado)) {
        event.target.value = valorDigitado.replace(regexApenasLetras, '');
    }
});

const maskDescricaoCategoria = document.getElementById('descricao_categoria');

maskDescricaoCategoria.addEventListener('input', function(event) {
    const valorDigitado = event.target.value;
    const regexApenasLetras = /[^a-zA-ZÀ-ÿÇç ]/g;

    if (regexApenasLetras.test(valorDigitado)) {
        event.target.value = valorDigitado.replace(regexApenasLetras, '');
    }
});