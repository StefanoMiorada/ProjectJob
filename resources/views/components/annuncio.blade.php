<tr class="annuncio_tr" id="annuncio-{{ $annuncio->id }}">
    <td class="col-8" style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">
        <div>
            <h3 class="annuncio-posizione"><b>{{ $annuncio->posizione }}</b></h3>
        </div>
        <div><i class="bi bi-geo-alt"></i> <span class="annuncio-luogo">{{ $annuncio->luogo }}</span></div>
        <div><i><b>Dettagli: </b></i><span class="annuncio-dettagli">{{ $annuncio->dettagli }}</span></div>
        <div class="pt-1"><i><b>Richieste: </b></i>
            <span class="annuncio-richieste">{{ $annuncio->richieste }}</span>
        </div>
        <div class="pt-1"><i><b>{{ trans('labels.contratto') }} </b></i>
            <span class="annuncio-contratto contratto-{{ str_replace(" ", "-", $annuncio->tipo_contratto) }}">{{ $annuncio->tipo_contratto }}</span>
        </div>
    </td>
    <td class="col-1">
        @if ($logged == false)
            <a type="button" class="btn btn-outline-primary"
                href="{{ route('user.login', ['source' => 'annunci', 'message' => 'True']) }}"><i
                    class="bi bi-box-arrow-up-right"></i> {{ trans('labels.candidati') }}</a>
        @else
            @if ($is_azienda == 0)
                <a type="button" class="btn btn-outline-primary"
                    href="{{ route('annuncio.candidati', ['id' => $annuncio->id]) }}"><i
                        class="bi bi-box-arrow-up-right"></i>
                    {{ trans('labels.candidati') }}</a>
            @else
                <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="non è possibile candidarsi con un account aziendale">
                    <button class="btn btn-outline-primary" disabled><i class="bi bi-x-circle"></i>
                        {{ trans('labels.candidati') }}</button>
                </span>
            @endif
        @endif
    </td>
</tr>
