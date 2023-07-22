const botao = document.getElementById("addProduct");
const popup = document.getElementById('pop-up');

botao.addEventListener("click", function() {
    popup.classList.toggle('active');

    $('#id_produto').val('');
    $('#id_img').val('');
    $('#nome_produto').val('');
    $('#descricao_produto').val('');
    $('#preco_produto').val('');
    $('#id_categoria').val('');
    $('#preco_produto').val('');
    $('#peso_produto').val('');
    $('#tamanho_produto').val('');
    $('#tipagem_produto').val('');
    

    $('#incluir_produto').html('Incluir');
    $('#incluir_produto').val('incluir_produto');
    $('#incluir_produto').attr('name','incluir_produto');
});

const openCategory = document.getElementById("addCategory");
const ppCategory = document.getElementById('pp-category');

openCategory.addEventListener("click", function() {
    ppCategory.classList.toggle('active');
    
    $('#id_category').val('');
    $('#id_img_categoria').val('');
    $('#nome_categoria').val('');
    $('#descricao_categoria').val('');
    $('#imagemCategoria').val('');
    
    $('#incluir_categoria').html('Incluir');
    $('#incluir_categoria').val('incluir_categoria');
    $('#incluir_categoria').attr('name','incluir_categoria');
});