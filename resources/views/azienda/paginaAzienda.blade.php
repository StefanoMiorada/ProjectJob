@extends('layouts.master')

@section('title')
    @if($loggedName)
    {{ $loggedName }}
    @else
    Pagina personale azienda
    @endif 
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
<li class="nav-item"><a class="nav-link "><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span class="bi bi-box-arrow-right"></span></a></li>
@else 
<li class="nav-item"><a class="nav-link" href="{{ route('user.login',['source' =>'paginaAzienda']) }}"><span class="bi bi-person p-2"></span> {{ trans('labels.login') }}</a></li>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a></li>
@endsection

@section('corpo')
@if (session()->has('successEdit'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","{{ trans('labels.okMessageEdit') }}","success");
</script>
@elseif (session()->has('successCreate'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","{{ trans('labels.okMessageCreate') }}","success");
</script>
@elseif (session()->has('successDelete'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","Annuncio rimosso correttamente","success");
</script>
@endif
<!-- Bottone scrollToTop -->
<button class=" btn bi bi-arrow-up-square btn-lg fs-1" onclick="topFunction()" id="ScrollToTop" ></button>

<div class="container-fluid mb-5">
        <div class="container text-center mb-5">
            <a type="button" class="btn btn-outline-primary" href="{{route('annunci.create')}}"><i class="bi bi-plus-square"></i> {{ trans('labels.aggiungiNuovoAnnuncio') }}</a>
            <a type="button" class="btn btn-outline-primary" href="{{route('user.edit', ['user' => $utente->id])}}"><i class="bi bi-pencil-square"></i> Modifica dati personali</a>
        </div>
    @if(count($listaAnnunci)==0)
    <div class="container text-center mb-5">
        <h3>{{ trans('labels.nessunAnnuncio' )}}</h3>
    </div>
    @else
    <div class="row">
        <!-- Sezione filtri sinistra -->
        <div class="col-md-3 border-end ">
            <div class="col text-center">
                <h4>{{ trans('labels.ricercaAnnuncioLavoro') }}</h4>
            </div>
            <div class="row ">
                <div class="col-md-12">
                    <input type="text" id="ricerca" class="form-control" placeholder="{{ trans('labels.filtroRicerca') }}">
                </div>
            <div class="row mt-2">
                <div class="col text-center">
                    <button id="button_ricerca" type="button" onclick="myFunction()" class="btn btn-outline-primary"><i class="bi bi-search"></i> {{ trans('labels.cerca') }}</button>
                    <button id="reset_ricerca" type="button" class="btn btn-outline-primary"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                </div>
            </div> 
            </div>  
                   
        </div>
        <!-- TabellaAnnunci -->
        <div class="col-md-9 text-left">
            <table class="table" id="tabellaAnnunciAzienda">
            @foreach($listaAnnunci as $annuncio)
            <tr>
                <td rowspan="2" class="col-7 annuncio" onmouseover="this.style.background='#f2f2f2';" onmouseout="this.style.background='white';" onclick="window.location='{{ route('annuncio.dettagliCandidature',['id' => $annuncio->id]) }}'" style="cursor: pointer; word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal; ">
                    <div><h3><b>{{ $annuncio->posizione }}</b></h3></div>
                    <div><i class="bi bi-geo-alt"></i> {{ $annuncio->luogo }}</div>
                    <div>{{ $annuncio->dettagli }}</div>
                    <div>{{ $annuncio->richieste }}</div>
                    <div><b><i>{{ trans('labels.contratto' )}}</i></b> {{ $annuncio->tipo_contratto }}</div>
                </td>
                <td class="col-1">
                    <a type="button" class="btn btn-outline-primary" href="{{ route('annunci.edit', ['annunci' => $annuncio->id]) }}"><i class="bi bi-pencil-square"></i> {{ trans('labels.modifica' )}}</a>
                </td>
                <td class="col-1">
                    <a type="button" class="btn btn-outline-danger" href="{{route('annuncio.confirmDestroy', ['id' => $annuncio->id])}}"><i class="bi bi-trash3"></i> {{ trans('labels.elimina' )}}</a>
                </td>
            </tr>
            <tr>
                <td style="display:none;"><div><h3><b>{{ $annuncio->posizione }}</b></h3></div>
                    <div><i class="bi bi-geo-alt"></i> {{ $annuncio->luogo }}</div>
                    <div>{{ $annuncio->dettagli }}</div>
                    <div>{{ $annuncio->richieste }}</div>
                    <div><b><i>{{ trans('labels.contratto' )}}</i></b> {{ $annuncio->tipo_contratto }}</div>
                </td>
                <td class="text-center align-middle" colspan="2"><a type="button" class="btn btn-outline-primary" href="{{ route('annuncio.dettagliCandidature',['id' => $annuncio->id]) }}">{{ trans('labels.candidature')}}: {{$annuncio->candidature_annuncio()->count()}}</a></td>
            </tr>
            @endforeach
        </table>
        </div>
    </div>
    @endif
</div>
<!-- reset e show di tutte le tr -->
<script>
    $('#reset_ricerca').click(function () {
    $('#tabellaAnnunciAzienda tr').show();
    $("#ricerca").val("");
});
</script>
<!-- filtro con area di input e bottone -->
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("ricerca");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabellaAnnunciAzienda");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
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