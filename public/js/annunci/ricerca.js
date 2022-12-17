function check_annuncio(element, input) {
    var posizione = element.find(".annuncio-posizione").text().trim().toLowerCase();
    var luogo = element.find(".annuncio-luogo").text().trim().toLowerCase();
    var dettagli = element.find(".annuncio-dettagli").text().trim().toLowerCase();
    var richieste = element.find(".annuncio-richieste").text().trim().toLowerCase();
    var contratto = element.find(".annuncio-contratto").text().trim().toLowerCase();

    if (posizione.indexOf(input) >= 0) {
        element.show();
        return
    }

    if (luogo.indexOf(input) >= 0) {
        element.show();
        return
    }

    if (dettagli.indexOf(input) >= 0) {
        element.show();
        return
    }

    if (richieste.indexOf(input) >= 0) {
        element.show();
        return
    }

    if (contratto.indexOf(input) >= 0) {
        element.show();
        return
    }

    element.hide();
}

function apply_filter(element, filter) {
    if (filter != "") {
        var filter_value = element.find(filter).size();
        if (filter_value <= 0) {
            element.hide();
        }
    }
}

function lancia_ricerca() {
    $("#nessun_annuncio_tr").hide();
    var input = $("#ricerca").val().trim().toLowerCase();
    var filter = ""
    if ($(":radio:checked").val()) {
        var filter = ".contratto-" + $(":radio:checked").val().trim().replace(" ", "-");
    }

    $(".annuncio_tr").map(function() {
        check_annuncio($(this), input)
    })
    
    $(".filtro-contratto").map(function() {
        var contract_class = "." + $(this).attr('id');
        var total_visible = Number($(contract_class+":visible").length)
        $(this).find(".badge").html(total_visible.toString())
    })

    $(".annuncio_tr:visible").map(function() {
        apply_filter($(this), filter)
    })

    var count_visibles = $(".annuncio_tr:visible").size()
    if (count_visibles <= 0) {
        $("#nessun_annuncio_tr").show();
    }
}

function reset_filters() {
    $(".form-check-input").map(function () {
        $(this).prop("checked", false)
    })
    lancia_ricerca()
}

function reset_ricerca() {
    $("#ricerca").val("")
    reset_filters()
}