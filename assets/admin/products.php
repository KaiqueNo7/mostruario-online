<?php
include('../../assets/conn.php'); 
$ordenarPor = "";

if(!empty($_POST['ordenarPor'])){
    $ordenarPor = $_POST['ordenarPor'];
    $id_categoria = $_POST['id_categoria'];
}

$sql = "SELECT i.id_img, p.id_produto, p.nome_produto, p.descricao_produto, p.preco_produto, p.id_categoria, p.peso_produto, p.tamanho_produto, p.tipagem_produto"
    ." FROM produto p"
    ." LEFT JOIN img i ON p.id_produto = i.id_objeto"
    ." WHERE id_categoria = " . $id_categoria;

    switch ($ordenarPor) {
        case 'novos':
          $sql .= " ORDER BY date_create DESC";
          break;
        case 'antigos':
          $sql .= " ORDER BY date_create ASC";
          break;
        case 'menoresPrecos':
          $sql .= " ORDER BY preco_produto ASC";
          break;
        case 'maioresPrecos':
          $sql .= " ORDER BY preco_produto DESC";
          break;
        default:
          $sql .= " ORDER BY id_produto DESC";
          break;
      }

$rs = $conn->query($sql);

while($row = $rs->fetch_assoc()){
print "<div class='card-2'>";
    print "<div class='img8x'>";
        print "<img src='../img/00" . $row['id_produto'] . "/00" . $row['id_img'] . ".jpg'>";
        print "<ul class='action'>";
            print "<li>";
                print "<label for='amei'>";
                    print "<input type='checkbox' name='' id='amei'>";
                    print "<i class='fa fa-heart' aria-hidden='true'></i>";
                print "</label>";
                print "<span>Amei</span>";
            print "</li>";
        print "</ul>";
    print "</div>";
    print "<div class='conteudo'>";
        print "<div class='w100 js-start al-start column'>";
            print "<h3>" . $row['nome_produto'] . "</h3>";
            print "<p class='m5-0'>" . $row['descricao_produto'] . "</p>";
        print "</div>";
        print "<div class='w100 js-btw al-center'>";
            print "<p class='price'>R$ " . number_format($row['preco_produto'], 2, ',', '.') . "</p>";
        print "</div>";
    print "</div>";
print "</div>";
}
    ?>