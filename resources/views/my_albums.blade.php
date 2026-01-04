<x-layout>
    <div style="min-height:80vh;
                padding:3rem;
                font-family:'Poppins','Quicksand','Nunito',sans-serif;
                background: linear-gradient(to bottom right, #CD5D67, #BA1F33, #91171F);
                color:#FFD6E8;">

        <h1 style="text-align:center;
                   font-size:2.4rem;
                   font-weight:800;
                   color:#ffffff;
                   margin-bottom:2rem;
                   text-shadow:2px 2px 6px rgba(0,0,0,0.35);">
            My Albums
        </h1>

        {{-- Create new album button --}}
        <div style="text-align:center; margin-bottom:2rem;">
            <a href="{{ route('music.create') }}"
               style="background:#410B13;
                      color:#FFD6E8;
                      padding:0.6rem 1.6rem;
                      border-radius:0.75rem;
                      font-weight:700;
                      text-decoration:none;
                      box-shadow:0 4px 10px rgba(0,0,0,0.3);
                      transition:all 0.3s;
                      display:inline-block;"
               onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.05)';"
               onmouseout="this.style.backgroundColor='#410B13'; this.style.transform='scale(1)';">
                + Create New Album
            </a>
        </div>

        {{-- Error messages --}}
        @if ($errors->any())
            <div style="max-width:600px; margin:0 auto 1.5rem auto;
                        background:#410B13;
                        padding:1rem 1.2rem;
                        border-radius:0.75rem;
                        box-shadow:0 4px 8px rgba(0,0,0,0.35);">
                <ul style="margin:0; padding-left:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success message --}}
        @if (session('success'))
            <div style="max-width:600px; margin:0 auto 1.5rem auto;
                        background:#0f7a32;
                        padding:0.9rem 1.1rem;
                        border-radius:0.75rem;
                        box-shadow:0 4px 8px rgba(0,0,0,0.35);">
                {{ session('success') }}
            </div>
        @endif

        @if($albums->isEmpty())
            <p style="text-align:center; font-size:1rem; margin-top:2rem;">
                You don't have any albums yet. Start by creating your first album 🎵
            </p>
        @else
            <div style="display:grid;
                        grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
                        gap:1.8rem;">
                @foreach($albums as $album)
                    <div style="background:#410B13;
                                border-radius:0.9rem;
                                padding:1.5rem 1.2rem;
                                box-shadow:0 6px 14px rgba(0,0,0,0.35);
                                display:flex;
                                flex-direction:column;
                                justify-content:space-between;">
                        <div>
                            <h2 style="font-size:1.4rem;
                                       font-weight:800;
                                       color:#FFD6E8;
                                       margin:0 0 0.4rem 0;
                                       text-shadow:1px 1px 3px rgba(0,0,0,0.4);">
                                {{ $album->name }}
                            </h2>

                            <p style="margin:0.25rem 0;">
                                <span style="font-weight:600;">Artist:</span>
                                {{ $album->artist }}
                            </p>
                            <p style="margin:0.25rem 0;">
                                <span style="font-weight:600;">Genre:</span>
                                {{ $album->genre }}
                            </p>
                            <p style="margin:0.25rem 0 0.5rem 0;">
                                <span style="font-weight:600;">Year:</span>
                                {{ $album->year }}
                            </p>

                            {{-- Status badge --}}
                            <p style="margin:0.3rem 0 0.2rem 0; font-size:0.9rem;">
                                <span style="font-weight:600;">Status:</span>
                                @if($album->is_active)
                                    <span style="margin-left:0.4rem;
                                                 padding:0.15rem 0.6rem;
                                                 border-radius:999px;
                                                 background:#0f7a32;
                                                 color:#ffffff;
                                                 font-size:0.8rem;
                                                 font-weight:700;">
                                        Visible in catalog
                                    </span>
                                @else
                                    <span style="margin-left:0.4rem;
                                                 padding:0.15rem 0.6rem;
                                                 border-radius:999px;
                                                 background:#7a0f18;
                                                 color:#ffffff;
                                                 font-size:0.8rem;
                                                 font-weight:700;">
                                        Hidden from catalog
                                    </span>
                                @endif
                            </p>
                        </div>

                        {{-- Buttons --}}
                        <div style="display:flex; flex-direction:column; gap:0.5rem; margin-top:0.8rem;">

                            <div style="display:flex; gap:0.6rem;">
                                <a href="{{ route('music.show', $album->id) }}"
                                   style="flex:1;
                                          text-align:center;
                                          background:#CD5D67;
                                          color:#FFD6E8;
                                          padding:0.45rem 0.7rem;
                                          border-radius:0.6rem;
                                          font-weight:600;
                                          text-decoration:none;
                                          box-shadow:0 3px 8px rgba(0,0,0,0.3);
                                          transition:all 0.3s;"
                                   onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.03)';"
                                   onmouseout="this.style.backgroundColor='#CD5D67'; this.style.transform='scale(1)';">
                                    View
                                </a>

                                <a href="{{ route('music.edit', $album->id) }}"
                                   style="flex:1;
                                          text-align:center;
                                          background:#410B13;
                                          color:#FFD6E8;
                                          padding:0.45rem 0.7rem;
                                          border-radius:0.6rem;
                                          font-weight:600;
                                          text-decoration:none;
                                          box-shadow:0 3px 8px rgba(0,0,0,0.3);
                                          border:1px solid #CD5D67;
                                          transition:all 0.3s;"
                                   onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.03)';"
                                   onmouseout="this.style.backgroundColor='#410B13'; this.style.transform='scale(1)';">
                                    Edit
                                </a>
                            </div>

                            {{-- Toggle status button --}}
                            <form action="{{ route('albums.toggleStatus', $album->id) }}"
                                  method="POST"
                                  style="margin:0; margin-top:0.2rem;">
                                @csrf
                                <button type="submit"
                                        style="width:100%;
                                               background:{{ $album->is_active ? '#7A0F18' : '#0f7a32' }};
                                               color:#FFD6E8;
                                               padding:0.45rem 0.7rem;
                                               border-radius:999px;
                                               font-weight:700;
                                               border:none;
                                               cursor:pointer;
                                               box-shadow:0 3px 8px rgba(0,0,0,0.3);
                                               font-size:0.9rem;
                                               transition:all 0.3s;"
                                        onmouseover="this.style.transform='scale(1.03)';"
                                        onmouseout="this.style.transform='scale(1)';">
                                    @if($album->is_active)
                                        Set Inactive (hide from catalog)
                                    @else
                                        Set Active (show in catalog)
                                    @endif
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div style="text-align:center; margin-top:2.5rem;">
            <a href="{{ route('music.catalog') }}"
               style="background:#CD5D67;
                      color:#FFD6E8;
                      padding:0.6rem 1.5rem;
                      border-radius:0.7rem;
                      font-weight:700;
                      text-decoration:none;
                      box-shadow:0 4px 10px rgba(0,0,0,0.35);
                      transition:all 0.3s;"
               onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.05)';"
               onmouseout="this.style.backgroundColor='#CD5D67'; this.style.transform='scale(1)';">
                Back to Catalog
            </a>
        </div>
    </div>
</x-layout>
