<x-guest-layout>
    <x-jet-authentication-card>
        <section class="login-signup-step forgot-password-screen">
            <div class="container">
                <div class="row">
                    <div class="card cstm-card ml-auto">
                    
                        {{-- <x-jet-validation-errors class="mb-4" /> --}}
                        <div class="card-header">
                            <h2 class="title-big">Reset your Password</h2>
                        </div>

                        <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}" class="form-layout mt-5">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group">
                                <x-jet-input id="email" class="block mt-1 w-full" type="hidden" name="email" :value="old('email', $request->email)" required autofocus />
                            </div>

                            <div class="form-group">
                                <input id="password" class="form-control" type="password" name="password" placeholder="New Password
                                " required autocomplete="new-password">
                                @error('password') <span class="error-text">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Re-enter Password" required autocomplete="new-password" >
                                <small class="error-text d-none">validation Error text</small>
                                @error('password_confirmation') <span class="error-text">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-dark w-100" type="submit">Reset Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>                
    </x-jet-authentication-card>
</x-guest-layout>
