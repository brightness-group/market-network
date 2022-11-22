<x-guest-layout>
    <x-jet-authentication-card>
        <x-jet-validation-errors class="mb-4" />
        <div id="signin_signup" class="show_step">
            <section class="login-signup-step ">
                <div class="container">
                    <div class="row">
                        <div class="card cstm-card ml-auto">
                            <div class="card-header">
                                <h3 class="title">Account</h3>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills " id="login-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="false">SIGN IN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="true">SIGN UP</a>
                                    </li>

                                </ul>
                                <div class="tab-content" id="login-tabContent">
                                    <div class="tab-pane fade" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                                        
                                        <form action="" class="form-layout">
                                            <div class="form-group">
                                                <input id="my-input" class="form-control" type="email" name="" placeholder="Email Address">
                                                <small class="error-text d-none">validation Error text</small>
                                            </div>
                                            <div class="form-group">
                                                <input id="my-input" class="form-control" type="password" name="" placeholder="Pasword">
                                                <small class="error-text d-none">validation Error text</small>
                                            </div>
                                            <div class="form-group mb-3">
                                                <button class="btn btn-dark w-100" type="button">Sign In</button>
                                            </div>
                                            <a href="forgot-password.html" class="link-btn gray-btn forgot-pass">Forgot your password?</a>
                                        </form>
                                    </div>
                                    
                                    <div class="tab-pane fade show active" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                                        <form method="POST" action="{{ route('register') }}" class="form-layout">
                                            @csrf
                                            <div class="form-group">
                                                <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Full Name"/>
                                                <small class="error-text d-none">validation Error text</small>
                                            </div>
                                            <div class="form-group">
                                                <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="Email Address" />
                                                <small class="error-text d-none">validation Error text</small>
                                            </div>
                                            <div class="form-group">
                                                <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password"  placeholder="Pasword" />
                                                <small class="error-text d-none">validation Error text</small>
                                            </div>

                                            <div class="form-group mb-3">
                                            
                                                <x-jet-button class="btn btn-dark w-100">
                                                    {{ __('Sign Up') }}
                                                </x-jet-button>
                                            </div>
                                        
                                            <label class="text-center w-100 or-txt">Or Sign up with:</label>
                                            <div class="cstm-btn-group">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-light">Google</a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-light">Apple</a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-light">Facebook</a>
                                            </div>
                                        </form>
                                        <p class="notes-txt">By clicking Sign up, I agree that I have read and accepted the Terms of Use and Privacy Policy.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>

