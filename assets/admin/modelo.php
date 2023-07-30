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

$sql = " SELECT id_categoria, nome_categoria, apresentacao FROM categoria WHERE nome_categoria ='" . str_replace("-", " ", $nome_categoria) . "' AND id_usuario = " . $id_usuario;
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
if($row){
	$id_categoria = $row['id_categoria'];
	$nome_categoria = $row['nome_categoria'];
    $apresentacao = $row['apresentacao'];
};

$sql = "SELECT COUNT(*) as produto FROM produto WHERE id_categoria = " . $id_categoria;
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
if($row){
	$produto = $row['produto'];
};
?>
<!DOCTYPE html>
<html lang='pt-br'>
<?php $raiz = "../../"; include('../../head.php'); ?>
<body class="bg">
<header class="w100 js-btw al-center p20">
    <p class="w80 text-l titlle"><?php print $nome_loja . " - " . $nome_categoria; ?></p>
	<a class="w20 text-r link" href="https://mostruario.online/<?php print $usuario;?>">Voltar</a>
</header>
<section class="vh100 w100 js-start al-center column">
    
    <div class="w100 js-center al-center p20">
    <?php if(!empty($produto)){ ?>
        <label>Ordenar por:</label>
        <select id="filter" name="filter" class="filter">
            <option value="novos">Mais novos</option>
            <option value="antigos">Mais antigos</option>
            <?php if($apresentacao != '1'){ ?>
                <option   option value="menoresPrecos">Menores preços</option>
                <option value="maioresPrecos">Maiores preços</option>
            <?php } else { ?>
                <option value="menoresPecos">Menores pesos</option>
                <option value="maioresPecos">Maiores pesos</option>
            <?php } ?>
        </select>
        <?php } else { print "<p>Ainda não há produtos para essa categoria :(</p>"; }?>
    </div>
   
    <div class="w100 wrap al-start p20 g20" id="resultados">
        <?php include('products.php'); ?>
    </div>
    
</section>
<footer class="js-center al-center text-c w100 p20">
    <p>© <?php print date('Y') . " MOSTRUÁRIO ONLINE - $nome_loja"; ?> | Todos os direitos reservados.</p>
</footer>
<script src="../../js/jquery-min.js"></script>
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

        // Adiciona o evento de clique à imagem
        $('.img8x').click(function() {
            $(this).toggleClass('zoom');
        });
    });

    window.addEventListener("scroll", function(){
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
    });

    
</script>
</body>
</htlm>
