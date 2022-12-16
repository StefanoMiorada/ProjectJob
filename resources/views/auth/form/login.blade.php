<div class="tab-pane p-4 fade show active" id="login-form-pane" role="tabpanel" aria-labelledby="login-form-tab">
    @if (isset($source))
        @if ($source == 'paginaAzienda')
            <form name="login-form" class="needs-validation" novalidate
                action="{{ route('user.login', ['source' => 'paginaAzienda']) }}" method="post">
        @endif
        @if ($source == 'annunci')
            <form name="login-form" class="needs-validation" novalidate
                action="{{ route('user.login', ['source' => 'annunci']) }}" method="post">
        @endif
        @if ($source == 'home')
            <form name="login-form" class="needs-validation" novalidate
                action="{{ route('user.login', ['source' => 'home']) }}" method="post">
        @endif
    @endif
    @csrf
    <div class="row mb-3">
        <div class="form-group" id="username_div">
            <input id="username" type="text" name="username" class="form-control" placeholder="Username">
            <span class="invalid-feedback">{{ trans("labels.inserireUsername") }}</span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="form-group" id="password_div">
            <input id="password" type="password" name="password" class="form-control" placeholder="Password">
            <span class="invalid-feedback">{{ trans("labels.inserirePassword") }}</span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="form-group">
            <input type="submit" name="login-submit" class="form-control btn btn-primary"
                value="{{ trans('labels.login') }}"
                onclick="event.preventDefault(); checkLogin('{{ $lang }}');">
        </div>
    </div>
    <div class="form-group">
        <div class="text-center">
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPassword">
                {{ trans('labels.forgotPassword') }}
            </button>
        </div>
    </div>
    <div class="text-center">
        @if ($source == 'annunci')
            <a href="{{ route('annunci.index') }}">{{ trans('labels.tornaIndietro') }}</a>
        @else
            <a href="{{ route('home') }}">{{ trans('labels.tornaIndietro') }}</a>
        @endif
    </div>
    </form>
</div>
