<section
    style="
        background:#FFEFF2;
        border:1px solid #F4C7D3;
        border-radius:1.5rem;
        padding:1.8rem 1.6rem;
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
            {{ __('Update Password') }}
        </h2>

        <p style="
            margin:0;
            font-size:0.9rem;
            color:#5b1b26;
        ">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}"
          style="display:flex; flex-direction:column; gap:1.1rem; margin-top:0.3rem;">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password"
                           :value="__('Current Password')"
                           style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

            <x-text-input id="update_password_current_password"
                          name="current_password"
                          type="password"
                          autocomplete="current-password"
                          style="
                    width:100%;
                    padding:0.65rem 0.85rem;
                    border-radius:0.85rem;
                    border:1px solid #EB9CAD;
                    background:#FFF6F8;
                    font-size:0.95rem;
                " />

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <x-input-label for="update_password_password"
                           :value="__('New Password')"
                           style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

            <x-text-input id="update_password_password"
                          name="password"
                          type="password"
                          autocomplete="new-password"
                          style="
                    width:100%;
                    padding:0.65rem 0.85rem;
                    border-radius:0.85rem;
                    border:1px solid #EB9CAD;
                    background:#FFF6F8;
                    font-size:0.95rem;
                " />

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation"
                           :value="__('Confirm Password')"
                           style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

            <x-text-input id="update_password_password_confirmation"
                          name="password_confirmation"
                          type="password"
                          autocomplete="new-password"
                          style="
                    width:100%;
                    padding:0.65rem 0.85rem;
                    border-radius:0.85rem;
                    border:1px solid #EB9CAD;
                    background:#FFF6F8;
                    font-size:0.95rem;
                " />

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
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

            @if (session('status') === 'password-updated')
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
