function reset(){
    $("#filtro_contratto").prop("checked", false);
}

function reset_warnings() {
    username = $("#registration_username");
    username.removeClass("is-invalid");
    username_msg = $("#registration_username_div .invalid-feedback");
    username_msg.html("");

    email = $("#email");
    email.removeClass("is-invalid");
    email_msg = $("#email_div .invalid-feedback");
    email_msg.html("");

    password = $("#registration_password");
    password.removeClass("is-invalid");
    password_msg = $("#registration_password_div .invalid-feedback");
    password_msg.html("");

    confirm_password = $("#confirm-password");
    confirm_password.removeClass("is-invalid");
    confirm_password_msg = $("#confirm-password_div .invalid-feedback");
    confirm_password_msg.html("");

    nome = $("#nome");
    nome.removeClass("is-invalid");
    nome_msg = $("#div_nome .invalid-feedback");
    nome_msg.html("");

    cognome = $("#cognome");
    cognome.removeClass("is-invalid");
    cognome_msg = $("#cognome_div .invalid-feedback");
    cognome_msg.html("");

    nome = $("#nome_azienda");
    nome.removeClass("is-invalid");
    nome_msg = $("#div_nome_azienda .invalid-feedback");
    nome_msg.html("");
}

function formRegistrazioneAzienda(){
    $("#div_nome").hide();
    $("#div_cognome").hide();
    $("#div_nome_azienda").show();
    document.getElementById("nome").required = false;
    document.getElementById("cognome").required = false;
    document.getElementById("nome_azienda").required = true;
    checkRegister = checkAzienda
    reset_warnings()
}
function formRegistrazioneUtente(){
    $("#div_nome").show();
    $("#div_cognome").show();
    $("#div_nome_azienda").hide();
    document.getElementById("nome").required = true;
    document.getElementById("cognome").required = true;
    document.getElementById("nome_azienda").required = false;
    checkRegister = checkUtente
    reset_warnings()
} 
