<!-- registration form -->
<div class="tab-pane p-3 fade" id="register-form-pane" role="tabpanel" aria-labelledby="register-form-tab">
    <form id="register-form" name="register-form" class="needs-validation" novalidate action="{{ route('user.register') }}"
        method="post">
        @csrf
        <div class="form-check">
            <input class="form-check-input" type="radio" name="is_azienda" id="utente_generico" value="0" checked
                onclick="formRegistrazioneUtente();">
            <label class="form-check-label" for="utente_generico">
                Utente generico
            </label>
            <span class="bi bi-question-circle" data-bs-placement="right"
                title="Per 'Utente Generico' si intende una persona che utilizzerà JobCamonica con lo scopo di consultare offerte di lavoro e candidarsi ad esse, se intendi inserire annunci di lavoro seleziona 'Azienda'"></span>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="is_azienda" id="utente_azienda" value="1"
                onclick="formRegistrazioneAzienda();">
            <label class="form-check-label" for="utente_azienda">
                Azienda
            </label>
            <span class="bi bi-question-circle" data-bs-placement="right"
                title="Per 'Azienda' si intende un utente che utilizzerà JobCamonica con lo scopo di inserire annunci di lavoro e consultare le candidature ricevute, se intendi candidarti a delle offerte di lavoro selezione 'utente generico'"></span>
        </div>

        <div class="form-group row mb-3" id="registration_username_div">
            <input type="text" id="registration_username" name="username" class="form-control" placeholder="Username" required />
            <div class="invalid-feedback" id="invalid-username">{{ trans('labels.campoObbligatorio') }}</div>
        </div>

        <div class="row mb-3" id="email_div">
            <input type="email" id="email" name="email" class="form-control" placeholder="email" required />
            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }} {{ trans('labels.emailValida') }}
            </div>
        </div>

        <div class="row mb-3"id="div_nome">
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome"
                value="" />
            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        </div>

        <div class="row mb-3" id="div_cognome">
            <input type="text" id="cognome" name="cognome" class="form-control" placeholder="Cognome"
                value="" required/>
            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        </div>

        <div class="row mb-3" id="div_nome_azienda">
            <input type="text" id="nome_azienda" name="nome_azienda" class="form-control" placeholder="Nome Azienda"
                value="" required />
            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        </div>

        <div class="row mb-3" id="registration_password_div">
            <input type="password" id="registration_password" name="password" class="form-control" placeholder="Password"
                value="" required />
            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        </div>

        <div class="row mb-3" id="confirm-password_div">
            <input type="password" id="confirm-password" name="confirm-password" class="form-control"
                placeholder="{{ trans('labels.confirmPassword') }}" value="" required />
            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
        </div>

        <div class="row mb-3">
            <input type="submit" id="register-submit" name="register-submit"
                class="form-control btn btn-primary" value="{{ trans('labels.registerNow') }}"
                onclick="event.preventDefault(); checkRegister('{{ $lang }}');">
        </div>

        <div class="row mb-3">
            <div class="text-center">
                <a href="{{ route('home') }}">{{ trans('labels.tornaIndietro') }}</a>
            </div>
        </div>
    </form>
</div>
