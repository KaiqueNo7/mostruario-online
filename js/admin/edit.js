const buttons = document.querySelectorAll('.edit');

buttons.forEach(function (button) {
    button.addEventListener('click', function (event) {
        const id_categoria = event.currentTarget.getAttribute('data-id');

        popup.classList.toggle('active');
        
        $.ajax({
            url: '../../assets/admin/edit.php',
            type: 'POST',
            data: { id_produto: id_categoria },
            dataType: 'json',
            success: function(response) {
                const id_produto = response.id_produto;
                const id_img = response.id_img;
                const nome_produto = response.nome_produto;
                const descricao_produto = response.descricao_produto;
                const preco_produto = response.preco_produto;
                const id_categoria = response.id_categoria;
                const peso_produto = response.peso_produto;
                const tamanho_produto = response.tamanho_produto;
                const tipagem_produto = response.tipagem_produto;
                
                $('#id_produto').val(id_produto);
                $('#id_img').val(id_img);
                $('#nome_produto').val(nome_produto);
                $('#descricao_produto').val(descricao_produto);
                $('#preco_produto').val(preco_produto);
                $('#id_categoria').val(id_categoria);
                $('#preco_produto').val(preco_produto);
                $('#peso_produto').val(peso_produto);
                $('#tamanho_produto').val(tamanho_produto);
                $('#tipagem_produto').val(tipagem_produto);
                $('#imagemProduto').removeAttr('required'); 

                $('#incluir_produto').html('Editar');
                $('#incluir_produto').val('edita_produto');
                $('#incluir_produto').attr('name','edita_produto');
            }
        });
    });
});

const editCategoria = document.querySelectorAll('.edit-categoria');

editCategoria.forEach(function (category) {
    category.addEventListener('click', function (event) {
        const id_categoria = event.currentTarget.getAttribute('data-id');

        ppCategory.classList.toggle('active');
        
        $.ajax({
            url: '../../assets/admin/edit.php',
            type: 'POST',
            data: { id_categoria: id_categoria },
            dataType: 'json',
            success: function(response) {
                const inputText = $('#toggleSelect');

                const id_category = response.id_categoria;
                const id_img_categoria = response.id_img;
                const nome_categoria = response.nome_categoria;
                const descricao_categoria = response.descricao_categoria;
                const apresentacao = response.apresentacao;
                const numero_parcelas = response.numero_parcelas;
                
                $('#id_category').val(id_category);
                $('#id_img_categoria').val(id_img_categoria);
                $('#nome_categoria').val(nome_categoria);
                $('#descricao_categoria').val(descricao_categoria);
                $('#apresentacao').val(apresentacao);
                $('#numero_parcelas').val(numero_parcelas);
                $('#imagemCategoria').removeAttr('required'); 
                
     
                if(apresentacao == 3){
                    inputText.show();
                } else {
                    inputText.hide();
                }

                $('#incluir_categoria').html('Editar');
                $('#incluir_categoria').val('edita_categoria');
                $('#incluir_categoria').attr('name','edita_categoria');
                
            }
        });
    });
});