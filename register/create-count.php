<?php
require_once('../assets/admin/removeCaracteres.php');

define('SITE_KEY', '6Lej9YQnAAAAAI-WaaoBibElxKPAMLup27pKDTvU');
define('SECRET_KEY', '6Lej9YQnAAAAAJ3IO6bfTbVWCKNmiJ0rKJyldn8a');

// Atribuir true se a página possui SSL, senão atribui false
define('POSSUI_SSL', false);

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados['register'])) {
     // Iniciar o CURL
     $curl = curl_init();
     var_dump($dados['g-recaptcha-response']);
     // Enviar a requisição
     curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify?secret=". SECRET_KEY . "&response=" . $dados['g-recaptcha-response']);
 
     // Ativar ou desativar a verificação do SSL
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, POSSUI_SSL);
 
     // Utilizado CURLOPT_RETURNTRANSFER para esperar a resposta da URL
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
     // Executar solicitação de curl
     $resposta = curl_exec($curl);
 
     // Fecha uma sessão cURL e libera todos os recursos
     curl_close($curl);
 
     //var_dump($resposta);
 
     // Converter em objeto
     $dados_recaptcha = json_decode($resposta);
    
    if ($dados_recaptcha->success) {
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
    }
}

?>