<x-layout>
    <div style="
        min-height:80vh;
        padding:3rem 1.5rem;
        font-family:'Poppins','Quicksand','Nunito',sans-serif;
    ">

        {{-- Titel --}}
        <div style="text-align:center; margin-bottom:2rem;">
            <h1 style="
                font-size:2.1rem;
                font-weight:900;
                margin:0 0 0.4rem 0;
                color:#ffffff;
                text-shadow:0 2px 8px rgba(0,0,0,0.4);
            ">
                Edit Album 🎶
            </h1>

            <p style="
                font-size:0.95rem;
                color:#FFE3EA;
                margin:0;
            ">
                Updating: <strong>{{ $album->name }}</strong>
            </p>
        </div>

        <div style="max-width:700px; margin:0 auto;">

            {{-- Errors --}}
            @if ($errors->any())
                <div style="
                    background:#FFE3E8;
                    border:1px solid #F199A8;
                    color:#7A0F18;
                    border-radius:1rem;
                    padding:0.9rem 1rem;
                    font-size:0.9rem;
                    margin-bottom:1.2rem;
                ">
                    <ul style="margin:0; padding-left:1.1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card --}}
            <div style="
                background:#FFEFF2;
                border:1px solid #F4C7D3;
                border-radius:1.5rem;
                padding:2rem 1.8rem;
                box-shadow:0 10px 28px rgba(0,0,0,0.25);
            ">
                <form method="POST"
                      action="{{ route('music.update', $album->id) }}"
                      style="display:flex; flex-direction:column; gap:1.1rem;">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name"
                                       :value="__('Name')"
                                       style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

                        <x-text-input id="name"
                                      name="name"
                                      type="text"
                                      :value="old('name', $album->name)"
                                      required
                                      style="
                                          width:100%;
                                          padding:0.65rem 0.85rem;
                                          border-radius:0.85rem;
                                          border:1px solid #EB9CAD;
                                          background:#FFF6F8;
                                          font-size:0.95rem;
                                      " />

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Artists --}}
                    <div>
                        <x-input-label for="artists"
                                       :value="__('Artists')"
                                       style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

                        <x-text-input id="artists"
                                      name="artists"
                                      type="text"
                                      :value="old('artists', $album->artists)"
                                      required
                                      style="
                                          width:100%;
                                          padding:0.65rem 0.85rem;
                                          border-radius:0.85rem;
                                          border:1px solid #EB9CAD;
                                          background:#FFF6F8;
                                          font-size:0.95rem;
                                      " />

                        <x-input-error :messages="$errors->get('artists')" class="mt-2" />
                    </div>

                    {{-- Genre --}}
                    <div>
                        <x-input-label for="genre"
                                       :value="__('Genre')"
                                       style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

                        <x-text-input id="genre"
                                      name="genre"
                                      type="text"
                                      :value="old('genre', $album->genre)"
                                      required
                                      style="
                                          width:100%;
                                          padding:0.65rem 0.85rem;
                                          border-radius:0.85rem;
                                          border:1px solid #EB9CAD;
                                          background:#FFF6F8;
                                          font-size:0.95rem;
                                      " />

                        <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                    </div>

                    {{-- Year --}}
                    <div>
                        <x-input-label for="year"
                                       :value="__('Year')"
                                       style="display:block; margin-bottom:0.25rem; font-weight:700; color:#91171F;" />

                        <x-text-input id="year"
                                      name="year"
                                      type="text"
                                      :value="old('year', $album->year)"
                                      required
                                      style="
                                          width:100%;
                                          padding:0.65rem 0.85rem;
                                          border-radius:0.85rem;
                                          border:1px solid #EB9CAD;
                                          background:#FFF6F8;
                                          font-size:0.95rem;
                                      " />

                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    {{-- Buttons --}}
                    <div style="
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                        margin-top:0.6rem;
                        gap:0.75rem;
                        flex-wrap:wrap;
                    ">
                        <a href="{{ route('music.catalog') }}"
                           style="
                               font-size:0.9rem;
                               color:#7A0F18;
                               text-decoration:none;
                           ">
                            ← Back to catalog
                        </a>

                        <button type="submit"
                                style="
                                    background:linear-gradient(to right,#CD5D67,#BA1F33);
                                    color:#ffffff;
                                    padding:0.6rem 1.6rem;
                                    border-radius:999px;
                                    border:none;
                                    font-weight:800;
                                    font-size:0.95rem;
                                    cursor:pointer;
                                    box-shadow:0 6px 14px rgba(0,0,0,0.25);
                                ">
                            Save changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-layout>
