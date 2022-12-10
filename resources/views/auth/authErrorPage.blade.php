<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Errore autenticazione</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">

    <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

    <div class="vh-100 d-flex align-items-center justify-content-center text-center">
        <div class="col-md-6 ">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"><i class="bi bi-exclamation-triangle"></i>{{ trans('labels.erroreDiAutenticazione') }}</h4>
                <p>{{ trans('labels.credenzialiSbagliate') }}</p>
                <hr>
                <p><a type="button" class="btn btn-light" href="{{ route('home') }}"><i class="bi bi-box-arrow-left"></i> {{ trans('labels.tornaAllaHome') }}</a>               
            </div>
        </div>
    </div>
</body>
</htm>