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

if (document.cookie.includes("preco")) {
    const update = document.getElementById('alert-preco');
    update.classList.add('show');
    update.classList.add('ok');

    setTimeout(function() {
        update.classList.remove('show');
        update.classList.remove('ok');
    }, 3000); 
    document.cookie = "preco=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

if (document.cookie.includes("ok")) {
    const include = document.getElementById('alert-ok');
    include.classList.add('show');
    include.classList.add('ok');

    setTimeout(function() {
        include.classList.remove('show');
        include.classList.remove('ok');
    }, 3000); 
    document.cookie = "ok=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
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

if (document.cookie.includes("deletado")) {
    const include = document.getElementById('alert-delete');
    include.classList.add('show');
    include.classList.add('del');

    setTimeout(function() {
        include.classList.remove('show');
        include.classList.remove('del');
    }, 3000); 
    document.cookie = "deletado=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

if (document.cookie.includes("exist")) {
    const include = document.getElementById('alert-exist');
    include.classList.add('show');
    include.classList.add('del');

    setTimeout(function() {
        include.classList.remove('show');
        include.classList.remove('del');
    }, 3000); 
    document.cookie = "exist=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}