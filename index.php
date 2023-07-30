<?php $raiz = ""; include('assets/conn.php');  ?>
<?php include('login/valid-login.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('head.php'); ?>
</head>
<body>
<div class="w100 js-btw al-center vh100">
    <div class="w60 js-btw al-center p30 column vh100">
        <h2 class="text-l m-text-c w100 p30">MOSTRUÁRIO ONLINE</h2>
        <div class="w100 js-center al-center column">
            <h1>Login</h1>
            <form class="w100 p30" method="POST" id="form-login">
                <div class="inputDiv d-flex column m10-0">
                    <label class="m10-0" for="usuario">Usuário</label>
                    <input class="login" type="text" name="usuario" id="usuario" maxlength="15">
                </div>
                <div class="inputDiv d-flex column m10-0">
                    <label class="m10-0" for="password">Senha</label>
                    <input class="login" type="password" name="password" id="password" maxlength="15">
                </div>
                <button class="btn-submit w100" type="submit" value="login" name="login" id="login">Entrar</button>
                <div class='js-center al-center alert-login' id='alert-sucess'>
                    <i class="fa-solid fa-circle-check"></i><p class="p10">Conta criada com sucesso!</p>
                </div>
                <div class='js-center al-center alert-login' id='alert-error'>
                    <i class="fa-solid fa-circle-exclamation"></i><p class="p10">Algo deu errado! Verifique os seus dados</p>
                </div>
            </form>
        </div>
        <p>Não tem conta ainda?<a class="link" href="https://mostruario.online/register"> Registrar-se</a></p>
        <p class="terms">© <?php print date('Y') . " MOSTRUÁRIO ONLINE"; ?> | Todos os direitos reservados.</p>
    </div>
    <div class="w40 vh100 js-center mbl-none">
        <img src="img/login.jpg" class="img">
    </div>
</div>
<script>
if (document.cookie.includes("sucesso")) {
    const update = document.getElementById('alert-sucess');
    update.classList.add('show');
    update.classList.add('ok');

    setTimeout(function() {
        update.classList.remove('show');
        update.classList.remove('ok');
    }, 3000); 
    document.cookie = "sucesso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

if (document.cookie.includes("error")) {
    const include = document.getElementById('alert-error');
    include.classList.add('show');
    include.classList.add('del');

    setTimeout(function() {
        include.classList.remove('show');
        include.classList.remove('del');
    }, 3000); 
    document.cookie = "error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
</script>
</body>
</html>
