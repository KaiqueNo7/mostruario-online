if (document.cookie.includes("error")) {
    const include = document.getElementById('alert-error');
    include.classList.add('show');
    include.classList.add('del');

    setTimeout(function() {
        include.classList.remove('show');
        include.classList.remove('del');
    }, 3000); 
    document.cookie = "error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

$(document).ready(function() {
    $('#confirm_password').on('input', function() {
        const senha = $('#password').val();
        const confirmarSenha = $('#confirm_password').val();
        const mensagemErro = $('#mensagemErro');

        if (senha !== confirmarSenha) {
        mensagemErro.show();
        $("#register").prop('disabled', true);
        } else {
        mensagemErro.hide();
        $("#register").prop('disabled', false);
        }
    });

    let delayTimer;
    const atraso = 500; 
    
    $('#usuario').on('input', function() {
        const nomeUsuario = $(this).val();
        const mensagemUsuario = $('#usuarioError');

        clearTimeout(delayTimer);

        delayTimer = setTimeout(function() {
        $.ajax({
            url: 'verificar_usuario.php', 
            type: 'POST',
            data: { nomeUsuario: nomeUsuario },
            success: function(response) {
            if (response === 'existe') {
                mensagemUsuario.show();
            } else {
                mensagemUsuario.hide();
            }
            }
        });
        }, atraso);
    });    
});

const maskNomeUsuario = document.getElementById('usuario');

maskNomeUsuario.addEventListener('input', function(event) {
    const valorDigitado = event.target.value;
    const regexApenasLetras = /[^a-zA-ZÀ-ÿÇç ]/g;

    if (regexApenasLetras.test(valorDigitado)) {
        event.target.value = valorDigitado.replace(regexApenasLetras, '');
    }
});

const maskNomeLoja = document.getElementById('nome_loja');

maskNomeLoja.addEventListener('input', function(event) {
    const valorDigitado = event.target.value;
    const regexApenasLetras = /[^a-zA-ZÀ-ÿÇç ]/g;

    if (regexApenasLetras.test(valorDigitado)) {
        event.target.value = valorDigitado.replace(regexApenasLetras, '');
    }
});





  
  