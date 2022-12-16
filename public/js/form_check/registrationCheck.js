const validateEmail = (email) => {
    return String(email)
        .toLowerCase()
        .match(
            /\S+\@\S+\.\S/
        );
};

function standardCheck(lang) {
    username = $("#registration_username");
    username_div = $("#registration_username_div");
    username.removeClass("is-invalid");
    username_msg = $("#registration_username_div .invalid-feedback");
    username_msg.html("");

    email = $("#email");
    email_div = $("#email_div");
    email.removeClass("is-invalid");
    email_msg = $("#email_div .invalid-feedback");
    email_msg.html("");

    password = $("#registration_password");
    password_div = $("#registration_password_div");
    password.removeClass("is-invalid");
    password_msg = $("#registration_password_div .invalid-feedback");
    password_msg.html("");

    confirm_password = $("#confirm-password");
    confirm_password_div = $("#confirm-password_div");
    confirm_password.removeClass("is-invalid");
    confirm_password_msg = $("#confirm-password_div .invalid-feedback");
    confirm_password_msg.html("");

    var error = false;

    // Static Checks
    if (username.val().trim() === "") {
        registerError(username_msg, lang == "it" ? "Inserire Username Valido" : "Insert Valid Username", username)
        username.focus();
        error = true;
    }

    if (email.val().trim() === "") {
        registerError(email_msg, lang == "it" ? "Inserire Email" : "Insert Email", email)
        email.focus();
        error = true;
    }
    var emailValue = email.val().trim();
    if (!validateEmail(emailValue)) {
        registerError(email_msg, lang == "it" ? "Inserire Email Valida" : "Insert Valid Email", email)
        email.focus();
        error = true;
    }

    if (password.val().trim() === "") {
        registerError(password_msg, lang == "it" ? "Inserire password" : "Insert Password", password)
        password.focus();
        error = true;
    } else {
        var passwordValue = password.val().trim();
        if (confirm_password.val().trim() !== passwordValue) {
            registerError(password_msg, lang == "it" ? "Le password inserite non corrispondono" : "Inserted passwords are different", password)
            password.focus();
            error = true;
        }
    }


    return error
}

function checkUsername(lang) {
    console.log("Checking if unique username")
    username = $("#registration_username");
    username_div = $("#registration_username_div");
    username.removeClass("is-invalid");
    username_msg = $("#registration_username_div .invalid-feedback");
    username_msg.html("");
    var usernameValue = username.val().trim();

    $.ajax({

        type: 'GET',

        url: '/user/ajaxUsername',

        data: { username: usernameValue },

        success: function (data) {

            if (!data.valid) {
                registerError(username_msg, lang == "it" ? "Username inserito è già in uso" : "Username already in use", username)
                username.focus();
            } else {
                console.log("Valid Username")
                $('form[name=register-form]').submit();
            }
        }

    });
}

function checkUtente(lang) {
    error = standardCheck(lang)

    nome = $("#nome");
    nome_div = $("#div_nome");
    nome.removeClass("is-invalid");
    nome_msg = $("#div_nome .invalid-feedback");
    nome_msg.html("");

    cognome = $("#cognome");
    cognome_div = $("#cognome_div");
    cognome.removeClass("is-invalid");
    cognome_msg = $("#cognome_div .invalid-feedback");
    cognome_msg.html("");

    // Static Checks
    if (nome.val().trim() === "") {
        registerError(nome_msg, lang == "it" ? "Inserire nome" : "Insert your name", nome)
        nome.focus();
        error = true;
    }

    if (cognome.val().trim() === "") {
        registerError(cognome_msg, lang == "it" ? "Inserire cognome" : "Insert your surname", cognome)
        cognome.focus();
        error = true;
    }

    if (error) {
        return;
    }

    checkUsername(lang)
}

function checkAzienda(lang) {
    error = standardCheck(lang)

    nome = $("#nome_azienda");
    nome_div = $("#div_nome_azienda");
    nome.removeClass("is-invalid");
    nome_msg = $("#div_nome_azienda .invalid-feedback");
    nome_msg.html("");

    // Static Checks
    if (nome.val().trim() === "") {
        registerError(nome_msg, lang == "it" ? "Inserire nome azienda" : "Insert the company name", nome)
        nome.focus();
        error = true;
    }

    if (error) {
        return;
    }

    checkUsername(lang)
}

function registerError(msg_element, msg, input) {
    msg_element.html(msg);
    input.addClass("is-invalid");
}