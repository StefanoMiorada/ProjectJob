@extends('layouts.master')

@section('title')
    @if($loggedName)
      @if(isset($annuncio->id))
        {{ $loggedName }} modifica annuncio
      @else
        {{ $loggedName }} crea annuncio
      @endif
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
<li class="nav-item"><a class="nav-link"><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span class="bi bi-box-arrow-right"></span></a></li>
@else 
<li class="nav-item"><a class="nav-link" href="{{ route('user.login',['source' =>'paginaAzienda']) }}"><span class="bi bi-person p-2"></span> {{ trans('labels.login') }}</a></li>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a></li>
@if(isset($annuncio->id))
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('annunci.edit', ['annunci' => $annuncio->id]) }}">{{ trans('labels.modificaAnnuncio') }}</a></li>
@else
  <li class="breadcrumb-item active" aria-current="page"><a href="{{route('annunci.create') }}">{{ trans('labels.creaAnnuncio') }}</a></li>
@endif
@endsection

@section('corpo')
<div class="container-fluid">
  @if(isset($annuncio->id))
    <form class="needs-validation" novalidate name="modificaAnnuncio" method="post" action="{{ route('annuncio.update', ['id' => $annuncio->id]) }}">
  @else
    <form class="needs-validation" novalidate name="creaAnnuncio" method="post" action="{{ route('annunci.store') }}">
  @endif
  @csrf
    <div class="form-group row mb-3">
      <label for="posizione" class="col-sm-2 col-form-label obbligatorio">{{ trans('labels.posizione') }}</label>
      <div class="col-sm-5">
        @if(isset($annuncio->id))
        <input type="posizione" class="form-control" required name="posizione" id="posizione" value="{{ $annuncio->posizione }}">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @else
        <input type="posizione" class="form-control" required name="posizione" id="posizione" placeholder="posizione lavorativa">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group row mb-3">
      <label for="luogo" class="col-sm-2 col-form-label obbligatorio">Luogo:</label>
      <div class="col-sm-5">
        @if(isset($annuncio->id))
        <input type="luogo"  class="form-control" required name="luogo" id="luogo" value="{{ $annuncio->luogo }}">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @else
        <input type="luogo"  class="form-control" required name="luogo" id="luogo" placeholder="Luogo">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group row mb-3">
      <label for="dettagli" class="col-sm-2 col-form-label obbligatorio">{{ trans('labels.dettagli') }}</label>
      <div class="col-sm-9">
        @if(isset($annuncio->id))
        <textarea type="dettagli" name="dettagli" class="form-control" required id="dettagli" >{{ $annuncio->dettagli }}</textarea>
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @else
        <textarea type="dettagli" name="dettagli" class="form-control" required id="dettagli" placeholder="Dettagli del lavoro offerto"></textarea>
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group row mb-3">
      <label for="richieste" class="col-sm-2 col-form-label obbligatorio">{{ trans('labels.richieste') }}</label>
      <div class="col-sm-9">
        @if(isset($annuncio->id))
        <textarea type="richieste" name="richieste" class="form-control" required id="richieste">{{ $annuncio->richieste }}</textarea>
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @else
        <textarea type="richieste" name="richieste" class="form-control" required id="richieste" placeholder="richieste da parte del datore"></textarea>
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        @endif
      </div>
    </div>
    <div class="form-group row mb-3">
      <label for="tipo_contratto" class="col-sm-2 col-form-label obbligatorio">{{ trans('labels.tipologiaContratto') }}</label>
        <div class="col-sm-5">
          @if(isset($annuncio->id))
          <select type="tipo_contratto" name="tipo_contratto" id="tipo_contratto" required class="form-select" aria-label="Default select example">
            <option selected hidden>{{ $annuncio->tipo_contratto }}</option>
            @foreach($tipo_contratto as $contratto)
              <option value="{{ $contratto }}">{{$contratto}}</option>
            @endforeach
          <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
          </select>
          @else
          <select type="tipo_contratto" name="tipo_contratto" id="tipo_contratto" required class="form-select">
            <option disabled selected value> {{ trans('labels.selezionaOpzione') }} </option>
            @foreach($tipo_contratto as $contratto)
              <option value="{{ $contratto }}">{{$contratto}}</option>
            @endforeach
          <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
          </select>
          @endif
        </div>
      </label>
    </div>
    <div class="container text-center mb-5">
      @if(isset($annuncio->id))
      <button type="submit" class="btn btn-primary btn-lg">{{ trans('labels.save') }}</button>
      @else
      <button type="submit" class="btn btn-primary btn-lg">{{ trans('labels.creaNuovoAnnuncio') }}</button>
      @endif
      <a type="button" href="{{ route('paginaAzienda.index') }}" class="btn btn-primary btn-lg">{{ trans('labels.annulla') }}</a>
    </div>
  </form>

  <script>
  (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
  </script>

</div>

@endsection