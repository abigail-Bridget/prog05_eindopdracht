<x-layout>
    <div style="
        min-height: 80vh;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        padding:3rem;
        font-family: 'Poppins', 'Quicksand', 'Nunito', sans-serif;
        background: linear-gradient(to bottom right, #CD5D67, #BA1F33, #91171F);
        color:#FFD6E8;
        text-align:center;
    ">

        {{-- ALBUM IMAGE --}}
        @if($album->image_path)
            <img src="{{ asset('images/' . $album->image_path) }}"
                 alt="{{ $album->name }}"
                 style="
                    width:260px;
                    height:260px;
                    object-fit:cover;
                    border-radius:1.2rem;
                    box-shadow:0 10px 25px rgba(0,0,0,0.35);
                    margin-bottom:1.8rem;
                 ">
        @endif

        {{-- TITEL --}}
        <h1 style="
            font-size:2.5rem;
            font-weight:700;
            color:#ffffff;
            margin-bottom:1rem;
            text-shadow:2px 2px 5px rgba(0,0,0,0.4);
        ">
            {{ $album->name }}
        </h1>

        {{-- INFO --}}
        <p style="font-size:1.2rem; margin-bottom:0.5rem;">
            Artists: <span style="font-weight:600;">{{ $album->artists }}</span>
        </p>

        <p style="font-size:1.2rem; margin-bottom:0.5rem;">
            Genre: <span style="font-weight:600;">{{ $album->genre }}</span>
        </p>

        <p style="font-size:1.2rem; margin-bottom:2rem;">
            Year: <span style="font-weight:600;">{{ $album->year }}</span>
        </p>

        {{-- ACTIE KNOPPEN --}}
        @auth
            <div style="display:flex; gap:1.2rem; margin-bottom:2.2rem;">

                {{-- EDIT --}}
                <a href="{{ route('music.edit', $album->id) }}"
                   style="
                        background:linear-gradient(to right,#7A0F18,#BA1F33);
                        color:#FFD6E8;
                        padding:0.55rem 1.4rem;
                        border-radius:0.8rem;
                        text-decoration:none;
                        font-weight:800;
                        box-shadow:0 6px 14px rgba(0,0,0,0.28);
                        transition:all .25s;
                   "
                   onmouseover="this.style.transform='scale(1.06)'; this.style.opacity='0.9';"
                   onmouseout="this.style.transform='scale(1)'; this.style.opacity='1';">
                    ✏️ Edit Album
                </a>

                {{-- DELETE --}}
                <form action="{{ route('music.destroy', $album->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this album?');"
                            style="
                                background:#91171F;
                                color:#FFD6E8;
                                padding:0.55rem 1.4rem;
                                border-radius:0.8rem;
                                font-weight:800;
                                border:none;
                                cursor:pointer;
                                box-shadow:0 6px 14px rgba(0,0,0,0.28);
                                transition:all .25s;
                            "
                            onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.06)';"
                            onmouseout="this.style.backgroundColor='#91171F'; this.style.transform='scale(1)';">
                        🗑 Delete Album
                    </button>
                </form>

            </div>
        @endauth


        {{-- BACK BUTTON --}}
        <a href="{{ route('music.catalog') }}"
           style="
                background:#CD5D67;
                color:#FFD6E8;
                padding:0.6rem 1.5rem;
                border-radius:0.5rem;
                font-weight:600;
                text-decoration:none;
                box-shadow:0 3px 6px rgba(0,0,0,0.3);
                transition: all 0.3s;
           "
           onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.05)';"
           onmouseout="this.style.backgroundColor='#CD5D67'; this.style.transform='scale(1)';">
            Back to Catalog
        </a>

    </div>
</x-layout>
