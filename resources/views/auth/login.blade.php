<x-guest-layout>

    <div style="text-align:center; margin-bottom:1.5rem;">
        <h1 style="
            font-size:2rem;
            font-weight:900;
            margin:0 0 0.6rem 0;
            color:#BA1F33;
            letter-spacing:0.03em;
        ">
            Log in to <span style="color:#410B13;">Music World</span>
        </h1>

        <p style="
            font-size:0.9rem;
            color:#5b1b26;
            margin:0;
            display:inline-block;
            padding:0.4rem 0.9rem;
            border-radius:999px;
            background:rgba(255,255,255,0.75);
            box-shadow:0 3px 6px rgba(0,0,0,0.12);
        ">
            Welcome back! Enter your details to continue exploring albums 🎧
        </p>
    </div>


    <div style="
        background:#FFEFF2;
        border:1px solid #F4C7D3;
        border-radius:2rem;
        box-shadow:0 15px 35px rgba(0,0,0,0.25);
        padding:2rem 1.8rem;
    ">

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}"
              style="display:flex; flex-direction:column; gap:1rem; margin-top:0.8rem;">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email"
                               :value="__('Email')"
                               style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F; text-align:left;" />

                <x-text-input id="email"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required autofocus
                              autocomplete="username"
                              style="
                        width:100%;
                        padding:0.65rem 0.8rem;
                        border-radius:0.85rem;
                        border:1px solid #EB9CAD;
                        background:#FFF6F8;
                        font-size:0.95rem;
                    " />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password"
                               :value="__('Password')"
                               style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F; text-align:left;" />

                <x-text-input id="password"
                              type="password"
                              name="password"
                              required
                              autocomplete="current-password"
                              style="
                        width:100%;
                        padding:0.65rem 0.8rem;
                        border-radius:0.85rem;
                        border:1px solid #EB9CAD;
                        background:#FFF6F8;
                        font-size:0.95rem;
                    " />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div style="margin-top:0.15rem;">
                <label style="display:flex; align-items:center; gap:0.35rem; cursor:pointer;">
                    <input type="checkbox" name="remember" style="accent-color:#BA1F33;">
                    <span style="font-size:0.85rem; color:#6e3540;">
                        Remember me
                    </span>
                </label>
            </div>

            <!-- Buttons row -->
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap;">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       style="
                            font-size:0.9rem;
                            font-weight:700;
                            color:#7A0F18;
                            text-decoration:none;
                            transition:color .2s ease;
                       "
                       onmouseover="this.style.color='#BA1F33';"
                       onmouseout="this.style.color='#7A0F18';">
                        Forgot password?
                    </a>
                @endif

                <button type="submit"
                        style="
                            background:linear-gradient(to right,#CD5D67,#BA1F33);
                            color:#ffffff;
                            padding:0.6rem 1.5rem;
                            border-radius:999px;
                            border:none;
                            font-weight:800;
                            font-size:0.95rem;
                            cursor:pointer;
                            box-shadow:0 6px 14px rgba(0,0,0,0.25);
                        ">
                    Log in
                </button>
            </div>

        </form>
    </div>

</x-guest-layout>
