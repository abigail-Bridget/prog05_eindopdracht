<section
    style="
        background:#FFEFF2;
        border:1px solid #F4C7D3;
        border-radius:1.5rem;
        padding:2rem 1.8rem;
        box-shadow:0 10px 28px rgba(0,0,0,0.25);
    "
>
    <header style="margin-bottom:1.2rem;">
        <h2 style="
            font-size:1.3rem;
            font-weight:800;
            color:#BA1F33;
            margin:0 0 0.3rem 0;
        ">
            {{ __('Profile Information') }}
        </h2>

        <p style="
            margin:0;
            font-size:0.9rem;
            color:#5b1b26;
        ">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"
          action="{{ route('profile.update') }}"
          style="display:flex; flex-direction:column; gap:1.1rem; margin-top:0.3rem;">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name"
                           :value="__('Name')"
                           style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

            <x-text-input id="name"
                          name="name"
                          type="text"
                          :value="old('name', $user->name)"
                          required
                          autofocus
                          autocomplete="name"
                          style="
                              width:100%;
                              padding:0.65rem 0.85rem;
                              border-radius:0.85rem;
                              border:1px solid #EB9CAD;
                              background:#FFF6F8;
                              font-size:0.95rem;
                          " />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email"
                           :value="__('Email')"
                           style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

            <x-text-input id="email"
                          name="email"
                          type="email"
                          :value="old('email', $user->email)"
                          required
                          autocomplete="username"
                          style="
                              width:100%;
                              padding:0.65rem 0.85rem;
                              border-radius:0.85rem;
                              border:1px solid #EB9CAD;
                              background:#FFF6F8;
                              font-size:0.95rem;
                          " />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top:0.5rem; font-size:0.85rem; color:#5b1b26;">
                    <p style="margin:0 0 0.35rem 0;">
                        {{ __('Your email address is unverified.') }}

                        <button
                            form="send-verification"
                            style="
                                border:none;
                                background:none;
                                padding:0;
                                margin-left:0.15rem;
                                font-size:0.85rem;
                                font-weight:700;
                                color:#7A0F18;
                                cursor:pointer;
                                text-decoration:none;
                            "
                            onmouseover="this.style.color='#BA1F33';"
                            onmouseout="this.style.color='#7A0F18';"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin:0; font-size:0.85rem; font-weight:700; color:#0f7a32;">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display:flex; align-items:center; gap:0.8rem; margin-top:0.4rem;">
            <button type="submit"
                    style="
                        background:linear-gradient(to right,#CD5D67,#BA1F33);
                        color:#ffffff;
                        padding:0.55rem 1.4rem;
                        border-radius:999px;
                        border:none;
                        font-weight:800;
                        font-size:0.95rem;
                        cursor:pointer;
                        box-shadow:0 6px 14px rgba(0,0,0,0.25);
                    ">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="font-size:0.85rem; color:#0f7a32; margin:0;"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
