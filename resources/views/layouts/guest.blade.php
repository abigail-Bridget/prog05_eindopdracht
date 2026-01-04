<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="
    margin:0;
    min-height:100vh;
    font-family:'Poppins', sans-serif;
    background: linear-gradient(to bottom right, #CD5D67, #BA1F33, #91171F);
    display:flex;
    flex-direction:column;
">

<header>
    <nav style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:0.6rem 2rem;
        background: rgba(255,255,255,0.85);
        border-bottom:1px solid rgba(200,200,200,0.7);
        border-radius:0;
    ">
        <!-- LEFT -->
        <div style="display:flex; gap:1.6rem; align-items:center;">
            <a href='{{ url("/") }}' style="color:#410B13; font-weight:700; text-decoration:none;">Home</a>
            <a href='{{ url("/catalog") }}' style="color:#410B13; font-weight:700; text-decoration:none;">Catalog</a>
            <a href='{{ url("/about") }}' style="color:#410B13; font-weight:700; text-decoration:none;">About</a>
        </div>

        <!-- RIGHT -->
        <div style="display:flex; gap:1rem; align-items:center;">
            @auth
                <a href="{{ url('/profile') }}" style="color:#410B13; font-weight:700; text-decoration:none;">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#410B13; font-weight:700; cursor:pointer;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="color:#410B13; font-weight:700; text-decoration:none;">
                    Login
                </a>
                <a href="{{ route('register') }}" style="color:#410B13; font-weight:700; text-decoration:none;">
                    Register
                </a>
            @endauth
        </div>
    </nav>
</header>


<main style="
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:2rem;
">
    <div style="
        background:#ffffff;
        border-radius:1rem;
        box-shadow:0 12px 20px rgba(0,0,0,0.35);
        padding:2rem;
        width:100%;
        max-width:520px;
    ">
        {{ $slot }}
    </div>
</main>

</body>
</html>
