<!DOCTYPE html>
<html>
<?php 

$urlCompleta = $_SERVER['REQUEST_URI'];
$ultimoComponente = basename($urlCompleta);
$usuario = pathinfo($ultimoComponente, PATHINFO_FILENAME);

include('../assets/conn.php');

$sql = " SELECT id_usuario, nome_loja FROM usuario WHERE login_usuario ='" . $usuario . "'";
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
if($row){
	$id_usuario = $row['id_usuario'];
	$nome_loja = $row['nome_loja'];
};

include("../assets/admin/removeCaracteres.php");

?>	
<head>	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mostruário Online - <?php print $nome_loja ?></title>
	<meta name="description" content="Monstruário Online">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" href="../img/icon.ico">
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
</head>
<body class="bg">
<header>
	<ul class="menu-desktop">
		<li>MOSTRUÁRIO ONLINE - <?php print $nome_loja ?></li>
	</ul>
</header>
<section class="w100 vh100 wrap js-start al-start p20 g20">
	<?php
	$sql = "SELECT c.id_categoria, c.nome_categoria, c.descricao_categoria, i.id_img"
		." FROM categoria c"
		." LEFT JOIN img i ON c.id_categoria = i.id_objeto" 
		." WHERE id_usuario = " . $id_usuario;
	$rs = $conn->query($sql);

	while($row = $rs->fetch_assoc()){
		print "<div class='category'>";
			print "<div class='img8x'>";
				print "<img src='" . removeCaracteresEspeciais($row['nome_categoria']) . "/00" . $row['id_img'] . ".jpg'>";
			print "</div>";
			print "<div class='text-c p20'>";
					print "<a href='" . removeCaracteresEspeciais($row['nome_categoria']) . "'>" . $row['nome_categoria'] . "</a>";
			print "</div>";
		print "</div>";
	}
	?>
</section>
<footer class="js-center al-center text-c w100 p20">
    <p>© <?php print date('Y') . " MOSTRUÁRIO ONLINE - $nome_loja"; ?> | Todos os direitos reservados.</p>
</footer>
<script type="text/javascript">
    window.addEventListener("scroll", function(){
        var header = document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
    })
</script>
</body>
</html>