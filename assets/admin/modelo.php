<?php 
include('../../assets/conn.php'); 

$urlCompleta = $_SERVER['REQUEST_URI'];
$penultimoComponente = basename(dirname($urlCompleta));
$usuario = pathinfo($penultimoComponente, PATHINFO_FILENAME);

$sql = " SELECT id_usuario, nome_loja FROM usuario WHERE login_usuario ='" . $usuario . "'";
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
if($row){
	$id_usuario = $row['id_usuario'];
	$nome_loja = $row['nome_loja'];
};

$ultimoComponente = basename($urlCompleta);
$nome_categoria = pathinfo($ultimoComponente, PATHINFO_FILENAME);

$sql = " SELECT id_categoria, nome_categoria FROM categoria WHERE nome_categoria ='" . $nome_categoria . "' AND id_usuario = " . $id_usuario;
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
if($row){
	$id_categoria = $row['id_categoria'];
	$nome_categoria = $row['nome_categoria'];
};
?>
<!DOCTYPE html>
<html>
<?php $raiz = "../../"; include('../../head.php'); ?>
<body class="bg">
<header class="w100 js-btw al-center p20">
    <p class="w80 text-l titlle"><?php print $nome_loja . " - " . $nome_categoria; ?></p>
	<a class="w20 text-r link" href="https://mostruario.online/<?php print $usuario;?>">Voltar</a>
</header>
<section class="vh100 w100 js-start al-center column">
    <div class="w100 js-center al-center p20">
        <label>Ordenar por:</label>
        <select id="filter" name="filter" class="filter">
            <option value="novos">Mais novos</option>
            <option value="antigos">Mais antigos</option>
            <option value="menoresPrecos">Menores preços</option>
            <option value="maioresPrecos">Maiores preços</option>
        </select>
    </div>
    <div class="w100 wrap al-start p20 g20" id="resultados">
        <?php include('products.php'); ?>
    </div>
    
</section>
<footer class="js-center al-center text-c w100 p20">
    <p>© <?php print date('Y') . " MOSTRUÁRIO ONLINE - $nome_loja"; ?> | Todos os direitos reservados.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#filter').change(function() {
            var opcaoSelecionada = $(this).val();
            console.log(opcaoSelecionada);
            $.ajax({
            url: 'products.php',
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
    })
</script>
</body>
</htlm>
