<?php 
include('../conn.php');

if(!empty($_POST['id_produto'])){
    $id_produto = $_POST['id_produto'];

    $sql = "SELECT  i.id_img, p.id_produto, p.nome_produto, p.descricao_produto, p.preco_produto, p.id_categoria, p.peso_produto, p.tamanho_produto, p.tipagem_produto"
    ." FROM produto p"
    ." LEFT JOIN img i ON p.id_produto = i.id_objeto"
    ." WHERE p.id_produto = " . $id_produto;
    $rs = $conn->query($sql);

    if($row = $rs->fetch_assoc()){
        $id_produto = $row['id_produto'];
        $id_img = $row['id_img'];
        $nome_produto = $row['nome_produto'];
        $descricao_produto = $row['descricao_produto']; 
        $preco_produto = number_format($row['preco_produto'], 2, ',', '.'); 
        $id_categoria = $row['id_categoria']; 
        $peso_produto = number_format($row['peso_produto'], 1); 
        $tamanho_produto = $row['tamanho_produto']; 
        $tipagem_produto = $row['tipagem_produto']; 
    }

    $response = array(
        'id_produto' => $id_produto,
        'id_img' => $id_img,
        'nome_produto' => $nome_produto,
        'descricao_produto' => $descricao_produto,
        'preco_produto' => $preco_produto,
        'id_categoria' => $id_categoria,
        'peso_produto' => $peso_produto,
        'tamanho_produto' => $tamanho_produto,
        'tipagem_produto' => $tipagem_produto
    );

    print json_encode($response);
}

if(!empty($_POST['id_categoria'])){
    $id_categoria = $_POST['id_categoria'];

    $sql = "SELECT c.id_categoria, c.nome_categoria, c.descricao_categoria, c.apresentacao, c.numero_parcelas, i.id_img "
    ." FROM categoria c"
    ." LEFT JOIN img i ON c.id_categoria = i.id_objeto"
    ." WHERE id_categoria = " . $id_categoria;
    $rs = $conn->query($sql);

    if($row = $rs->fetch_assoc()){
        $id_categoria = $row['id_categoria'];
        $nome_categoria = $row['nome_categoria'];
        $descricao_categoria = $row['descricao_categoria'];
        $apresentacao = $row['apresentacao'];
        $numero_parcelas = $row['numero_parcelas'];
        $id_img = $row['id_img']; 
    }

    $response = array(
        'id_categoria' => $id_categoria,
        'nome_categoria' => $nome_categoria,
        'descricao_categoria' => $descricao_categoria,
        'apresentacao' => $apresentacao,
        'numero_parcelas' => $numero_parcelas,
        'id_img' => $id_img
    );

    print json_encode($response);
}


?>