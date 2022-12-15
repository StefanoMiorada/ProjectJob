<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">   

    <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/js/myScript.js"></script>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#letteraMotivazionale'
      });
    </script>

    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
</head>

<!--Navbar-->
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ url('/') }}/img/logo_wb.png" alt="JobCamonica" width="70" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav nav-tabs">
                    @yield('left_navbar')
                </ul>
                <ul class="navbar-nav nav-tabs ms-auto">
                    @yield('right_navbar')
                </ul>
            </div>     
        </div>
    </nav>

    <!--Breadcrumb-->
    <div class="container-fluid">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-end">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
    </div>

    @yield('corpo')
</body>