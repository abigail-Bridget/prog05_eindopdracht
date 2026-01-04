<x-guest-layout>

    <div style="text-align:center; margin-bottom:1.5rem;">
        <h1 style="
            font-size:2rem;
            font-weight:900;
            margin:0 0 0.6rem 0;
            color:#BA1F33;
            letter-spacing:0.03em;
        ">
            Create your <span style="color:#410B13;">Music World</span> account
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
            Join Music World and start exploring your favorite albums 🎧
        </p>
    </div>

    <div style="
        background:#FFEFF2;
        border:1px solid #F4C7D3;
        border-radius:2rem;
        box-shadow:0 15px 35px rgba(0,0,0,0.25);
        padding:2rem 1.8rem;
    ">

        <form method="POST" action="{{ route('register') }}"
              style="display:flex; flex-direction:column; gap:1.2rem; margin-top:0.5rem;">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name"
                               :value="__('Name')"
                               style="display:block; margin-bottom:0.35rem; font-weight:700; color:#91171F;" />

                <x-text-input id="name"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required autofocus
                              autocomplete="name"
                              style="
                        width:100%;
                        padding:0.65rem 0.8rem;
                        border-radius:0.85rem;
                        border:1px solid #EB9CAD;
                        background:#FFF6F8;
                        font-size:0.95rem;
                    " />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email"
                               :value="__('Email')"
                               style="display:block; margin-bottom:0.35rem; font-weight:700; color:#91171F;" />

                <x-text-input id="email"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
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
                               style="display:block; margin-bottom:0.35rem; font-weight:700; color:#91171F;" />

                <x-text-input id="password"
                              type="password"
                              name="password"
                              required
                              autocomplete="new-password"
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

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation"
                               :value="__('Confirm Password')"
                               style="display:block; margin-bottom:0.35rem; font-weight:700; color:#91171F;" />

                <x-text-input id="password_confirmation"
                              type="password"
                              name="password_confirmation"
                              required
                              autocomplete="new-password"
                              style="
                        width:100%;
                        padding:0.65rem 0.8rem;
                        border-radius:0.85rem;
                        border:1px solid #EB9CAD;
                        background:#FFF6F8;
                        font-size:0.95rem;
                    " />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Bottom row -->
            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-top:0.5rem;
                flex-wrap:wrap;
                gap:0.6rem;
            ">

                <a href="{{ route('login') }}"
                   style="
                        font-size:0.9rem;
                        font-weight:700;
                        color:#7A0F18;
                        text-decoration:none;
                        transition:color .2s ease;
                   "
                   onmouseover="this.style.color='#BA1F33';"
                   onmouseout="this.style.color='#7A0F18';">
                    Already registered?
                </a>

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
                    Register
                </button>

            </div>
        </form>
    </div>

</x-guest-layout>
