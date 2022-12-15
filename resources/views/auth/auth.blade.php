<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>autenticazione</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">

    <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/js/myScript.js"></script>
    <script>
        $( document ).ready(function() {
            formRegistrazioneUtente();
        });  
    </script>

    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>

<body>
    <div class="vh-100 d-flex align-items-center justify-content-center">  
        <div class="col-md-6 ">
            <div>
                @if(isset($message))
                <h4>{{$message}}</h4>
                @endif
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="login-form-tab" data-bs-toggle="tab" href="#login-form-pane" role="tab" aria-controls="login-form-pane" aria-selected="true">{{ trans('labels.login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="register-form-tab" data-bs-toggle="tab" href="#register-form-pane" role="tab" aria-controls="register-form-pane" aria-selected="false">{{ trans('labels.registrati') }}</a>
                </li>
            </ul>
            <div class="tab-content" id="login-registration-form">
                <div class="tab-pane p-4 fade show active" id="login-form-pane" role="tabpanel" aria-labelledby="login-form-tab">
                    @if(isset($source))
                        @if($source == "paginaAzienda")
                        <form id="login-form" class="needs-validation" novalidate action="{{ route('user.login',['source' =>'paginaAzienda']) }}" method="post">
                        @endif
                        @if($source == "annunci")
                        <form id="login-form" class="needs-validation" novalidate action="{{ route('user.login',['source' =>'annunci']) }}" method="post">
                        @endif
                        @if($source == "home")
                        <form id="login-form" class="needs-validation" novalidate action="{{ route('user.login',['source' =>'home']) }}" method="post" >
                        @endif
                    @endif
                    @csrf
                        <div class="row mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                        </div>
                        <div class="row mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                        </div>
                        <div class="row">
                            <button type="submit" name="login-submit" class="btn btn-primary">{{ trans('labels.login') }}</button> 
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPassword">
                                {{ trans('labels.forgotPassword') }}
                                </button>
                            </div>
                        </div>
                        <div class="text-center">
                            @if($source == "annunci")  
                            <a href="{{ route('annunci.index')}}">{{ trans('labels.tornaIndietro') }}</a>
                            @else
                            <a href="{{ route('home')}}">{{ trans('labels.tornaIndietro') }}</a>
                            @endif
                        </div>
                    </form>
                </div>    
                
                <!-- forogot password modal page -->
                <div class="modal top fade" id="forgotPassword" tabindex="-1" aria-labelledby="forgotPasswordLabel"
                    aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                    <div class="modal-dialog" style="width: 400px;">
                        <div class="modal-content text-center">
                            <div class="modal-header h5 text-white bg-primary justify-content-center">
                                Recupera Password 
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5">
                                <p class="py-2">
                                    Inserisci la mail di registrazione e ti verranno inviate le istruzioni per recuperare la password
                                </p>
                                <div class="form-outline">
                                    <input type="email" id="typeEmail" class="form-control my-3" placeholder="Inserisci l'email"/>
                                    
                                </div>
                                <a href="#" class="btn btn-primary w-100">Recupera password</a>
                                <div class="d-flex justify-content-end mt-4">
                                    <a class="" href="{{route('home')}}">Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- registration form -->
                <div class="tab-pane p-3 fade" id="register-form-pane" role="tabpanel" aria-labelledby="register-form-tab">
                    <form id="register-form" name="register-form" class="needs-validation" novalidate action="{{ route('user.register') }}" method="post">
                        @csrf
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_azienda" id="utente_generico" value="0" checked onclick="formRegistrazioneUtente();">
                            <label class="form-check-label" for="utente_generico">
                                Utente generico
                            </label>
                            <button type="button" class="btn bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Per 'Utente Generico' si intende una persona che utilizzerà JobCamonica con lo scopo di consultare offerte di lavoro e candidarsi ad esse, se intendi inserire annunci di lavoro seleziona 'Azienda'"></button>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="is_azienda" id="utente_azienda" value="1" onclick="formRegistrazioneAzienda();">
                            <label class="form-check-label" for="utente_azienda">
                                Azienda
                            </label>
                            <button type="button" class="btn bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="Per 'Azienda' si intende un utente che utilizzerà JobCamonica con lo scopo di inserire annunci di lavoro e consultare le candidature ricevute, se intendi candidarti a delel offerte di lavoro selezione 'utente generico'"></button>
                        </div>
                        <div class="form-group row mb-3">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required/>
                            <div class="invalid-feedback" id="invalid-username">{{ trans('labels.campoObbligatorio') }}</div>
                        </div>

                        <div class="row mb-3">
                            <input type="email" name="email" class="form-control" placeholder="email" required/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }} {{ trans('labels.emailValida') }}</div>
                        </div>

                        <div class="row mb-3"id="div_nome">
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value=""/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                        </div>

                        <div class="row mb-3" id="div_cognome">
                            <input type="text" id="cognome" name="cognome" class="form-control" placeholder="Cognome" value=""/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                        </div>

                        <div class="row mb-3" id="div_nome_azienda">
                            <input type="text" id="nome_azienda" name="nome_azienda" class="form-control" placeholder="Nome Azienda" value=""/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                        </div>

                        <div class="row mb-3">
                            <input type="password"id="password" name="password" class="form-control" placeholder="Password" value="" required/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                        </div>

                        <div class="row mb-3">
                            <input type="password" id="confirm-password"name="confirm-password" class="form-control" placeholder="{{ trans('labels.confirmPassword') }}" value="" required/>
                            <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                            <div id="div_password-incorrect"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="row">
                                <button type="submit" id="register-submit"name="register-submit" class="btn btn-primary">{{ trans('labels.registerNow') }}</button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="text-center">
                                <a href="{{ route('home')}}">{{ trans('labels.tornaIndietro') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
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
        </div>
    </div>
</body>