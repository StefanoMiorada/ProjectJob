/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function checkUsername(){
    username=$('#registration_username');
    username_msg = $("#invalid-username");
    $.ajax({

        type: 'GET',

        url: '/ajaxUsername',

        data: {username},

        success: function (data) {

            if (data.found)
            {
                username_msg.html("username already exists in the database");
            } else {
                $('form[name=register-form]').submit();
            }
        }

    });
}

function reset(){
    $("#filtro_contratto").prop("checked", false);
}

function formRegistrazioneAzienda(){
    $("#div_nome").hide();
    $("#div_cognome").hide();
    $("#div_nome_azienda").show();
    document.getElementById("nome").required = false;
    document.getElementById("cognome").required = false;
    document.getElementById("nome_azienda").required = true;
}
function formRegistrazioneUtente(){
    $("#div_nome").show();
    $("#div_cognome").show();
    $("#div_nome_azienda").hide();
    document.getElementById("nome").required = true;
    document.getElementById("cognome").required = true;
    document.getElementById("nome_azienda").required = false;
} 
