<!DOCTYPE html>
<htm>
    <head>
        <meta charset="UTF-8">
        <title>User authentication</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css4/bootstrap.css">
        <link rel="stylesheet" href="{{ url('/') }}/css4/style.css">
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js4/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/js/myScript.js"></script>
        <script>
          $( document ).ready(function() {
            formLogin();
        });  
        </script>
        
    </head>

    <body>
        <div class="container">
            <div class="row" style="margin-top: 4em">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#login-form" data-toggle="tab">{{ trans('labels.login') }}</a></li>
                            <li><a href="#register-form" data-toggle="tab">{{ trans('labels.registrati') }}</a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane active" id="login-form">
                            @if(isset($source))
                                @if($source == "paginaAzienda")
                                <form id="login-form" class="needs-validation" novalidate action="{{ route('user.login',['source' =>'paginaAzienda']) }}" method="post" style="margin-top: 2em">
                                @endif
                                @if($source == "annunci")
                                <form id="login-form" class="needs-validation" novalidate action="{{ route('user.login',['source' =>'annunci']) }}" method="post" style="margin-top: 2em">
                                @endif
                            @endif
                            <form id="login-form" class="needs-validation" novalidate action="{{ route('user.login',['source' =>'home']) }}" method="post" style="margin-top: 2em">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group text-center">
                                    <input type="checkbox" name="remember">
                                    <label for="remember">{{ trans('labels.remember') }}</label>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" class="form-control btn btn-primary" value="{{ trans('labels.login') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <a href="#">{{ trans('labels.forgotPassword') }}</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <a href="{{ route('home')}}">Back home</a>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane" id="register-form">
                            <form id="register-form" class="needs-validation" novalidate action="{{ route('user.register') }}" method="post" style="margin-top: 2em">
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_azienda" id="utente_generico" value="0" checked onclick="formLogin();">
                                    <label class="form-check-label" for="utente_generico">
                                        Utente generico
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_azienda" id="utente_azienda" value="1" onclick="formRegistrazione();">
                                    <label class="form-check-label" for="utente_azienda">
                                        Azienda
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="email" value="" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="cognome" name="cognome" class="form-control" placeholder="Cognome" value="" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="nome_azienda" name="nome_azienda" class="form-control" placeholder="Nome Azienda" value="" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="confirm-password" class="form-control" placeholder="{{ trans('labels.confirmPassword') }}" value="" required/>
                                    <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" class="form-control btn btn-primary" value="{{ trans('labels.registerNow') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <a href="{{ route('home')}}">Back home</a>
                                    </div>
                                </div>
                            </form>
                            <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</htm>