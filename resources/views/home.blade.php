<x-layout>
    <div style="min-height: 80vh;
                display:flex; align-items:center; justify-content:center;
                padding:3rem 1.5rem;">

        <div style="max-width:800px; text-align:center; color:#ffffff;">

            <h1 style="font-size:3rem; font-weight:700;
                       margin-bottom:1rem; text-shadow:2px 2px 6px rgba(0,0,0,0.4);">
                Welcome to the Music World!
            </h1>

            <p style="font-size:1.25rem; color:#ffe0e5; max-width:650px; margin:0 auto 2rem auto;
                      line-height:1.8; text-shadow:1px 1px 3px rgba(0,0,0,0.25);">
                Discover albums, explore your favorite artists, and enjoy a world full of music,
                melodies, and rhythm.
            </p>

            <a href="{{ route('music.catalog') }}"
               style="background:#CD5D67; color:#ffffff; padding:0.75rem 1.6rem;
                      border-radius:0.75rem; text-decoration:none; font-weight:700;
                      font-size:1.05rem; box-shadow:0 4px 8px rgba(0,0,0,0.35);
                      display:inline-block; transition:all 0.2s;">
                Explore albums
            </a>

        </div>
    </div>
</x-layout>
