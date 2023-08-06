    <?php 
    session_start();

    include('../../assets/conn.php');

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {


        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['login_usuario'];
        
    } else {
        header("Location: https://mostruario.online");
        exit();
    }

    $timeout_inatividade = 1200;

    if (isset($_SESSION['ultima_atividade'])) {
        $tempo_decorrido = time() - $_SESSION['ultima_atividade'];

        if ($tempo_decorrido > $timeout_inatividade) {
            session_destroy();

            header("Location:  https://mostruario.online");
            exit;
        }
    }

    $_SESSION['ultima_atividade'] = time();

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <?php $raiz = "../../"; ?>
    <?php include('../../assets/admin/control.php'); ?>
    <head>
        <?php include('../../head.php'); ?>
    </head>
    <body class="bg">
    <header class="w100 js-btw al-center">
            <p>Bem-vindo, <b><?php print ucfirst($usuario); ?></b></p>
            <p class="logoIcon">M<b>o</b></p>
    </header>
        <section class="w100 vh100 js-center al-start column">
            <input type="hidden" id="linkDoUsuario" value="https://mostruario.online/<?php print $usuario; ?>"></input>
            <div class="pop-up text-c bg-pp p20" id="confirmDelCategoria">
                <div class="close cancel"><i class="fa-solid fa-xmark"></i></div>
                <p class="t-white p20">Tem certeza que deseja excluir categoria?</p>
                <button id="confirm" class="btn-submit w100 del-categoria-ok">Sim, tenho certeza</button>  
            </div>

            <div class="pop-up text-c bg-pp p20" id="confirmDelProduto">
                <div class="close cancel"><i class="fa-solid fa-xmark"></i></div>
                <p class="t-white p20">Tem certeza que deseja excluir produto?</p>
                <button id="btnDelProduto" class="btn-submit w100 del-ok">Sim, tenho certeza</button>   
            </div>

            <div class="pop-up text-c bg-pp p20" id="controlPriceForm">
                <div class="close" id="closeControlPrice"><i class="fa-solid fa-xmark"></i></div>
                <form method="POST" class="w100 m10-0">
                    <div class="inputDiv d-flex text-l column w100">
                        <label for="id_categoria">Selecione a categoria:</label>
                        <?php include('../../assets/admin/sel_category.php'); ?>
                    </div>
                    <div class="js-btw al-center w100 m10-0">
                        <div class="inputDiv d-flex column w50 p-r-10">
                            <select id="operation" id="operation" name="operation" >
                                <option value="">Operação</option>
                                <option value="1">Mais</option>
                                <option value="2">Menos</option>
                            </select>
                        </div>
                        <div class="inputDiv d-flex column w50">
                            <input type="text" class="percentage" id="percentage" name="percentage" inputmode="numeric" placeholder="0%" maxlength="4">
                        </div>
                    </div>
                    <button type="submit" class="btn-submit w100" name="control_price" value="control_price" id="control_price">Enviar</button>
                </form>
            </div>

            <div class="pop-up bg" id="pop-up">
                <div class="close" id="close"><i class="fa-solid fa-xmark"></i></div>
                <form method="POST" enctype="multipart/form-data" class="column js-center al-center">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php print $id_usuario; ?>">
                    <input type="hidden" name="id_produto" id="id_produto">

                    <div class="inputDiv d-flex column w100">
                        <div class="previewImage" id="previewImagemProduct" style="display: none;">
                            <img id="imagemPreviewProduct" src="#" alt="Preview da Imagem" />
                        </div>
                        <label class="btn-img js-ard al-center w100" for="imagemProduto" id="arquivoImg">
                            Selecione imagem <i class="fa-regular fa-image"></i>
                        </label>
                        <input type='file' name='imagem' id='imagemProduto' onchange="showPreviewProduct()" required>
                    </div>

                    <input type="hidden" name="id_img" id="id_img">
                    <div class="inputDiv d-flex column w100">
                        <label for="nome_produto">Nome do produto</label>
                        <input type="text" name="nome_produto" id="nome_produto" placeholder="Nome do produto" maxlength="30">
                    </div>
                    <div class="inputDiv d-flex column w100">
                        <label for="descricao_produto">Descrição do produto</label>
                        <input type="text" name="descricao_produto" id="descricao_produto" placeholder="Descrição do produto" maxlength="120">
                    </div>
                    <div class="inputDiv d-flex column w100">
                        <label for="preco_produto">Preço do produto</label>
                        <input type="text" name="preco_produto" id="preco_produto"  inputmode="numeric" placeholder="R$ 0,00" maxlength="12">
                    </div>

                    <div class="inputDiv d-flex column w100">
                        <label for="peso_produto">Peso do produto</label>
                        <input type="text" class="decimal" name="peso_produto" id="peso_produto"  inputmode="numeric" placeholder="0.0" maxlength="12">
                    </div>

                    <div class="inputDiv d-flex column w100">
                        <label for="id_categoria">Categoria do produto</label>
                        <?php include('../../assets/admin/sel_categoria.php'); ?>
                    </div>
                    <button type="submit" class="btn-submit w100" name="incluir_produto" value="incluir_produto" id="incluir_produto">Incluir</button>
                </form>
            </div>

            <div class="pop-up bg" id="pp-category">
                <div class="close" id="closeCategory"><i class="fa-solid fa-xmark"></i></div>
                <form method="POST" enctype="multipart/form-data" class="column js-center al-center">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php print $id_usuario; ?>">
                    <input type="hidden" name="id_categoria" id="id_category">
                    <input type="hidden" name="id_img" id="id_img_categoria">

                    <div class="inputDiv d-flex column w100">
                        <div class="previewImage" id="previewImagemCategory" style="display: none;">
                            <img id="imagemPreviewCategory" src="#" alt="Preview da Imagem" />
                        </div>
                        <label class="btn-img js-ard al-center w100" for="imagemCategoria" id="arquivoImgCategoria">Selecione imagem <i class="fa-regular fa-image"></i></label>
                        <input type='file' name='imagem' id='imagemCategoria' onchange="showPreviewCategory()" required>
                    </div>

                    <div class="inputDiv d-flex column w100">
                        <label for="nome_categoria">Nome da categoria</label>
                        <input type="text" name="nome_categoria" id="nome_categoria" placeholder="Nome da categoria" maxlength="30" required>
                    </div>
                    <div class="inputDiv d-flex column w100">
                        <label for="apresentacao">Apresentação dos produtos</label>
                        <select name="apresentacao" id="apresentacao">
                            <option value="">Selecione a apresentação</option>
                            <option value="1">Peso</option>
                            <option value="2">Preço</option>
                            <option value="3">Preço parcelado</option>
                            <option value="4">Nenhum</option>
                        </select>
                    </div>
                    <div class="inputDiv d-flex column w100" id="toggleSelect" style="display: none;">
                        <label for="numero_parcelas">Número de parcelas</label>
                        <select name="numero_parcelas" id="numero_parcelas">
                            <option value="">Selecione o número de parcelas</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="inputDiv d-flex column w100">
                        <label for="descricao_categoria">Descrição da categoria</label>
                        <input type="text" name="descricao_categoria" id="descricao_categoria" placeholder="Descrição da categoria" maxlength="120">
                    </div>
                    <button type="submit" class="btn-submit w100" name="incluir_categoria" value="incluir_categoria" id="incluir_categoria">Incluir</button>
                </form>
            </div>
            
            <div class="w100 js-start al-start column">
                <h1 class='m10-0 title p-l-20'>Categorias</h1>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                    <?php
                    $sql = "SELECT c.id_categoria, c.nome_categoria, c.descricao_categoria, i.id_img"
                        ." FROM categoria c"
                        ." LEFT JOIN img i ON c.id_categoria = i.id_objeto" 
                        ." WHERE id_usuario = " . $id_usuario;
                    $rs = $conn->query($sql);

                    while($row = $rs->fetch_assoc()){
                        print "<div class='swiper-slide'>";
                            print "<div class='card-2' id='img" . $row['id_img'] . "'>";
                                print "<div class='img8x'>";
                                    print "<img src='../" . removeCaracteresEspeciais($row['nome_categoria']) . "/00" . $row['id_img'] . ".jpg'>";
                                    print "<ul class='action'>";
                                        print "<li class='edit-categoria' data-id='" . $row['id_categoria'] . "'>";
                                            print "<div>";
                                                print "<i class='fa-regular fa-pen-to-square'></i>";
                                            print "</div>";
                                            print "<span>Editar</span>";
                                        print "</li>";
                                        print "<li class='del-categoria' user-id=" . $id_usuario . " data-id='" . $row['id_categoria'] . "' img='" . $row['id_img'] . "'>";
                                            print "<div>";
                                                print "<i class='fa-solid fa-trash'></i>";
                                            print "</div>";
                                            print "<span>Deletar</span>";
                                        print "</li>";
                                    print "</ul>";
                                print "</div>";
                                print "<div class='text-c p20'>";
                                        print "<p>" . $row['nome_categoria'] . "</p>";
                                print "</div>";
                            print "</div>";
                        print "</div>";
                    }
                    ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            
            <?php 

            $sql = "SELECT nome_categoria, id_categoria FROM categoria WHERE id_usuario = " . $id_usuario;

            $rs = $conn->query($sql);
            while($row_categoria = $rs->fetch_assoc()){

                print "<h1 class='m10-0 title p-l-20'>" . $row_categoria['nome_categoria'] . "</h1>";
                print "<div class='wrap al-start js-start g10 p20 w100'>";

                $sql = "SELECT c.nome_categoria, i.id_img, p.id_produto, p.nome_produto, p.descricao_produto, p.preco_produto, p.id_categoria, p.peso_produto, p.tamanho_produto, p.tipagem_produto"
                ." FROM produto p"
                ." LEFT JOIN img i ON p.id_produto = i.id_objeto"
                ." LEFT JOIN categoria c ON p.id_categoria = c.id_categoria"
                ." WHERE p.id_usuario = " . $id_usuario
                ." AND c.id_categoria = " . $row_categoria['id_categoria']
                ." ORDER BY p.date_create DESC, id_categoria DESC";

                $rs_produto = $conn->query($sql);
                while($row = $rs_produto->fetch_assoc()){
                    print "<div class='card-product' id='img" . $row['id_img'] . "'>";
                        print "<div class='img8x'>";
                            print "<img src='../img/00" . $row['id_produto'] . "/00" . $row['id_img'] . ".jpg'>";
                            print "<ul class='action'>";
                                print "<li class='edit' data-id='" . $row['id_produto'] . "'>";
                                    print "<div>";
                                        print "<i class='fa-regular fa-pen-to-square'></i>";
                                    print "</div>";
                                    print "<span>Editar</span>";
                                print "</li>";
                                print "<li class='del' user-id='" . $id_usuario . "' data-id='" . $row['id_produto'] . "' img='" . $row['id_img'] . "'>";
                                    print "<div>";
                                        print "<i class='fa-solid fa-trash'></i>";
                                    print "</div>";
                                    print "<span>Deletar</span>";
                                print "</li>";
                            print "</ul>";
                        print "</div>";
                        print "<div class='conteudo'>";
                            print "<div class='w100 js-start al-start column'>";
                                print "<h3>" . $row['nome_produto'] . "</h3>";
                                print "<p class='m5-0'>" . $row['descricao_produto'] . "</p>";
                            print "</div>";
                            print "<div class='w100 js-btw al-center'>";
                                print "<p><i>" . $row['nome_categoria'] . "</i></p>";
                                print "<p class='price'>R$ " . number_format($row['preco_produto'], 2, ',', '.') . "</p>";
                            print "</div>";
                        print "</div>";
                    print "</div>";
                }

                print "</div>";
            }
            ?>

            <div class="menu js-center al-center column" id="menu">
                <div class="js-center">
                    <span>Controle de preço</span>
                    <button class="option" type="button" id="controlPrice"><i class="fa-solid fa-hand-holding-dollar"></i></button>
                </div>
                <div class="js-center">
                    <span id="copiedMessage">Copiar link</span>
                    <button class="option" type="button" id="copyTheLink"><i class="fa-regular fa-clone"></i></button>
                </div>
                <div class="js-center">
                    <span>Adicionar categoria</span>
                    <button class="option" type="button" id="addCategory"><i class="fa-solid fa-tags"></i></button>
                </div>
                <div class="js-center">
                    <span>Adicionar produto</span>
                    <button class="option" type="button" id="addProduct"><i class="fa-solid fa-box-open"></i></button>
                </div>
                <button class="plus" type="button" id="openMenu"><i class="fa-solid fa-plus"></i></button>
            </div>

        </section>
    </body>
    <div class='alert js-btw al-center p20' id='alert-delete'>
        <i class="fa-solid fa-trash"></i><p>Deletado com sucesso!</p>
    </div>
    <div class='alert js-btw al-center p20' id='alert-ok'>
        <i class="fa-solid fa-circle-check"></i><p>Incluído com sucesso!</p>
    </div>
    <div class='alert js-btw al-center p20' id='alert-preco'>
        <i class="fa-solid fa-circle-check"></i><p>Os preços foram atualizados com sucesso!</p>
    </div>
    <div class='alert js-btw al-center p20' id='alert-sucess'>
        <i class="fa-solid fa-circle-check"></i><p>Salvo com sucesso!</p>
    </div>
    <div class='alert js-btw al-center p20' id='alert-error'>
        <i class="fa-solid fa-circle-exclamation"></i><p>Error</p>
    </div>
    <div class='alert js-btw al-center p20' id='alert-exist'>
        <i class="fa-solid fa-circle-exclamation"></i><p>Nome de categoria já existe!</p>
    </div>
    <script src="../../js/jquery-min.js"></script>
    <script src="../../js/jquery-mask-money.js"></script>
    <script src="../../js/admin/alert.js"></script>
    <script src="../../js/admin/events.js"></script>
    <script src="../../js/admin/add.js"></script>
    <script src="../../js/admin/edit.js"></script>
    <script src="../../js/admin/del.js"></script>
    <script src="../../js/admin/mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../../js/admin/slide.js"></script>
</html>
