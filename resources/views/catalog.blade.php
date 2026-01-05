<x-layout>
    <div style="
        min-height:80vh;
        padding:3rem 2rem;
        font-family:'Poppins','Quicksand','Nunito',sans-serif;
    ">

        <!-- Titel -->
        <div style="max-width:1200px; margin:0 auto 2rem auto;">
            <h1 style="font-size:3rem; font-weight:700; color:#ffffff; margin-bottom:0.5rem;">
                Music Catalogus
            </h1>
            <p style="font-style:italic; color:#ffe0e5;">
                Browse all albums, filter on artist, genre or year and find what you want.
            </p>
        </div>

        <div style="max-width:1200px; margin:0 auto;">

            {{-- ERROR MESSAGES --}}
            @if ($errors->any())
                <div style="
                    margin-bottom:1.5rem;
                    background:#410B13;
                    color:#FFD6E8;
                    padding:1rem 1.2rem;
                    border-radius:0.75rem;
                    box-shadow:0 4px 8px rgba(0,0,0,0.35);
                ">
                    <ul style="margin:0; padding-left:1.2rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div style="
                    margin-bottom:1.5rem;
                    background:#0f7a32;
                    color:#ffffff;
                    padding:0.9rem 1.1rem;
                    border-radius:0.75rem;
                    box-shadow:0 4px 8px rgba(0,0,0,0.35);
                ">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FILTERBALK -->
            <form action="{{ route('music.catalog') }}" method="GET"
                  style="display:flex; flex-wrap:wrap; gap:0.75rem; align-items:center; margin-bottom:2rem;">

                <span style="font-weight:700; color:#ffe0e5;">Filter on:</span>

                <!-- Artists -->
                <select name="artists"
                        style="padding:0.45rem 0.9rem; border-radius:999px;
                               border:none; outline:none; font-size:0.9rem;
                               background:#ffffff; color:#410B13; min-width:150px;
                               box-shadow:0 2px 6px rgba(0,0,0,0.15);">
                    <option value="">All artists</option>
                    @foreach ($artistOptions as $artist)
                        <option value="{{ $artist->artists }}" {{ request('artists') == $artist->artists ? 'selected' : '' }}>
                            {{ $artist->artists }}
                        </option>
                    @endforeach
                </select>

                <!-- Genre -->
                <select name="genre"
                        style="padding:0.45rem 0.9rem; border-radius:999px;
                               border:none; outline:none; font-size:0.9rem;
                               background:#ffffff; color:#410B13; min-width:130px;
                               box-shadow:0 2px 6px rgba(0,0,0,0.15);">
                    <option value="">All genres</option>
                    @foreach ($genreOptions as $genre)
                        <option value="{{ $genre->genre }}" {{ request('genre') == $genre->genre ? 'selected' : '' }}>
                            {{ $genre->genre }}
                        </option>
                    @endforeach
                </select>

                <!-- Year -->
                <select name="year"
                        style="padding:0.45rem 0.9rem; border-radius:999px;
                               border:none; outline:none; font-size:0.9rem;
                               background:#ffffff; color:#410B13; min-width:110px;
                               box-shadow:0 2px 6px rgba(0,0,0,0.15);">
                    <option value="">All years</option>
                    @foreach ($yearOptions as $year)
                        <option value="{{ $year->year }}" {{ request('year') == $year->year ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                    @endforeach
                </select>

                <!-- Search -->
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search term"
                       style="flex:1 1 220px; max-width:260px; padding:0.45rem 0.9rem;
                              border-radius:999px; border:none; font-size:0.9rem;">

                <!-- Button -->
                <button type="submit"
                        style="background:#22a64f; color:#ffffff; padding:0.5rem 1.4rem;
                               border-radius:999px; border:none; font-weight:700; cursor:pointer;
                               box-shadow:0 2px 5px rgba(0,0,0,0.25);">
                    Find!
                </button>

            </form>

            <!-- GRID MET ALBUMS -->
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
                        gap:1.5rem;">

                @foreach ($albums as $album)
                    <div style="background:#ffffff; border-radius:0.75rem;
                                box-shadow:0 3px 8px rgba(0,0,0,0.25);
                                overflow:hidden; max-width:360px; margin:0 auto;
                                display:flex; flex-direction:column;">

                        <!-- AFBEELDING -->
                        @if($album->image_path)
                            <img src="{{ asset('images/' . $album->image_path) }}"
                                 alt="{{ $album->name }}"
                                 style="width:100%; height:200px; object-fit:cover;">
                        @endif

                        <div style="padding:1rem 1.25rem; flex:1;">

                            <h2 style="font-size:1.2rem; font-weight:800; margin-bottom:0.5rem; color:#410B13;">
                                {{ $album->name }}
                            </h2>

                            <p style="margin:0; font-size:0.9rem; color:#5c2b32;">
                                <strong>Artists:</strong> {{ $album->artists }}
                            </p>

                            <p style="margin:0; font-size:0.9rem; color:#5c2b32;">
                                <strong>Genre:</strong> {{ $album->genre }}
                            </p>

                            <p style="margin:0 0 1rem 0; font-size:0.9rem; color:#5c2b32;">
                                <strong>Year:</strong> {{ $album->year }}
                            </p>

                            <!-- BUTTON -->
                            <a href="{{ route('music.show', $album->id) }}"
                               style="background:#CD5D67; color:#ffffff;
                                      padding:0.55rem 1.1rem; border-radius:0.6rem;
                                      text-decoration:none; font-size:0.9rem; font-weight:700;
                                      display:inline-block; margin-top:0.5rem;
                                      box-shadow:0 3px 6px rgba(0,0,0,0.25);
                                      transition:all .2s;"
                               onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.05)'"
                               onmouseout="this.style.backgroundColor='#CD5D67'; this.style.transform='scale(1)'">
                                See this album!
                            </a>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</x-layout>
