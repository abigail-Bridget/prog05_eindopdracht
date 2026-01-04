<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body style="margin:0; min-height:100vh;
             font-family:'Poppins',sans-serif;
             background: linear-gradient(to bottom right,#CD5D67,#BA1F33,#91171F);
             color:#ffffff; display:flex; flex-direction:column;">

<header>
    <nav style="background: rgba(255,255,255,0.85);
                border-bottom:1px solid rgba(200,200,200,0.7);
                display:flex; justify-content:space-between;
                align-items:center; padding:0.7rem 2rem;">

        <!-- LEFT LINKS -->
        <div style="display:flex; gap:1.5rem;">

            <a href="{{ url('/') }}"
               style="color:#410B13; font-weight:700; text-decoration:none;">
                Home
            </a>

            <a href="{{ route('music.catalog') }}"
               style="color:#410B13; font-weight:700; text-decoration:none;">
                Catalog
            </a>


            @auth
                <a href="{{ route('music.my_albums') }}"
                   style="color:#410B13; font-weight:700; text-decoration:none;">
                    My Albums
                </a>
            @endauth

            <a href="{{ route('about') }}"
               style="color:#410B13; font-weight:700; text-decoration:none;">
                About
            </a>

            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}"
                   style="color:#410B13; font-weight:700; text-decoration:none;">
                    Admin
                </a>
            @endif
        </div>

        <!-- RIGHT SIDE -->
        <div style="display:flex; gap:1rem; align-items:center;">

            @auth
                <a href="{{ route('profile.edit') }}"
                   style="color:#410B13; font-weight:700; text-decoration:none;">
                    Profile
                </a>

                <span style="font-weight:600; color:#421820;">
                    Hello, {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit"
                            style="background:none; border:none;
                                   color:#91171F; font-weight:700;
                                   cursor:pointer;">
                        Logout
                    </button>
                </form>

            @else
                <a href="{{ route('login') }}"
                   style="color:#410B13; font-weight:700; text-decoration:none;">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   style="color:#410B13; font-weight:700; text-decoration:none;">
                    Register
                </a>
            @endauth

        </div>

    </nav>
</header>

<main style="flex:1; padding:2rem;">
    {{ $slot }}
</main>

</body>
</html>
