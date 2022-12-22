@extends('layouts.master')

@section('title')
Area Personale
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
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
        <a class="nav-link active" href="{{ route('candidature.index') }}">Area Personale</a>
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
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('candidature.index') }}">Area Personale</a></li>
@endsection

@section('corpo')
@if (session()->has('successEdit'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","{{ trans('labels.okMessageEdit') }}","success");
</script>
@elseif (session()->has('successEditUserData'))
<script>
    swal.fire("{{ trans('labels.okMessage') }}","Dati perosnali modificati correttamente","success");
</script>
@endif
    <div class="container text-center mb-5">
        <a type="button" class="btn btn-outline-primary" href="{{route('user.edit', ['user' => $utente->id])}}"><i class="bi bi-pencil-square"></i> Modifica dati personali</a>
    </div>
    <div class="col text-center">
        <h2>Storico delle candidature inviate</h2>
    </div>
    <div class="text-left ">
        <table class="table table-hover" id="tabellaMieCandidature">
            <tr>
                <th>Annnucio di riferimento</th>
                <th>luogo lavorativo dell'annuncio</th>
                <th>Lettera motivazionale</th>
                <th>Curriculum Vitae</th>
            </tr>
        @foreach($candidature as $candidatura)
            <tr>
                <td class="col-2">
                    @foreach($annunci->where('id', $candidatura->id_annuncio) as $annuncio)
                    <div>{{ $annuncio->posizione }}</div>
                    @endforeach
                </td>
                <td class="col-2">
                    @foreach($annunci->where('id', $candidatura->id_annuncio) as $annuncio)
                    <div>{{ $annuncio->luogo }}</div>
                    @endforeach
                </td>
                <td class="col-4">
                    <div>{{ $candidatura->lettera_motivazionale }}</div>
                </td>
                <td class="col-2">
                    <div><a href="#" onClick="window.open('{{ asset('storage/files/'.$candidatura->cv_path) }}'); return false;">{{ $candidatura->cv_path }}</a></div>
                </td>
                <td class="col-1">
                    <a type="button" class="btn btn-outline-primary" href="{{route('candidature.edit', ['candidature' => $candidatura->id])}}"><i class="bi bi-pencil-square"></i> {{ trans('labels.modifica' )}}</a>
                </td>
                <td class="col-1">
                    <a type="button" class="btn btn-outline-danger" href="{{route('candidatura.confirmDestroy', ['id' => $candidatura->id])}}"><i class="bi bi-trash3"></i> {{ trans('labels.elimina' )}}</a>
                </td>
                    
            </tr>
        @endforeach
        </table>
    </div>
@endsection

</script>