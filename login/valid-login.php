<?php 
if(!empty($_POST['login'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT id_usuario, login_usuario, senha_usuario "
            . " FROM usuario "
            . " WHERE login_usuario = '" . $usuario . "'"
            . " AND senha_usuario = PASSWORD('" . $password . "')";
    $rs = $conn->query($sql);

    if($row = $rs->fetch_assoc()){
        session_start();
        
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['login_usuario'] = $row['login_usuario'];
        $_SESSION['logged_in'] = true;
        
        header("Location: " . $row['login_usuario'] . "/admin");
        exit();
    } else {
        return false;
        $alert = "Senha incorreta";
    }
}
?>