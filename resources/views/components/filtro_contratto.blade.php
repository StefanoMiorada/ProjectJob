<tr class="filtro-contratto" id="contratto-{{ str_replace(" ", "-", $contratto) }}">
    <td>
        <input class="form-check-input" type="radio" id="filtro_contratto" name="chx"
            value="{{ $contratto }}" onclick="lancia_ricerca()">
        <label class="form-check-label" for="chx">
            @if (isset($conteggio_contratti[$contratto]))
                <!-- {{ $contratto }} <b>({{ $conteggio_contratti[$contratto] }})</b> -->
                {{ $contratto }} <span
                    class="badge bg-secondary rounded-pill ">{{ $conteggio_contratti[$contratto] }}</span>
            @else
                {{ $contratto }} <span class="badge bg-secondary rounded-pill ">0</span>
            @endif
        </label>
    </td>
</tr>