<?php $raiz = "../"; include('../assets/conn.php');  ?>
<?php include('create-count.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('../head.php'); ?>
</head>
<body>
<div class="w100 js-btw al-center vh100">
    <div class="w60 js-btw al-start column vh100">
        <a href="https://mostruario.online" class="text-c w100 p20 logo">MOSTRUÁRIO ONLINE</a>
        <div class="w100 js-center al-center column">
            <form class="w60" method="POST" id="form-login">
                <h2>Crie uma conta</h2>
                <div class="inputDiv d-flex column m5-0">
                    <label class="m5-0" for="nome_loja">Nome do Mostruário</label>
                    <input class="login" type="text" name="nome_loja" id="nome_loja" maxlength="50" required>
                </div>
                <div class="inputDiv d-flex column m5-0">
                    <label class="m5-0" for="email">E-mail</label>
                    <input class="login" type="email" name="email" id="email" maxlength="255" required>
                </div>
                <div class="inputDiv d-flex column m5-0">
                    <label class="m5-0" for="usuario">Usuário</label>
                    <input class="login" type="text" name="usuario" id="usuario" maxlength="15" required>
                </div>
                <p id="usuarioError" class="alert-form">Nome de usuário já existe.</p>
                <div class="inputDiv d-flex column m5-0">
                    <label class="m5-0" for="password">Senha</label>
                    <input class="login" type="password" name="password" id="password" maxlength="15" required>
                </div>
                <div class="inputDiv d-flex column m5-0">
                    <label class="m5-0" for="confirm_password">Confirma a senha</label>
                    <input class="login" type="password" name="confirm_password" id="confirm_password" maxlength="15" required>
                </div>
                <p id="mensagemErro" class="alert-form">As senhas não coincidem.</p>
                <button class="btn-submit w100" type="submit" value="register" name="register" id="register">Criar</button>
                <div class='js-center al-center del alert-login' id='alert-error'>
                    <i class="fa-solid fa-circle-exclamation"></i><p class="p10">Algo deu errado! Verifique os seus dados</p>
                </div>
            </form>
        </div>
        <p class="text-c p20 w100">Voltar para <a class="link" href="https://mostruario.online/"> Login</a></p>
    </div>
    <div class="w40 vh100 js-center mbl-none">
        <img src="../img/register.jpg" class="img">
    </div>
</div>
<div class="w100 js-center al-center p20 bg-pp t-white">
    <p class="terms">© <?php print date('Y') . " MOSTRUÁRIO ONLINE"; ?> | Todos os direitos reservados.</p>
</div>
<script src="../js/jquery-min.js"></script>
<script src="../js/admin/register.js"></script>
</body>
</html>
