<?php 
    include("removeCaracteres.php");

    if(!empty($_POST['incluir_produto'])){
        if(!empty($_POST['descricao_produto'])){ $descricao_produto = "'" . $_POST['descricao_produto'] . "'"; } else { $descricao_produto = "null"; }
        if(!empty($_POST['preco_produto'])){ $preco_produto = "'" . str_replace("R$", "", str_replace(",", "", $_POST['preco_produto'])) . "'"; } else { $preco_produto = "null"; }
        if(!empty($_POST['peso_produto'])){ $peso = "'" . $_POST['peso_produto'] . "'"; } else { $peso = "null"; }

        $sql = "SELECT inserir_produto ( "
           . "'" . $_POST['nome_produto'] . "',"
           . "" . $descricao_produto . ","
           . "" . $preco_produto . ","
           . "" . $_POST['id_categoria'] . ","
           . "" . $peso . ","
           . "null,"
           . "null,"
           . "" . $_POST['id_usuario'] . ""
        .")";
        $rs = $conn->query($sql);

        if ($rs === FALSE) {
            setcookie("error", "Error ao incluir produto", time() + 60, "/");

            header("Location: index.php");
        } else {
            $row = $rs->fetch_row();
            $id_produto = $row[0];
            setcookie("ok", "Produto incluído!", time() + 60, "/");
        }

        $nomePasta = '00' . $id_produto; 
        $caminho = '../img/' . $nomePasta;

        if (!is_dir($caminho)) {
            if (mkdir($caminho, 0777, true)) {
                $status = "OK";
            } else {
                setcookie("error", "Error ao incluir produto", time() + 60, "/");

            header("Location: index.php");
            }
        } else {
            setcookie("error", "Error ao incluir produto", time() + 60, "/");

            header("Location: index.php");
        }

        if(!empty($status)){
            $nomeArquivo = $_FILES['imagem']['name'];
            $conteudoArquivo = $_FILES['imagem']['type'];
            $tamanhoArquivo = $_FILES['imagem']['size'];
    
            $sql = "SELECT inserir_img("
               . "" . $id_produto . ","
               . "1,"
               . "'" . $conteudoArquivo . "',"
               . "'" . $nomeArquivo . "'"
            .")";
    
            $rs = $conn->query($sql);
    
            if ($rs === FALSE) {
                // Error
            } else {
                $row = $rs->fetch_row();
                $id_img = $row[0];

                $diretorio = "../img/00" . $id_produto . "/";
    
                $nome_arquivo = "00" . $id_img . ".jpg";
        
                $caminho_arquivo = $diretorio . $nome_arquivo;    
                $conteudoArquivo = file_get_contents($_FILES['imagem']['tmp_name']);
                if (file_put_contents($caminho_arquivo, $conteudoArquivo) !== false) {
                    setcookie("ok", "Produto incluído!", time() + 60, "/");

                    header("Location: index.php");
                } else {
                    // Error
                }
            }
        }
    }

    if(!empty($_POST['edita_produto'])){
        if(!empty($_POST['descricao_produto'])){ $descricao_produto = "'" . $_POST['descricao_produto'] . "'";} else { $descricao_produto = "null"; }

        $id_produto = $_POST['id_produto'];
        $id_img = $_POST['id_img'];

        $sql = "UPDATE `produto` SET "
        . " `nome_produto`='" . $_POST['nome_produto'] . "',"
        . " `descricao_produto`=$descricao_produto,"
        . " `preco_produto`='" . str_replace("R$", "", str_replace(",", "", $_POST['preco_produto'])) . "',"
        . " `peso_produto`='" . $_POST['peso_produto'] . "',"
        . " `id_categoria`='" . $_POST['id_categoria'] . "'"
        . " WHERE id_produto = " . $id_produto;
   
        if($conn->query($sql) === TRUE){
            setcookie("sucesso", "Ação salva com sucesso!", time() + 60, "/");

        } else {
            setcookie("error", "Error ao editar produto", time() + 60, "/");

            header("Location: index.php");
        }

        if (isset($_FILES['imagem']) && $_FILES['imagem']["error"] == UPLOAD_ERR_OK){
            $nameArquivo = $_FILES['imagem']['name'];
            $tipoArquivo = $_FILES['imagem']['type'];
            $tamanhoArquivo = $_FILES['imagem']['size'];
        
            $sql = " UPDATE `img` SET "
            ." `tamanho_img`='" . $tamanhoArquivo . "',"
            ." `conteudo_img`='" . $tipoArquivo . "',"
            ." `nome_img`='" . $nameArquivo . "' "
            ." WHERE id_img = " . $id_img;

            if($conn->query($sql) === TRUE){
                $diretorio = "../img/00" . $id_produto . "/";

                $nome_arquivo = "00" . $id_img . ".jpg";

                $caminho_arquivo = $diretorio . $nome_arquivo;   
                $conteudoArquivo = file_get_contents($_FILES['imagem']['tmp_name']);
                if (file_put_contents($caminho_arquivo, $conteudoArquivo) !== false) {
                    setcookie("sucesso", "Ação salva com sucesso!", time() + 60, "/");

                    header("Location: index.php");
                } else {
                    print $conn->error;
                }
            } else {
                setcookie("error", "Error ao editar dados da imagem", time() + 60, "/");

                header("Location: index.php");
            }
        }

        header("Location: index.php");

    }

    if(!empty($_POST['edita_categoria'])){

        // Remover espaços em branco no início e fim do nome da categoria
        $nome_categoria = trim($_POST['nome_categoria']);

        // Verificar se o nome da categoria está vazio
        if (empty($nome_categoria)) {
            setcookie("error", "Nome da categoria não pode ser vazio!", time() + 60, "/");
            header("Location: index.php");
            exit(); // Encerra o script para evitar execução adicional
        }
        
        // Obter o nome atual da categoria
        $sql = "SELECT nome_categoria FROM categoria WHERE id_categoria = " . $_POST['id_categoria'];
        $rs = $conn->query($sql);
        $row = $rs->fetch_assoc();
        $nome_atual = trim($row['nome_categoria']);

        if ($nome_atual != $nome_categoria) {
            $sql = "SELECT COUNT(*) AS total_registros FROM categoria WHERE nome_categoria = '$nome_categoria' AND id_usuario = " . $_POST['id_usuario'];
            $rs = $conn->query($sql);
            $row = $rs->fetch_assoc();
            $total_registros = $row['total_registros'];

            if ($total_registros > 0) {
                setcookie("error", "Nome da categoria já existe!", time() + 60, "/");
                header("Location: index.php");
                exit(); 
            }
        }

        $id_categoria = $_POST['id_categoria'];
        $id_usuario = $_POST['id_usuario'];
        $id_img = $_POST['id_img'];
        $novoNome = strtolower(removeCaracteresEspeciais($_POST['nome_categoria']));

        $sql = "SELECT c.nome_categoria, u.login_usuario "
            ." FROM categoria c"
            ." LEFT JOIN usuario u ON c.id_usuario = u.id_usuario"
            ." WHERE c.id_categoria = " . $id_categoria;
        $rs = $conn->query($sql);

        if($row = $rs->fetch_assoc()){
            $nome_usuario = $row['login_usuario'];
            $pastaAntiga = strtolower(removeCaracteresEspeciais($row['nome_categoria']));
        } else {
            setcookie("error", "Error ao editar categoria", time() + 60, "/");
            header("Location: index.php");
            exit();
        }
            
        $diretorio = "../../" . $nome_usuario;
        $pastaAntiga = $diretorio . "/" . $pastaAntiga;
        $novoNome = $diretorio . "/" . $novoNome;
        
        if (is_dir($diretorio)) {
            if (is_dir($pastaAntiga)) {
                if (rename($pastaAntiga, $novoNome)) {
                    setcookie("sucesso", "Pasta criada com sucesso!", time() + 60, "/");
                } else {
                    setcookie("error", "Ocorreu um erro ao editar a pasta", time() + 60, "/");
                    header("Location: index.php");
                    exit();
                }
            } else {
                setcookie("error", "A pasta não", time() + 60, "/");
                header("Location: index.php");
                exit();
            }
        } else {
            setcookie("error", "A o diretorio não", time() + 60, "/");
            header("Location: index.php");
            exit();
        }

        $sql = "UPDATE `categoria` SET "
        . " `nome_categoria`='" . $_POST['nome_categoria'] . "',"
        . " `descricao_categoria`='" . $_POST['descricao_categoria'] . "',"
        . " `apresentacao`='" . $_POST['apresentacao'] . "',"
        . " `numero_parcelas`='" . $_POST['numero_parcelas'] . "'"
        . " WHERE id_categoria = " . $id_categoria
        . " AND id_usuario = " . $id_usuario;

        if($conn->query($sql) === TRUE){
            setcookie("sucesso", "Ação salva com sucesso!", time() + 60, "/");
        } else {
            setcookie("error", "Erro ao editar dados de categoria", time() + 60, "/");
            header("Location: index.php");
            exit();
        }

        if (!empty($_FILES['imagem']['tmp_name'])) {
            if ($_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
                $nameArquivo = $_FILES['imagem']['name'];
                $tipoArquivo = $_FILES['imagem']['type'];
                $tamanhoArquivo = $_FILES['imagem']['size'];
            
                $sql = " UPDATE `img` SET "
                ." `tamanho_img`='" . $tamanhoArquivo . "',"
                ." `conteudo_img`='" . $tipoArquivo . "',"
                ." `nome_img`='" . $nameArquivo . "' "
                ." WHERE id_img = " . $id_img;

                if($conn->query($sql) === TRUE){

                    $nome_arquivo = "00" . $id_img . ".jpg";

                    $caminho_arquivo = $novoNome . "/" .  $nome_arquivo;   
                    $conteudoArquivo = file_get_contents($_FILES['imagem']['tmp_name']);
                    if (file_put_contents($caminho_arquivo, $conteudoArquivo) !== false) {

                    } else {
                        setcookie("error", "Erro ao editar imagem", time() + 60, "/");

                        header("Location: index.php");
                        exit();
                    }
                } else {
                    setcookie("error", "Erro ao editar imagem", time() + 60, "/");

                    header("Location: index.php");
                    exit();
                }
            } else {
                setcookie("error", "Erro ao editar imagem", time() + 60, "/");

                header("Location: index.php");
                exit();
            }
        }

        setcookie("sucesso", "Ação salva com sucesso!", time() + 60, "/");
        header("Location: index.php");
        exit(); 
    }

    if(!empty($_POST['incluir_categoria'])){
        $nome_categoria = $_POST['nome_categoria'];

        $sql = "SELECT COUNT(*) AS total_registros FROM categoria WHERE nome_categoria = '$nome_categoria' AND id_usuario = " . $_POST['id_usuario'];

        $rs = $conn->query($sql);
        $row = $rs->fetch_assoc();
        $total_registros = $row['total_registros'];

        if ($total_registros > 0) {
            setcookie("exist", "Nome da categoria já existe!", time() + 60, "/");
            header("Location: index.php");
            exit();
        }

        $sql = "SELECT inserir_categoria("
            . "'" . $_POST['id_usuario'] . "',"
            . "'" . $nome_categoria . "',"
            . "'" . $_POST['descricao_categoria'] . "',"
            . "'" . $_POST['apresentacao'] . "',"
            . "'" . $_POST['numero_parcelas'] . "'"
        . ")";
        $rs = $conn->query($sql);

        if ($rs === FALSE){
            setcookie("error", "Erro ao ao inserir categoria", time() + 60, "/");
            header("Location: index.php");
            exit(); 
        } else {
            $row = $rs->fetch_row();
            $id_categoria = $row[0];
        } 

        $categoria = removeCaracteresEspeciais($nome_categoria); 
        $pastaCategoria = "../" . $categoria;

        if (!is_dir($pastaCategoria)) {
            if (mkdir($pastaCategoria, 0777, true)) {
                $status = "OK";
            } else {
                setcookie("error", "Erro ao ao inserir categoria", time() + 60, "/");
                header("Location: index.php");
                exit();
            }
        } else {
            setcookie("error", "Erro ao ao inserir categoria", time() + 60, "/");
            header("Location: index.php");
            exit();
        }

        if(!empty($status)){
            $arquivoIndex = 'index.php';
            $caminhoIndex = "../" . $categoria . "/" . $arquivoIndex;
            $conteudoIndex = file_get_contents('../../assets/admin/filesFolderClient/pageCategory.php');

            file_put_contents($caminhoIndex, $conteudoIndex);

            $arquivoProduto = 'products.php';
            $caminhoIndex = "../" . $categoria . "/" . $arquivoProduto;
            $conteudoProduto = file_get_contents('../../assets/admin/filesFolderClient/products.php');
    
            file_put_contents($caminhoIndex, $conteudoProduto);

            if (!empty($_FILES['imagem']['tmp_name'])) {
                if ($_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
                    $nomeArquivo = $_FILES['imagem']['name'];
                    $conteudoArquivo = $_FILES['imagem']['type'];
                    $tamanhoArquivo = $_FILES['imagem']['size'];
            
                    $sql = "SELECT inserir_img("
                    . "" . $id_categoria . ","
                    . "1,"
                    . "'" . $conteudoArquivo . "',"
                    . "'" . $nomeArquivo . "'"
                    .")";
            
                    $rs = $conn->query($sql);
            
                    if ($rs === FALSE) {
                        setcookie("error", "Erro ao inserir imagem", time() + 60, "/");

                        header("Location: index.php");
                    } else {
                        $row = $rs->fetch_row();
                        $id_img = $row[0];

                        $diretorio = "../" . $categoria . "/";
            
                        $nome_arquivo = "00" . $id_img . ".jpg";
                
                        $caminho_arquivo = $diretorio . $nome_arquivo;    
                        $conteudoArquivo = file_get_contents($_FILES['imagem']['tmp_name']);
                        if (file_put_contents($caminho_arquivo, $conteudoArquivo) !== false) {
                            setcookie("ok", "Produto incluído!", time() + 60, "/");

                            header("Location: index.php");
                        } else {
                            setcookie("error", "Erro ao inserir imagem", time() + 60, "/");

                            header("Location: index.php");
                        }
                    }
                }
            }

            setcookie("ok", "Produto incluído!", time() + 60, "/");

            header("Location: index.php");
        }
    }

    if(!empty($_POST['control_price'])){
        $percentage = str_replace("%", "", $_POST['percentage']);
        $id_categoria = $_POST['id_categoria'];
        $operation = $_POST['operation'];

        if ($operation == '1') {
            $sql = "UPDATE produto SET preco_produto = preco_produto * (1 + $percentage / 100) WHERE id_categoria = $id_categoria";
        } elseif ($operation == '2') {
            $sql = "UPDATE produto SET preco_produto = preco_produto * (1 - $percentage / 100) WHERE id_categoria = $id_categoria";
        }

        $rs = $conn->query($sql);
        if($rs === TRUE){
            setcookie("preco", "os-precos-foram-atualizados", time() + 60, "/");
            header("Location: index.php");
            exit();
        } else {
            setcookie("error", "Erro ao atualizar", time() + 60, "/");

            header("Location: index.php");
        }
    }
    
?>