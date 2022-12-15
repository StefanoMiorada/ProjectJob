<!-- forogot password modal page -->
<div class="modal top fade" id="forgotPassword" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
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
                    <input type="email" id="typeEmail" class="form-control my-3" placeholder="Inserisci l'email" />

                </div>
                <a href="{{ route('recuperaPassword') }}" class="btn btn-primary w-100">Recupera password</a>
                <div class="d-flex justify-content-end mt-4">
                    <a class="" href="{{ route('home') }}">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
