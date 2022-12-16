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
    <script src="{{ url('/') }}/js/form_check/loginCheck.js"></script>
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

            @include('auth.form.auth_form')
            
        </div>
    </div>
</body>