@extends('layouts.master')

@section('title')
    @if($loggedName)
      @if(isset($annuncio->id))
        candidatura annuncio
      @endif
    @endif 
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a>
</li>
<li class="nav-item">
    <a class="nav-link " href="{{ route('paginaAzienda.index') }}">{{ trans('labels.paginaPersonaleAzienda') }}</a>
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
<li class="breadcrumb-item"><a href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('annuncio.candidati', ['id' => $annuncio->id]) }}">{{ trans('labels.candidaturaAnnuncio') }}</a></li>
@endsection

@section('corpo')


<div class="container-fluid">
    <div class="container text-center mb-5">
    <p><h3>{{ trans('labels.annuncioDiRiferimento') }} <b>{{ $annuncio->posizione }}</b></h3></p>
    <p><h3>{{ trans('labels.luogo') }} <b>{{ $annuncio->luogo }}</b></h3></p>
    <a type="button" class="btn btn-outline-primary" href="{{ route('annunci.index') }}"><i class="bi bi-box-arrow-left"></i> {{ trans('labels.tornaIndietro') }}</a>
</div>
<hr>
<form class="needs-validation" novalidate name="candidaturaAnnuncio" method="post" enctype="multipart/form-data" action="{{ route('annuncio.inviaCandidatura', ['id' => $annuncio->id]) }}">
    @csrf
    <div class="form-group row mb-4">
      <label for="letteraMotivazionale" class="col-sm-2 col-form-label">{{ trans('labels.letteraMotivazionale') }}</label>
      <div class="col-sm-9">
        <textarea type="letteraMotivazionale" name="letteraMotivazionale" class="form-control" id="letteraMotivazionale" placeholder="Scrivi qui la tua lettera motivazionale" rows="10" style="height:100%;" required></textarea>
        <div class="invalid-feedback">{{ trans('labels.letteraMotivazionaleObbligatoria') }}</div>
        <!-- <span id="invalid-letteraMotivazionale"></span> -->
      </div>
    </div>
    <div class="form-group row mb-4">
      <label for="cv_path" class="col-sm-2 col-form-label">CV: </label>
      <div class="col-sm-9">
        <input type="file" class="form-control" name="cv_path" id="cv_path" required>
        <div class="invalid-feedback">{{ trans('labels.cvObbligatorio') }}</div>
        <!-- <span id="invalid-cv_path"></span> -->
      </div>
    </div>
    <div class="container text-center mb-5">
        <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-send"></i> {{ trans('labels.invia') }}</button>
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