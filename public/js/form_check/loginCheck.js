var loginErrors = {
    username_empty: {
        en: "Please insert username",
        it: "Inserire nome utente"
    },
    password_empty: {
        en: "Please insert your password",
        it: "Inserire la password"
    },
    not_auth: {
        en: "Invalid username or password.",
        it: "Nome Utente o password non corretti."
    }
}

function checkLogin(lang) {
    username = $("#username");
    username_div = $("#username_div");
    username.removeClass("is-invalid");
    username_msg = $("#username_div .invalid-feedback");
    username_msg.html("");

    password = $("#password");
    password_div = $("#password_div");
    password.removeClass("is-invalid");
    password_msg = $("#password_div .invalid-feedback");
    password_msg.html("");

    var error = false;

    // Static Checks
    if (username.val().trim() === "") {
        registerError(username_msg, loginErrors.username_empty[lang], username)
        username.focus();
        error = true;
    }
    var usernameValue = username.val().trim();

    if (password.val().trim() === "") {
        registerError(password_msg, loginErrors.password_empty[lang], password)
        password.focus();
        error = true;
    }
    var passwordValue = password.val().trim();

    if (error) {
        return;
    }

    //Dynamic Checks
    $.ajax({

        type: 'GET',

        url: '/user/ajaxLogin',

        data: { username: usernameValue, password: passwordValue },

        success: function (data) {
            valid_data = true;
            
            if (!data.valid) {
                registerError(username_msg, loginErrors.not_auth[lang], username)
                username.focus();
                valid_data = false;
            }

            console.log($("#link-home").attr("href"));

            if (valid_data) {
                $('form[name=login-form]').submit();
            }
        }

    });
}

function registerError(msg_element, msg, input) {
    msg_element.html(msg);
    input.addClass("is-invalid");
}