@extends('layouts.master')

@section('title')
    Candidature annuncio
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a>
</li>
@endsection

@section('right_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('setLang', ['lang' => 'en']) }}" ><img src="{{ url('/') }}/img/flags/en.png" width="30" class="img-rounded"/></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('setLang', ['lang' => 'it']) }}" ><img src="{{ url('/') }}/img/flags/it.png" width="24" class="img-rounded"/></a></li>
@if($logged)
<li class="nav-item"><a class="nav-link"><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span class="bi bi-box-arrow-right"></span></a></li>
@else 
<li class="nav-item"><a class="nav-link" href="{{ route('user.login',['source' =>'paginaAzienda']) }}"><span class="bi bi-person p-2"></span> {{ trans('labels.login') }}</a></li>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('annuncio.dettagliCandidature',['id'=>$annuncio->id]) }}">{{ trans('labels.dettagliAnnuncio') }}</a></li>
@endsection

@section('corpo')
<!-- Bottone scrollToTop -->
<button class=" btn bi bi-arrow-up-square btn-lg fs-1" onclick="topFunction()" id="ScrollToTop" ></button>

<div class="container text-center mb-5">
    <p><h3>{{ trans('labels.annuncioDiRiferimento') }} <b>{{ $annuncio->posizione }}</b></h3></p>
    <p><h3>{{ trans('labels.candidatureRicevute') }} <b>{{ $dettagliUtentiCandidature->count() }}</b></h3></p>
    <a type="button" class="btn btn-outline-primary" href="{{ route('paginaAzienda.index') }}"><i class="bi bi-box-arrow-left"></i> {{ trans('labels.tornaIndietro') }}</a>
</div>
<!-- area di ricerca -->
<div class="row">
    <div class="col-md-6 offset-md-2">
        <input type="text" id="ricerca" class="form-control" placeholder="Ricerca per nome, cognome o parola">
    </div>
    <div class="col-md-3">
        <a id="button_ricerca" type="button" class="btn btn-outline-primary"><i class="bi bi-search"></i> {{ trans('labels.cerca') }}</a>
        <a id="reset_ricerca" type="button" class="btn btn-outline-primary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
    </div>
</div>
<hr>
@if ($dettagliUtentiCandidature->count() == 0)
<div class="container text-center mb-5">
    <h3>{{ trans('labels.nessunaCandidatura') }}</h3>
</div>
@else
<div class="col-md-10 text-left offset-md-1">
    <table class="table" id="TabellaCandidature">
    @foreach($dettagliUtentiCandidature as $candidatura)
    <tr>
        <td> 
            <div><h3><b>Candidato: </b>{{ $candidatura->nome }} {{ $candidatura->cognome }}</h3></div>
            <div class="row pt-2">
                <div class="col-3"><b>{{ trans('labels.emailCandidato') }} </b></div><div class="col-7">{{ $candidatura->email }}</div>
            </div>
            <div class="row pt-2">
                <div class="col-3"><b>{{ trans('labels.letteraMotivazionale') }} </b></div><div class="col-7"><?php echo ($candidatura->lettera_motivazionale)?></div>
            </div>
            <div class="row pt-2">
                <div class="col-3 d-flex aligns-items-center " ><b>Curriculum Vitae: </b></div>
                <div class="col-7">
                    <a href="#" onClick="window.open('{{ asset('storage/files/'.$candidatura->cv_path) }}'); return false;">{{ $candidatura->cv_path }}</a>
                    <a type ="button" class=" btn bi bi-eye fs-4" onClick="window.open('{{ asset('storage/files/'.$candidatura->cv_path) }}'); return false;"></a>
                    <a type="button" class=" btn bi bi-download fs-4" href="{{ asset('storage/files/'.$candidatura->cv_path) }}" download></a>
                </div>
            </div>       
        </td>
    </tr>
    @endforeach
    </table>
</div>
@endif

</div>


<!-- Scroll To Top Button -->
<script>
let mybutton = document.getElementById("ScrollToTop");
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

<!-- bottone per resettare la ricerca -->
<script>
    $('#reset_ricerca').click(function () {
        var areaInput=document.getElementById('ricerca');
        areaInput.value='';
        $('#TabellaCandidature tr').show();
    });
</script>

<!-- filtro con area di input e bottone -->
<script>
$(document).ready(function(){
    $("#ricerca").on("click", function() {
    });
    $("#button_ricerca").on("click", function() {
        var value = $("#ricerca").val().toLowerCase();
        $("#TabellaCandidature tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endsection