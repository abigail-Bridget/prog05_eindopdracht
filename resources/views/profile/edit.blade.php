<x-layout>
    <div style="
        min-height:80vh;
        padding:3rem 1.5rem;
        font-family:'Poppins',sans-serif;
    ">
        {{-- Titel + subtitel in het midden --}}
        <div style="text-align:center; margin-bottom:2rem;">
            <h1 style="
                font-size:2.2rem;
                font-weight:900;
                margin:0 0 0.4rem 0;
                color:#ffffff;
                text-shadow:0 2px 8px rgba(0,0,0,0.4);
            ">
                Profile Settings
            </h1>

            <p style="
                font-size:0.95rem;
                color:#FFE3EA;
                margin:0;
            ">
                Manage your Music World account, info and security 🎵
            </p>
        </div>

        {{-- Content-blok --}}
        <div style="
            max-width:900px;
            margin:0 auto;
            display:flex;
            flex-direction:column;
            gap:2rem;
        ">
            @include('profile.partials.update-profile-information-form')

            @include('profile.partials.update-password-form')

            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-layout>
