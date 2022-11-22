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
                                <a class="nav-link" id="pills-signup-tab" href="{{ route('login') }}" role="tab" aria-controls="pills-signup" aria-selected="true">SIGN IN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="true">SIGN UP</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="login-tabContent">
                            <div class="tab-pane fade" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                                
                                <form method="POST" action="{{ route('login') }}" class="form-layout">
                                @csrf 
                                    <div class="form-group">
                                        <input class="form-control"  id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="Email Address">
                                        @error('email') <span class="error-text">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" class="form-control" type="password" name="password" placeholder="Pasword">
                                        @error('password') <span class="error-text">{{ $message }}</span> @enderror
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
                            
                            <div class="tab-pane fade show active" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                                <!-- <form method="POST" action="{{ route('registration') }}" class="form-layout">
                                    @csrf -->
                                <div class="form-layout">
                                    <div class="form-group">
                                        <input wire:model="form.name" class="form-control" required placeholder="Full Name">
                                        @error('form.name') <span class="error-text">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <input wire:model="form.email" class="form-control" required placeholder="Email Address">
                                        @error('form.email') <span class="error-text">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <input wire:model="form.password" type="password" required class="form-control" placeholder="Password">
                                        @error('form.password') <span class="error-text">Your password must be at-least 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase and 1 Numeric.</span> @enderror
                                    </div>
                                    <br />


                                    <div class="form-group mb-3">
                                        <button wire:click="next" class="btn btn-dark w-100">{{ __('Sign Up') }}</button> 
                                    </div>
                                
                                    <label class="text-center w-100 or-txt">Or Sign up with:</label>
                                    <div class="cstm-btn-group">
                                        <a href="{{ url('auth/google') }}" class="btn btn-sm btn-light">Google</a>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-light">Apple</a>
                                        <a href="{{ url('auth/facebook') }}" class="btn btn-sm btn-light">Facebook</a>
                                    </div>
                                </div>
                                <!-- </form> -->

                                <p class="notes-txt">By clicking Sign up, I agree that I have read and accepted the Terms of Use and Privacy Policy.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>