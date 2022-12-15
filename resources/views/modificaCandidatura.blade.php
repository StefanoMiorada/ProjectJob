@extends('layouts.master')

@section('title')
    Modifica candidatura
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
        <a class="nav-link active" href="{{ route('candidature.index') }}">{{ trans('labels.mieCandidature') }}</a>
</li>
@endsection

@section('right_navbar')
<li class="nav-item"><a class="nav-link" href="{{ route('setLang', ['lang' => 'en']) }}" ><img src="{{ url('/') }}/img/flags/en.png" width="30" class="img-rounded"/></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('setLang', ['lang' => 'it']) }}" ><img src="{{ url('/') }}/img/flags/it.png" width="24" class="img-rounded"/></a></li>
@if($logged)
<li class="nav-item"><a class="nav-link"><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span class="bi bi-box-arrow-right"></span></a></li>
@else 
<li class="nav-item"><a class="nav-link" href="{{ route('user.login',['source' =>'home']) }}"><span class="bi bi-person p-2"></span> {{ trans('labels.login') }}</a></li>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('candidature.index') }}">Area Personale</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('candidature.edit', ['candidature' => $candidatura->id]) }}">Modifica candidatura</a></li>
@endsection

@section('corpo')
<div class="container-fluid">
    <form class="needs-validation" enctype="multipart/form-data" novalidate name="modificaCandidatura" method="post" action="{{ route('candidatura.update', ['id' => $candidatura->id]) }}">
  @csrf
    <div class="form-group row mb-3">
      <label for="lettera motivazionale" class="col-sm-2 col-form-label obbligatorio">Lettera motivazionale: </label>
      <div class="col-sm-5">
        <textarea type="lettera_motivazionale" class="form-control" required name="lettera_motivazionale" id="lettera_motivazionale" rows="10">{{ $candidatura->lettera_motivazionale }}</textarea>
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
      </div>
    </div>
    <div class="form-group row mb-3">
      <label for="cv_path" class="col-sm-2 col-form-label obbligatorio">Curriculum Vitae: </label>
      <div class="col-sm-5">
        <input type="file" class="form-control" required name="cv_path" id="cv_path">
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
      </div>
    </div>
    <div class="container text-center mb-5">
      <button type="submit" class="btn btn-primary btn-lg">{{ trans('labels.save') }}</button>
      <a type="button" href="{{ route('candidature.index') }}" class="btn btn-primary btn-lg">{{ trans('labels.annulla') }}</a>
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