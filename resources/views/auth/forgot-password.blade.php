<x-guest-layout>
    <x-jet-authentication-card>
    <section class="login-signup-step forgot-password-screen">
        <div class="container">
            <div class="row">
                <div class="card cstm-card ml-auto">
                    <div class="card-header">
                        <h2 class="title-big">Forgot your password?</h2>
                        <h3 class="title-sub-title">Enter your email address. You will receive a link via e-mail to set a new password.</h3>
                    </div>        
                    @if (session('status'))
                        <div class="mb-4 alert alert-success text-green-600" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-jet-validation-errors class="mb-4 alert alert-danger" />

                    <form method="POST" action="{{ route('password.email') }}" class="form-layout mt-5">
                        @csrf
                        <div class="form-group">
                            <input id="email" class="form-control" ttype="email" name="email" :value="old('email')" required autofocus placeholder="Enter an email address
                            ">
                            <small class="error-text d-none">validation Error text</small>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-dark w-100" >{{ __('Email Password Reset Link') }}</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </section>
    </x-jet-authentication-card>
</x-guest-layout>
