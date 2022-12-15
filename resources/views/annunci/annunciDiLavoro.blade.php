@extends('layouts.master')

@section('title')
Annunci di lavoro
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a>
</li>
@if($logged)
    @if($is_azienda==1)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('candidature.index') }}">Area Personale</a>
    </li>
    @endif
@endif
@endsection

@section('right_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('setLang', ['lang' => 'en']) }}" ><img src="{{ url('/') }}/img/flags/en.png" width="30" class="img-rounded"/></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('setLang', ['lang' => 'it']) }}" ><img src="{{ url('/') }}/img/flags/it.png" width="24" class="img-rounded"/></a></li>
@if($logged)
<li class="nav-item"><a class="nav-link"><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span class="bi bi-box-arrow-right"></span></a></li>
@else 
<li class="nav-item"><a class="nav-link" href="{{ route('user.login',['source' =>'annunci']) }}"><span class="bi bi-person p-2"></span> {{ trans('labels.login') }}</a></li>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a></li>
@endsection
<!--Sezione ricerca...-->
@section('corpo')
@if (session()->has('success'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","{{ trans('labels.okMessage2') }}","success");
</script>
@endif
@if($listaAnnunci->count()==0)
    <div class="container text-center mb-5">
        <h3>{{ trans('labels.nessunAnnuncio') }}</h3>
    </div>
@else
<div class="container mb-3">
    <div class="row">
        <div class="col text-center">
            <h2>{{ trans('labels.ricercaAnnuncioLavoro') }}</h2>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-6 offset-md-2">
            <input type="text" id="ricerca" class="form-control" placeholder="{{ trans('labels.filtroRicerca') }}">
        </div>
        <div class="col-md-3">
            <a id="button_ricerca" type="button" class="btn btn-outline-primary"><i class="bi bi-search"></i> {{ trans('labels.cerca') }}</a>
            <a id="reset_ricerca" type="button" class="btn btn-outline-primary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
        </div>
    </div> 
    
</div>
<!-- Bottone scrollToTop -->
<button class=" btn bi bi-arrow-up-square fs-1" onclick="topFunction()" id="ScrollToTop" ></button>

<div class="container-fluid mb-5">
    <div class="row">

        <!-- Sezione filtri sinistra -->
        <div class="col-md-3 border-end radio-group">
            <table>
            @foreach($tipo_contratto as $contratto)
                <tr>
                    <td>
                    <input class="form-check-input" type="radio" id="filtro_contratto" name="chx" value="{{$contratto}}">
                    <label class="form-check-label" for="chx">
                        @if(isset($conteggio_contratti[ $contratto ]))
                        <!-- {{ $contratto }} <b>({{ $conteggio_contratti[ $contratto ] }})</b> -->
                        {{ $contratto }} <span class="badge bg-secondary rounded-pill ">{{ $conteggio_contratti[ $contratto ] }}</span>
                        @else
                        {{ $contratto }} <span class="badge bg-secondary rounded-pill ">0</span>
                        @endif
                    </label>
                    </td>
                </tr>
            @endforeach
            </table>
            <div class="mt-2">
                <a type="button" class="btn btn-outline-primary" id="reset">Reset</a>
            </div>
            
        </div>

        <!-- Sezione principale con tabella annunci -->
        <div class="col-md-9 text-left ">
            <table class="table table-hover" id="tabellaAnnunci">
            @foreach($listaAnnunci as $annuncio)
            <tr>
                <td class="col-8" style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">
                    <div><h3><b>{{ $annuncio->posizione }}</b></h3></div>
                    <div><i class="bi bi-geo-alt"></i> {{ $annuncio->luogo }}</div>
                    <div><i><b>Dettagli: </b></i>{{ $annuncio->dettagli }}</div>
                    <div class="pt-1"><i><b>Richieste: </b></i>{{ $annuncio->richieste }}</div>
                    <div class="pt-1"><i><b>{{ trans('labels.contratto') }} </b></i> {{ $annuncio->tipo_contratto }}</div>
                </td>
                <td class="col-1">
                    @if($logged==false)
                        <a type="button" class="btn btn-outline-primary" href="{{ route('user.login',['source' =>'annunci', 'message'=>'True']) }}"><i class="bi bi-box-arrow-up-right"></i> {{ trans('labels.candidati') }}</a>
                    @else
                        @if($is_azienda==0)
                            <a type="button" class="btn btn-outline-primary" href="{{ route('annuncio.candidati',['id'=>$annuncio->id]) }}"><i class="bi bi-box-arrow-up-right"></i> {{ trans('labels.candidati') }}</a>
                        @else
                        <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="non è possibile candidarsi con un account aziendale">
                            <button class="btn btn-outline-primary" disabled ><i class="bi bi-x-circle"></i> {{ trans('labels.candidati') }}</button>
                        </span>
                            
                        @endif
                    @endif 
                </td>
            </tr>
            @endforeach
        </table>
        </div>
    </div>
</div>
@endif
<!-- reset radio e show di tutte le tr -->
<script>
    $('#reset').click(function () {
	$('.radio-group').find('[type="radio"]').prop('checked', false);
    $('#tabellaAnnunci tr').show();
});
</script>
<!-- bottone per resettare la ricerca -->
<script>
    $('#reset_ricerca').click(function () {
        var areaInput=document.getElementById('ricerca');
        areaInput.value='';
        $('.radio-group').find('[type="radio"]').prop('checked', false);
        $('#tabellaAnnunci tr').show();
    });
</script>
<!-- filtro con radio -->
<script>
    $(document).ready(function(){
        $('input[type="radio"]').change(function () {
        var value = $('input:checked').prop('value') || '';
        $('#tabellaAnnunci tr').hide();
        $('#tabellaAnnunci tr:contains(' + value + ')').show();
        });
    });
</script>
<!-- filtro con area di input e bottone -->
<script>
$(document).ready(function(){
    $("#ricerca").on("click", function() {
        $('.radio-group').find('[type="radio"]').prop('checked', false);
        $('#tabellaAnnunci tr').show();
    });
    $("#button_ricerca").on("click", function() {
        $('.radio-group').find('[type="radio"]').prop('checked', false);
        var value = $("#ricerca").val().toLowerCase();
        $("#tabellaAnnunci tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
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

@endsection