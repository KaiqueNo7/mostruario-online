<?php
require_once('../assets/admin/removeCaracteres.php');
if (!empty($_POST['register'])) {
    $loginUsuario =  strtolower(removeCaracteresEspeciais($_POST['usuario']));
    $emailUsuario = $_POST['email'];
    $senhaUsuario = $_POST['password'];
    $nomeLoja = $_POST['nome_loja'];

    $sql = "INSERT INTO usuario (login_usuario, email_usuario, senha_usuario, plano_usuario, nome_loja)"
    . " VALUES ('$loginUsuario', '$emailUsuario', PASSWORD('$senhaUsuario'), 1, '$nomeLoja')";

    if ($conn->query($sql) === TRUE) {
 
        $diretorio = "../" . $loginUsuario;
        if (!is_dir($diretorio)) {
            if (mkdir($diretorio, 0777, true)) {
                echo "Diretório criado com sucesso.";

                $pastaImg = $diretorio . "/img";
                $pastaAdm = $diretorio . "/admin";
                if (!is_dir($pastaImg)) {
                    if (mkdir($pastaImg, 0777, true)) {
                       
                    } else {
                        setcookie("error", "Error ao criar pasta img", time() + 60, "/");

                        header("Location: https://mostruario.online/register");
                    }
                }

                if (!is_dir($pastaAdm)) {
                    if (mkdir($pastaAdm, 0777, true)) {
                       
                    } else {
                        setcookie("error", "Error ao criar pasta admin", time() + 60, "/");

                        header("Location: https://mostruario.online/register");
                    }
                }

                $diretorioIndex = $diretorio . "/index.php";
                $indexOrigem = "indexFolderClient/client.php";;
                $conteudo = file_get_contents($indexOrigem);
                file_put_contents($diretorioIndex, $conteudo);

                $diretorioAdminIndex = $diretorio . "/admin/index.php";
                $indexAdminOrigem = "indexFolderClient/admin.php";;
                $conteudoAdmin = file_get_contents($indexAdminOrigem);
                file_put_contents($diretorioAdminIndex, $conteudoAdmin);
                setcookie("sucesso", "Conta criada com sucesso!", time() + 60, "/");

                header("Location: https://mostruario.online");
            } else {
                setcookie("error", "Error ao criar pasta do usuário", time() + 60, "/");

                header("Location: https://mostruario.online/register");
            }
        }
    } else {
        setcookie("error", "Error ao criar conta", time() + 60, "/");

        header("Location: https://mostruario.online/register");
    }
}

?>