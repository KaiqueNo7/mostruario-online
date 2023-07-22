<?php 
include('../conn.php'); 
include("removeCaracteres.php");

if(!empty($_POST['id_produto'])){
    $sql = "SELECT login_usuario FROM usuario WHERE id_usuario = " . $_POST['id_usuario'];
    $rs = $conn->query($sql);

    if($row = $rs->fetch_assoc()){
        $loginUsuario = $row['login_usuario'];
    }

    $id_produto = $_POST['id_produto'];

    $sql = "DELETE FROM produto WHERE id_produto = " . $id_produto;
    $conn->query($sql);

    if(!empty($_POST['id_img'])) { $id_img = $_POST['id_img']; } else { $id_img = ""; }
    
    $dir = "../../$loginUsuario/img/00" . $id_produto;
    $arquivo = "../../$loginUsuario/img/00" . $id_produto . "/00" . $id_img . ".jpg";

    if (file_exists($arquivo)) {
        if (unlink($arquivo)) {
            //Sucess
        } else {
            setcookie("error", "O arquivo não encontrado!", time() + 60, "/");
            header("Location: index.php");
            exit();
        }
    } else {
        setcookie("error", "O diretorio não encontrado!", time() + 60, "/");
        header("Location: index.php");
        exit();
    }

    if (is_dir($dir)) {
        if (rmdir($dir)) {
            $sql = "DELETE FROM img WHERE id_img  = " . $id_img;
            $conn->query($sql);
           
        } else {
            setcookie("error", "O arquivo não encontrado!", time() + 60, "/");
            header("Location: index.php");
            exit();
        }
    } else {
        setcookie("error", "O diretorio não encontrado!", time() + 60, "/");
        header("Location: index.php");
        exit();
    }

    setcookie("deletado", "O arquivo foi encontrado!", time() + 60, "/");
    header("Location: index.php");
    exit();
}

if(!empty($_POST['id_categoria'])){
    
    $sql = "SELECT login_usuario FROM usuario WHERE id_usuario = " . $_POST['id_usuario'];
    $rs = $conn->query($sql);
    if($row = $rs->fetch_assoc()){
        $loginUsuario = $row['login_usuario'];
    }

    $id_categoria = $_POST['id_categoria'];

    $sql = "SELECT nome_categoria"
        ." FROM categoria "
        ." WHERE id_categoria = " . $id_categoria;
    $rs = $conn->query($sql);

    if($row = $rs->fetch_assoc()){
        $nome_categoria = strtolower(removeCaracteresEspeciais($row['nome_categoria']));
    } else {
        setcookie("error", "O diretorio não existe!", time() + 60, "/");
        exit();
    }

    $sql = "SELECT id_produto FROM produto WHERE id_categoria = " . $id_categoria;
    $rs = $conn->query($sql);

    while($row = $rs->fetch_assoc()){
        $sql = "DELETE FROM produto WHERE id_produto = " . $row['id_produto'];
        $conn->query($sql);
    }

    $sql = "DELETE FROM categoria WHERE id_categoria = " . $id_categoria;
    $conn->query($sql);

    $deleteProducts = "../../$loginUsuario/$nome_categoria/products.php";

    if (file_exists($deleteProducts)) {
        if (unlink($deleteProducts)) {
            //Sucesso
        } else {
            setcookie("error", "O arquivo não existe!", time() + 60, "/");
            header("Location: index.php");
            exit();
        }
    } else {
        setcookie("error", "O diretorio não existe!", time() + 60, "/");
        header("Location: index.php");
        exit();
    }

    $deleteIndex = "../../$loginUsuario/$nome_categoria/index.php";

    if (file_exists($deleteIndex)) {
        if (unlink($deleteIndex)) {
           //Sucesso
        } else {
            setcookie("error", "O arquivo não existe!", time() + 60, "/");
            header("Location: index.php");
            exit();
        }
    } else {
        setcookie("error", "O diretorio não existe!", time() + 60, "/");
        header("Location: index.php");
        exit();
    }

    if(!empty($_POST['id_img'])) { $id_img = $_POST['id_img']; } else { $id_img = ""; }

    $capaCategoria = "../../$loginUsuario/$nome_categoria/00$id_img.jpg";

    if (file_exists($capaCategoria)) {
        if (unlink($capaCategoria)) {
            //Sucesso
        } else {
            setcookie("error", "O arquivo não existe!", time() + 60, "/");
            header("Location: index.php");
            exit();
        }
    } else {
        setcookie("error", "O diretorio não existe!", time() + 60, "/");
        header("Location: index.php");
        exit();
    }

    $dir = "../../$loginUsuario/$nome_categoria";

    if (is_dir($dir)) {
        if (rmdir($dir)) {

            setcookie("deletado", "O arquivo foi deletado!", time() + 60, "/");

            header("Location: index.php");
        } else {
            setcookie("error", "O arquivo não existe!", time() + 60, "/");

            header("Location: index.php");
        }
    } else {
        setcookie("error", "O diretorio não existe!", time() + 60, "/");

        header("Location: index.php");
    }
}




?>