<div class="tab-pane p-4 fade show active" id="login-form-pane" role="tabpanel" aria-labelledby="login-form-tab">
    @if (isset($source))
        @if ($source == 'paginaAzienda')
            <form id="login-form" class="needs-validation" novalidate
                action="{{ route('user.login', ['source' => 'paginaAzienda']) }}" method="post">
        @endif
        @if ($source == 'annunci')
            <form id="login-form" class="needs-validation" novalidate
                action="{{ route('user.login', ['source' => 'annunci']) }}" method="post">
        @endif
        @if ($source == 'home')
            <form id="login-form" class="needs-validation" novalidate
                action="{{ route('user.login', ['source' => 'home']) }}" method="post">
        @endif
    @endif
    @csrf
    <div class="row mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required />
        <div class="invalid-feedback">{{ trans('labels.campoObbligatorio') }}</div>
    </div>
    <div class="row mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required />
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
        @if ($source == 'annunci')
            <a href="{{ route('annunci.index') }}">{{ trans('labels.tornaIndietro') }}</a>
        @else
            <a href="{{ route('home') }}">{{ trans('labels.tornaIndietro') }}</a>
        @endif
    </div>
    </form>
</div>
