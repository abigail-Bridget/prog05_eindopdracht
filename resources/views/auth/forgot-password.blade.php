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
                    max-width:460px;
                    width:100%;
                    padding:2.5rem 2rem;">

            <h1 style="font-size:1.8rem;
                       font-weight:800;
                       color:#410B13;
                       margin:0 0 0.75rem 0;
                       text-align:center;">
                Forgot your password?
            </h1>

            <p style="font-size:0.95rem;
                      color:#742632;
                      text-align:center;
                      margin:0 0 1.5rem 0;">
                No worries — enter your email address and we'll send you a reset link ✉️
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" style="display:flex; flex-direction:column; gap:1.2rem;">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email"
                                   :value="__('Email')"
                                   style="display:block; margin-bottom:0.35rem; font-weight:600; color:#410B13; text-align:left;" />

                    <x-text-input id="email"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autofocus
                                  style="width:100%; padding:0.6rem 0.8rem; border-radius:0.6rem;
                               border:1px solid #e2d1d5; font-size:0.95rem;" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Button -->
                <div style="display:flex; justify-content:flex-end;">

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
                        Email Password Reset Link
                    </button>

                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
