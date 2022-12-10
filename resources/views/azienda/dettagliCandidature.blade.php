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
<div class="container text-center mb-5">
    <p><h3>{{ trans('labels.annuncioDiRiferimento') }} <b>{{ $annuncio->posizione }}</b></h3></p>
    <p><h3>{{ trans('labels.candidatureRicevute') }} <b>{{ $dettagliUtentiCandidature->count() }}</b></h3></p>
    <a type="button" class="btn btn-outline-primary" href="{{ route('paginaAzienda.index') }}"><i class="bi bi-box-arrow-left"></i> {{ trans('labels.tornaIndietro') }}</a>
</div>
<hr>
@if ($dettagliUtentiCandidature->count() == 0)
<div class="container text-center mb-5">
    <h3>{{ trans('labels.nessunaCandidatura') }}</h3>
</div>
@else
<div class="col-md-12 text-left">
    <table class="table table-secondary table-hover">
    @foreach($dettagliUtentiCandidature as $candidatura)
    <tr>
        <td>
            <table class="table table-light ">
                <tr><td><b>{{ trans('labels.usernameCandidato') }}</b> {{ $candidatura->username }}</td></tr>
                <tr><td><b>{{ trans('labels.nomeCandidato') }}</b> {{ $candidatura->nome }}</td></tr>   
                <tr><td><b>{{ trans('labels.cognomeCandidato') }}</b> {{ $candidatura->cognome }}</td></tr>
                <tr><td><b>{{ trans('labels.emailCandidato') }}</b> {{ $candidatura->email }}</td></tr>
                <tr><td><b>{{ trans('labels.letteraMotivazionale') }}</b> {{ $candidatura->lettera_motivazionale }}</td></tr>
                <tr><td><b>CV:</b> <a href="#" onClick="window.open('{{ asset('storage/files/'.$candidatura->cv_path) }}'); return false;">{{ $candidatura->cv_path }}</a></td></tr>
            </table>
        </td>
    </tr>
    @endforeach
    </table>
</div>
@endif

</div>
@endsection