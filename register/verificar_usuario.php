<?php 
include('../assets/conn.php');

if (!empty($_POST['nomeUsuario'])) {
    $nomeUsuario = $_POST['nomeUsuario'];

    $sql = "SELECT login_usuario FROM usuario WHERE login_usuario = '" . $nomeUsuario . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "existe";
    } else {
        echo "não existe";
    }
}
?>
