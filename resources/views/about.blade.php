<x-layout>

    <div style="max-width:900px; margin:0 auto; text-align:center;">

        <h2 style="font-size:2.5rem; font-weight:800; margin-bottom:1rem;">
            About Music World
        </h2>

        <p style="font-size:1.1rem; line-height:1.8; max-width:750px; margin:0 auto 1.5rem;">
            Welcome to <strong>Music World</strong> — a cozy digital place for people who love music,
            albums, artists and discovering new sounds. Here you can browse albums, read more about them,
            and get inspired by all kinds of genres.
        </p>

        <p style="font-size:1.1rem; line-height:1.8; max-width:750px; margin:0 auto 1.5rem;">
            Whether you are into pop, rock, hip-hop or jazz there’s always something new to explore.
            Every album has its own story, mood and style. This website helps you discover those stories
            and keep track of your favourites.
        </p>

        <p style="font-size:1.1rem; line-height:1.8; max-width:750px; margin:0 auto 2rem;">
            The goal of this project is to make music discovery fun, simple and visually pleasing.
            Just scroll, explore and enjoy 🎧
        </p>

        @auth
            <div style="background:rgba(255,255,255,0.2); padding:1rem; border-radius:0.75rem;">
                <p style="margin:0;">
                    💫 Welcome back,
                    <strong>{{ Auth::user()->name }}</strong> — thanks for being part of Music World!
                </p>
            </div>
        @else
            <div style="background:rgba(255,255,255,0.15); padding:1rem; border-radius:0.75rem;">
                <p style="margin:0;">
                    🔐 You’re currently browsing as a guest.<br>
                    Want more options? Feel free to create an account ✨
                </p>
            </div>
        @endauth

    </div>

</x-layout>
