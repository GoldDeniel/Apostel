
let registerSpan = document.getElementById('registerSpan');
let loginSpan = document.getElementById('loginSpan');
registerSpan.addEventListener('click', function() {

        let registerForm = document.getElementById('registerForm');
        registerForm.hidden = false;

        let loginForm = document.getElementById('loginForm');
        loginForm.hidden = true;
    }
);

loginSpan.addEventListener('click', function() {

    let registerForm = document.getElementById('registerForm');
    registerForm.hidden = true;

    let loginForm = document.getElementById('loginForm');
    loginForm.hidden = false;
    }
);