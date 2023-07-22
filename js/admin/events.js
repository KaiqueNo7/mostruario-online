const openMenu = document.getElementById("openMenu");
const menu = document.getElementById("menu");

openMenu.addEventListener("click", function() {
    menu.classList.toggle("active");
});

const close = document.getElementById('close');

close.addEventListener("click", function() {
    popup.classList.toggle('active');
});

const closeCategory = document.getElementById('closeCategory');

closeCategory.addEventListener("click", function() {
    ppCategory.classList.toggle('active');
});


const controlPriceBtn = document.getElementById('controlPrice');
const controlPriceForm = document.getElementById('controlPriceForm');

controlPriceBtn.addEventListener("click", function() {
    controlPriceForm.classList.toggle('active');
});

const closeControlPrice = document.getElementById("closeControlPrice");

closeControlPrice.addEventListener("click", function(){
    controlPriceForm.classList.remove('active');
});

const imagemProduto = document.getElementById('imagemProduto');
const filleProduto = document.getElementById('arquivoImg');

imagemProduto.addEventListener('change', function() {
    if (this.files.length > 0) {
        const fileName = this.files[0].name;
        filleProduto.textContent = '' + fileName;
    } else {
        filleProduto.textContent = '';
    }
});

const imagemCategoria = document.getElementById('imagemCategoria');
const filleCategoria = document.getElementById('arquivoImgCategoria');

imagemCategoria.addEventListener('change', function() {
    if (this.files.length > 0) {
        const fileName = this.files[0].name;
        filleCategoria.textContent = '' + fileName;
    } else {
        filleCategoria.textContent = '';
    }
});

window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
});

$(document).ready(function() {
    $('#copyTheLink').click(function() {
        // Obter o valor do input type hidden
        const textoParaCopiar = $('#linkDoUsuario').val();
    
        // Copiar o texto para a área de transferência
        copiarTexto(textoParaCopiar);

        // Substituir o texto da div por "copiado"
        $('#copiedMessage').text('Copiado');

        // Após 3 segundos, limpar a mensagem "copiado"
        setTimeout(function() {
        $('#copiedMessage').text('Copiar link');
        }, 3000);
      });
  });
  
  function copiarTexto(texto) {
    const elementoTemp = $('<textarea>');
    elementoTemp.val(texto);
    $('body').append(elementoTemp);
    elementoTemp.select();
    document.execCommand('copy');
    elementoTemp.remove();
  }
  