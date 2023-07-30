$(document).ready(function() {
    $('#filter').change(function() {
        var opcaoSelecionada = $(this).val();
        console.log(opcaoSelecionada);
        $.ajax({
        url: "../../assets/admin/products.php",
        type: 'POST',
        data: { 
            ordenarPor: opcaoSelecionada,
            id_categoria: <?php echo $id_categoria; ?>
        },
        success: function(response) {
            $('#resultados').html(response);
        },
        error: function(xhr, status, error) {
            console.log('Erro na solicitação AJAX');
        }
        });
    });
});

window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
});