<x-guest-layout>

<x-jet-authentication-card>
    <section class="login-signup-step ">
        <div class="container">
            <div class="row">
                <div class="card cstm-card ml-auto">
                    <!-- <x-jet-validation-errors class="mb-4" /> -->

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="card-header">
                        <h3 class="title">Account</h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills " id="login-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="false">SIGN IN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-signup-tab" href="{{ route('registration') }}" role="tab" aria-controls="pills-signup" aria-selected="true">SIGN UP</a>
                            </li>
                        </ul>  
                        <div class="tab-content" id="login-tabContent">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                                <form method="POST" action="{{ route('login') }}" class="form-layout">
                                    @csrf 
                                    <div class="form-group">
                                        <input class="form-control"  id="email" type="email" name="email" :value="old('email')" autofocus placeholder="Email Address">
                                        @error('email') <small class="error-text">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" class="form-control" type="password" name="password" placeholder="Password">
                                        @error('password') <small class="error-text">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <button class="btn btn-dark w-100" type="submit">Sign In</button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="link-btn gray-btn forgot-pass" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </x-jet-authentication-card>
</x-guest-layout>
