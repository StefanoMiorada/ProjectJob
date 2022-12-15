@extends('layouts.master')

@section('title')
  Modifica Dati Personali
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
  @if($is_azienda==1)
    <a class="nav-link active" href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a>
  @else
    <a class="nav-link active" href="{{ route('candidature.index') }}">Area Personale</a>
  @endif
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
@if($is_azienda==1)
  <li class="breadcrumb-item"><a href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a></li>
@else
  <li class="breadcrumb-item"><a href="{{ route('candidature.index') }}">Area Personale</a></li>
@endif
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.edit', ['user' => $utente->id]) }}">Modifica dati</a></li>
@endsection

@section('corpo')
<div class="container-fluid">
    <form class="needs-validation" novalidate name="modificaDati" method="post" action="{{ route('user.update', ['id' => $utente->id]) }}">
  @csrf
  <div class="form-group row mb-3">
      <label for="Username" class="col-sm-2 col-form-label obbligatorio">Username:</label>
      <div class="col-sm-5">
        <input type="Username" class="form-control" required name="Username" id="Username" value="{{ $utente->username }}">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
      </div>
    </div>
    <div class="form-group row mb-3">
      <label for="Email" class="col-sm-2 col-form-label obbligatorio">Email:</label>
      <div class="col-sm-5">
        <input type="Email" class="form-control" required name="Email" id="Email" value="{{ $utente->email }}">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
      </div>
    </div>
    @if($is_azienda==1)
    <div class="form-group row mb-3">
      <label for="NomeAzienda" class="col-sm-2 col-form-label obbligatorio">Nome Azienda:</label>
      <div class="col-sm-5">
        <input type="NomeAzienda" class="form-control" required name="NomeAzienda" id="NomeAzienda" value="{{ $utente->nome_azienda }}">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
      </div>
    </div>
    @endif
    @if($is_azienda==0)
    <div class="form-group row mb-3">
      <label for="Nome" class="col-sm-2 col-form-label obbligatorio">Nome:</label>
      <div class="col-sm-5">
        <input type="Nome" class="form-control" required name="Nome" id="Nome" value="{{ $utente->nome }}">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
      </div>
    </div>
    <div class="form-group row mb-3">
      <label for="Cognome" class="col-sm-2 col-form-label obbligatorio">Cognome:</label>
      <div class="col-sm-5">
        <input type="Cognome" class="form-control" required name="Cognome" id="Cognome" value="{{ $utente->cognome }}">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
      </div>
    </div>
    @endif


    
    <div class="container text-center mb-5">
      <button type="submit" class="btn btn-primary btn-lg">{{ trans('labels.save') }}</button>
      @if($is_azienda==1)
      <a type="button" href="{{ route('paginaAzienda.index') }}" class="btn btn-primary btn-lg">{{ trans('labels.annulla') }}</a>
      @else
      <a type="button" href="{{ route('candidature.index') }}" class="btn btn-primary btn-lg">{{ trans('labels.annulla') }}</a>
      @endif
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