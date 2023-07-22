$('.del').click(function() {
    const id_produto = event.currentTarget.getAttribute('data-id');
    const id_img = event.currentTarget.getAttribute('img');
    const id_usuario = event.currentTarget.getAttribute('user-id');

    const buttonConfirm = document.getElementById('btnDelProduto');

    $(buttonConfirm).attr('data-id',id_produto);
    $(buttonConfirm).attr('img',id_img);
    $(buttonConfirm).attr('user-id',id_usuario);
    
    const elemento = document.getElementById('confirmDelProduto');
    elemento.classList.add('active');
});

$('.del-ok').click(function() {
    const id_produto = event.currentTarget.getAttribute('data-id');
    const id_img = event.currentTarget.getAttribute('img');
    const id_usuario = event.currentTarget.getAttribute('user-id');

    $.ajax({
        url: '../../assets/admin/del.php',
        type: 'POST',
        data: { 
            id_produto: id_produto, 
            id_img: id_img,
            id_usuario: id_usuario
        },
        success: function(response) {
            window.location.reload(true);
        },
    });
});

$('.del-categoria').click(function() {
    const category = event.currentTarget.getAttribute('data-id');
    const imgCategory = event.currentTarget.getAttribute('img');
    const id_usuario = event.currentTarget.getAttribute('user-id');

    const buttonConfirm = document.getElementById('confirm');

    $(buttonConfirm).attr('data-id',category);
    $(buttonConfirm).attr('img',imgCategory);
    $(buttonConfirm).attr('user-id',id_usuario);
    
    const elemento = document.getElementById('confirmDelCategoria');
    elemento.classList.add('active');
});

$('.cancel').click(function() {
    const elemento = document.getElementById('confirmDelCategoria');
    elemento.classList.remove('active');
});

$('.del-categoria-ok').click(function() {    
    const category = event.currentTarget.getAttribute('data-id');
    const imgCategory = event.currentTarget.getAttribute('img');
    const id_usuario = event.currentTarget.getAttribute('user-id');
    const cardImg = "img" + imgCategory;
    const alertDelete = document.getElementById('alert-delete');   

    $.ajax({
        url: '../../assets/admin/del.php',
        type: 'POST',
        data: { 
            id_categoria: category, 
            id_img: imgCategory,
            id_usuario: id_usuario
        },
        success: function(response) {
            window.location.reload(true);
        },
    });
    
});