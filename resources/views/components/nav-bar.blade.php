<nav style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0.6rem 2rem;
    background: rgba(255,255,255,0.85);
    border-bottom: 1px solid rgba(200,200,200,0.7);
    border-radius: 0.6rem;
">

    {{-- LEFT --}}
    <div style="display:flex; gap:1.6rem; align-items:center;">

        <a href="{{ url('/') }}"
           style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
           onmouseover="this.style.color='#BA1F33';"
           onmouseout="this.style.color='#410B13';">
            Home
        </a>

        <a href="{{ route('music.catalog') }}"
           style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
           onmouseover="this.style.color='#BA1F33';"
           onmouseout="this.style.color='#410B13';">
            Catalog
        </a>


        @auth
            <a href="{{ route('music.my_albums') }}"
               style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
               onmouseover="this.style.color='#BA1F33';"
               onmouseout="this.style.color='#410B13';">
                My Albums
            </a>
        @endauth

        <a href="{{ route('about') }}"
           style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
           onmouseover="this.style.color='#BA1F33';"
           onmouseout="this.style.color='#410B13';">
            About
        </a>

        {{-- ONLY ADMINS --}}
        @if(auth()->check() && auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}"
               style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
               onmouseover="this.style.color='#BA1F33';"
               onmouseout="this.style.color='#410B13';">
                Admin
            </a>
        @endif
    </div>


    <div style="display:flex; gap:1.2rem; align-items:center;">

        @auth
            <a href="{{ route('profile.edit') }}"
               style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
               onmouseover="this.style.color='#BA1F33';"
               onmouseout="this.style.color='#410B13';">
                Profile
            </a>

            <span style="font-weight:600; color:#421820;">
                Hi, {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit"
                        style="background:none; border:none; font-weight:700;
                               color:#410B13; cursor:pointer; transition:0.25s;"
                        onmouseover="this.style.color='#BA1F33';"
                        onmouseout="this.style.color='#410B13';">
                    Logout
                </button>
            </form>

        @else
            <a href="{{ route('login') }}"
               style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
               onmouseover="this.style.color='#BA1F33';"
               onmouseout="this.style.color='#410B13';">
                Login
            </a>

            <a href="{{ route('register') }}"
               style="color:#410B13; font-weight:700; text-decoration:none; transition:0.25s;"
               onmouseover="this.style.color='#BA1F33';"
               onmouseout="this.style.color='#410B13';">
                Register
            </a>
        @endauth

    </div>

</nav>
