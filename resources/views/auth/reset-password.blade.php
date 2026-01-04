<x-guest-layout>
    <div style="min-height:100vh;
                display:flex;
                align-items:center;
                justify-content:center;
                padding:2rem;
                background: linear-gradient(to bottom right, #CD5D67, #BA1F33, #91171F);
                font-family:'Poppins','Quicksand','Nunito',sans-serif;">

        <div style="background:rgba(255,255,255,0.95);
                    border-radius:1rem;
                    box-shadow:0 8px 20px rgba(0,0,0,0.35);
                    max-width:480px;
                    width:100%;
                    padding:2.5rem 2rem;">

            <h1 style="font-size:1.9rem;
                       font-weight:800;
                       color:#410B13;
                       text-align:center;
                       margin:0 0 0.75rem 0;">
                Reset your password
            </h1>

            <p style="font-size:0.95rem;
                      color:#742632;
                      text-align:center;
                      margin:0 0 1.7rem 0;">
                Choose a new password to access your account 🔐
            </p>

            <form method="POST" action="{{ route('password.store') }}"
                  style="display:flex; flex-direction:column; gap:1.2rem;">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email"
                                   :value="__('Email')"
                                   style="display:block; margin-bottom:0.35rem; font-weight:600; color:#410B13;" />

                    <x-text-input id="email"
                                  type="email"
                                  name="email"
                                  :value="old('email', $request->email)"
                                  required
                                  autofocus
                                  autocomplete="username"
                                  style="width:100%; padding:0.6rem 0.8rem;
                               border-radius:0.6rem;
                               border:1px solid #e2d1d5;
                               font-size:0.95rem;" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password"
                                   :value="__('Password')"
                                   style="display:block; margin-bottom:0.35rem; font-weight:600; color:#410B13;" />

                    <x-text-input id="password"
                                  type="password"
                                  name="password"
                                  required
                                  autocomplete="new-password"
                                  style="width:100%; padding:0.6rem 0.8rem;
                               border-radius:0.6rem;
                               border:1px solid #e2d1d5;
                               font-size:0.95rem;" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm -->
                <div>
                    <x-input-label for="password_confirmation"
                                   :value="__('Confirm Password')"
                                   style="display:block; margin-bottom:0.35rem; font-weight:600; color:#410B13;" />

                    <x-text-input id="password_confirmation"
                                  type="password"
                                  name="password_confirmation"
                                  required
                                  autocomplete="new-password"
                                  style="width:100%; padding:0.6rem 0.8rem;
                               border-radius:0.6rem;
                               border:1px solid #e2d1d5;
                               font-size:0.95rem;" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Button -->
                <div style="display:flex; justify-content:flex-end; margin-top:0.5rem;">
                    <button type="submit"
                            style="background:#CD5D67;
                                   color:#ffffff;
                                   padding:0.6rem 1.3rem;
                                   border-radius:0.7rem;
                                   border:none;
                                   font-weight:700;
                                   cursor:pointer;
                                   box-shadow:0 4px 8px rgba(0,0,0,0.25);
                                   transition:all .2s;">
                        Reset password
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
