@extends('layouts.master')

@section('title')
JobCamonica Homepage
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a>
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
<li class="nav-item"><a class="nav-link" href="{{ route('user.login',['source' =>'home']) }}"><span class="bi bi-person p-2"></span> {{ trans('labels.login') }}</a></li>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
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
@elseif (session()->has('successNewUser'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","Utente creato in modo corretto","success");
</script>
@elseif (session()->has('successRecupero'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","E' stata inviata un mail con le istruzioni per il recupero della password all'indirizzo indicato","success");
</script>
@endif
<!--Sezione logo e scritta principale-->

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-3 text-center border-end d-flex align-items-center justify-content-center">
            <img src="{{ url('/') }}/img/logo_wb.png" class="img-fluid" alt="logo">
        </div>
        <div class="col-md-9 text-center">
            <h1>{{ trans('labels.homeBodyFirstPart') }}</h1><br />
            <h3>{{ trans('labels.homeBodySecondPart') }}</h3>
            @if($logged)
                @if($is_azienda==0)
                <a type="button" class="btn btn-outline-primary" href="{{ route('candidature.index') }}">Le mie candidature</a>
                @else
                <a type="button" class="btn btn-outline-primary" href="{{ route('paginaAzienda.index') }}">I miei annunci</a>
                @endif
            <a type="button" class="btn btn-outline-primary" href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a>
            @else
            <a type="button" class="btn btn-outline-primary" href="{{ route('user.login',['source' =>'home']) }}">{{ trans('labels.accedi/registrati') }}</a>
            <a type="button" class="btn btn-outline-primary" href="{{ route('annunci.index') }}">{{ trans('labels.annunciDiLavoro') }}</a>
            @endif
        </div>
    </div>
</div>
<!--Sezione statistiche-->
<div class="container-fluid">
    <div class="text-center">
        <h2>{{ trans('labels.statistiche') }}</h2>
    </div>
    <div class="row row-cols-2 row-cols-md-4">
        <div class="col">
            <div class="card" style="width: auto;">
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $numAziende }}</h1>
                    <p class="card-text">{{ trans('labels.aziende') }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: auto;">
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $numUtenti }}</h1>
                    <p class="card-text">{{ trans('labels.utenti') }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: auto;">
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $listaAnnunci->count() }}</h1>
                    <p class="card-text">{{ trans('labels.annunci') }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: auto;">
                <div class="card-body text-center">
                    <h1 class="card-title">{{ $numCandidature }}</h1>
                    <p class="card-text">{{ trans('labels.candidature') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection