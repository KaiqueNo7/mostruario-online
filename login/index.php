<?php $raiz = "../"; include('../assets/conn.php');  ?>
<?php include('valid-login.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('../head.php'); ?>
</head>
<body>
<div class="w100 js-btw al-center vh100">
    <div class="w60 js-btw al-center p30 column vh100">
        <h2 class="text-l w100 p30">MOSTRUÁRIO ONLINE</h2>
        <div class="w100 js-center al-center column">
            <h2>Login</h2>
            <form class="w100 p30" method="POST" id="form-login">
                <div class="inputDiv d-flex column m10-0">
                    <label class="m10-0" for="usuario">Usuário</label>
                    <input type="text" name="usuario" id="usuario" maxlength="15">
                </div>
                <div class="inputDiv d-flex column m10-0">
                    <label class="m10-0" for="password">Senha</label>
                    <input type="password" name="password" id="password" maxlength="15">
                </div>
                <button class="btn-submit w100" type="submit" value="login" name="login" id="login">Entrar</button>
            </form>
        </div>
        <p>Não tem conta ainda?<a href="https://mostruario.online/register"> Registrar-se</a></p>
        <p class="terms">© <?php print date('Y') . " MOSTRUÁRIO ONLINE"; ?> | Todos os direitos reservados.</p>
    </div>
    <div class="w40 vh100 js-center mbl-none">
        <img src="img/login.jpg" class="img">
    </div>
</div>
</body>
</html>