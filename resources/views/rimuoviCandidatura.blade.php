@extends('layouts.master')

@section('title')
    Rimozione candidatura
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
<li class="nav-item"><a class="nav-link" href="{{ route('user.login',['source' =>'annunci']) }}"><span class="bi bi-person p-2"></span> {{ trans('labels.login') }}</a></li>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('candidature.index') }}">Mie Candidature</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('candidatura.confirmDestroy',['id'=>$candidatura->id]) }}">{{ trans('labels.rimuoviCandidatura') }}</a></li>
@endsection

@section('corpo')
<div class=" d-flex align-items-center justify-content-center text-center">
        <div class="col-md-6 ">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading"><i class="bi bi-exclamation-triangle"></i>{{ trans('labels.attenzione!') }}</h4>
                <p>{{ trans('labels.confermaRimozioneCandidatura') }} {{ $annuncio->posizione }}?</p>
                <hr>
                <p><a type="button" class="btn btn-outline-primary" href="{{route('candidatura.destroy', ['id' => $candidatura->id])}}"><i class="bi bi-trash3"></i> {{ trans('labels.si') }}</a>
                <a type="button" class="btn btn-outline-primary" href="{{ route('candidature.index') }}"><i class="bi bi-box-arrow-left"></i> No</a> </p>
            </div>
        </div>
    </div>
@endsection