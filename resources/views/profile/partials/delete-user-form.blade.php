<section style="
    background:#FFEFF2;
    border:1px solid #F4C7D3;
    border-radius:1.5rem;
    padding:2rem 1.8rem;
    box-shadow:0 10px 28px rgba(0,0,0,0.25);
">
    <header style="margin-bottom:1.2rem;">
        <h2 style="
            font-size:1.3rem;
            font-weight:800;
            color:#BA1F33;
            margin:0 0 0.3rem 0;
        ">
            {{ __('Delete Account') }}
        </h2>

        <p style="
            margin:0;
            font-size:0.9rem;
            color:#5b1b26;
        ">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Grote rode warning-knop in jouw stijl --}}
    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        style="
            margin-top:0.5rem;
            background:linear-gradient(to right,#CD5D67,#BA1F33);
            color:#ffffff;
            padding:0.6rem 1.6rem;
            border-radius:999px;
            border:none;
            font-weight:800;
            font-size:0.95rem;
            cursor:pointer;
            box-shadow:0 6px 14px rgba(0,0,0,0.25);
        "
    >
        {{ __('Delete Account') }}
    </button>

    {{-- Modal in zelfde kleur-sfeer --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}"
              style="
                    padding:2rem;
                    background:#FFEFF2;
                    border-radius:1.2rem;
              ">
            @csrf
            @method('delete')

            <h2 style="
                font-size:1.2rem;
                font-weight:800;
                color:#BA1F33;
                margin:0 0 0.4rem 0;
            ">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p style="
                margin:0;
                font-size:0.9rem;
                color:#5b1b26;
            ">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div style="margin-top:1.2rem;">
                <x-input-label for="password"
                               :value="__('Password')"
                               style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                    style="
                        width:100%;
                        padding:0.65rem 0.85rem;
                        border-radius:0.85rem;
                        border:1px solid #EB9CAD;
                        background:#FFF6F8;
                        font-size:0.95rem;
                    "
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div style="
                margin-top:1.5rem;
                display:flex;
                justify-content:flex-end;
                gap:0.8rem;
            ">
                {{-- Cancel-knop in zachte stijl --}}
                <button type="button"
                        x-on:click="$dispatch('close')"
                        style="
                            padding:0.55rem 1.2rem;
                            border-radius:999px;
                            border:1px solid #EB9CAD;
                            background:#FFF6F8;
                            color:#7A0F18;
                            font-weight:700;
                            font-size:0.9rem;
                            cursor:pointer;
                        ">
                    {{ __('Cancel') }}
                </button>

                {{-- Extra duidelijke rode delete-knop --}}
                <button type="submit"
                        style="
                            background:linear-gradient(to right,#BA1F33,#91171F);
                            color:#ffffff;
                            padding:0.55rem 1.4rem;
                            border-radius:999px;
                            border:none;
                            font-weight:800;
                            font-size:0.9rem;
                            cursor:pointer;
                            box-shadow:0 6px 14px rgba(0,0,0,0.3);
                        ">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
