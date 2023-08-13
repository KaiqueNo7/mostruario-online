<?php
include('../../assets/conn.php'); 
$ordenarPor = "";

if(!empty($_POST['ordenarPor'])){
    $ordenarPor = $_POST['ordenarPor'];
    $id_categoria = $_POST['id_categoria'];
}

$sql = "SELECT i.id_img, p.id_produto, p.nome_produto, p.descricao_produto, p.preco_produto, p.id_categoria, p.peso_produto, c.apresentacao, c.numero_parcelas"
    ." FROM produto p"
    ." LEFT JOIN img i ON p.id_produto = i.id_objeto"
    ." LEFT JOIN categoria c ON p.id_categoria = c.id_categoria"
    ." WHERE p.id_categoria = " . $id_categoria;

    switch ($ordenarPor) {
        case 'novos':
          $sql .= " ORDER BY p.date_create DESC";
          break;
        case 'antigos':
          $sql .= " ORDER BY p.date_create ASC";
          break;
        case 'menoresPrecos':
          $sql .= " ORDER BY preco_produto ASC";
          break;
        case 'maioresPrecos':
          $sql .= " ORDER BY preco_produto DESC";
          break;
        case 'menoresPecos':
          $sql .= " ORDER BY peso_produto ASC";
          break; 
        case 'maioresPecos':
          $sql .= " ORDER BY peso_produto DESC";
          break;     
        default:
          $sql .= " ORDER BY id_produto DESC";
          break;
      }

$rs = $conn->query($sql);
$i = 1;
while($row = $rs->fetch_assoc()){
echo "<div class='card-apresetation w24'>";
    echo "<div class='img8x' data-modal='modal$i'>";
        echo "<img src='../img/00" . $row['id_produto'] . "/00" . $row['id_img'] . ".jpg'>";
    echo "</div>";
    echo "<div class='conteudo'>";
        echo "<div class='w100 js-start al-start column'>";
            echo "<h3>" . $row['nome_produto'] . "</h3>";
            echo "<p class='m5-0'>" . $row['descricao_produto'] . "</p>";
        echo "</div>";
        echo "<div class='w100 js-btw al-center'>";
            switch($row['apresentacao']){
                case '1':
                echo "<p>" . number_format($row['peso_produto'], 1) . "</p>";
                break;
                case '2':
                echo "<p>R$ " . number_format($row['preco_produto'], 2, ',', '.') . "</p>";
                break;
                case '3':
                $valor = $row['preco_produto'] / $row['numero_parcelas'];

                echo "<p>" . $row['numero_parcelas'] . "x de R$ " . number_format($valor, 2, ',', '.') . "</p>";
                break;
                case '4':

                break;
                default: 
                echo "<p>R$ " . number_format($row['preco_produto'], 2, ',', '.') . "</p>";
            }
        echo "</div>";
    echo "</div>";
echo "</div>";

echo "<div class='modal' id='modal$i'>";
  echo "<span class='close-modal'><i class='fa-solid fa-xmark'></i></span>";
  echo "<div class='modal-content'>";
      echo "<img src='../img/00" . $row['id_produto'] . "/00" . $row['id_img'] . ".jpg'>";
  echo "</div>";
echo "</div>";

$i++;
}
    ?>