<x-layout>
    <div style="
        max-width: 1000px;
        margin: 2.5rem auto;
        padding: 2rem 2.2rem;
        background: rgba(255,255,255,0.96);
        border-radius: 1.5rem;
        box-shadow: 0 12px 30px rgba(0,0,0,0.35);
        color: #410B13;
        font-family: 'Poppins','Quicksand','Nunito',sans-serif;
    ">

        {{-- Titel + welkom --}}
        <h1 style="
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 0.5rem 0;
            text-align: center;
            color: #BA1F33;
        ">
            Admin Dashboard
        </h1>

        <p style="
            text-align: center;
            font-size: 0.95rem;
            color: #742632;
            margin: 0 0 1.5rem 0;
        ">
            Welcome to the admin dashboard. Here you can manage users and keep the album world in check 🎧
        </p>

        {{-- Eventuele success message --}}
        @if(session('success'))
            <div style="
                background: #E5F9ED;
                border: 1px solid #8BD4A4;
                color: #145C2E;
                padding: 0.75rem 1rem;
                border-radius: 0.85rem;
                font-size: 0.9rem;
                margin-bottom: 1.3rem;
            ">
                {{ session('success') }}
            </div>
        @endif

        {{-- Link naar catalog als knop --}}
        <div style="text-align:center; margin-bottom: 1.8rem;">
            <a href="{{ route('music.catalog') }}"
               style="
                    display:inline-block;
                    background: linear-gradient(to right,#CD5D67,#BA1F33);
                    color:#FFD6E8;
                    padding:0.55rem 1.4rem;
                    border-radius:999px;
                    font-weight:700;
                    text-decoration:none;
                    font-size:0.95rem;
                    box-shadow:0 6px 14px rgba(0,0,0,0.25);
                    transition:all .2s;
               "
               onmouseover="this.style.transform='scale(1.05)'"
               onmouseout="this.style.transform='scale(1)'">
                View the Album Catalog
            </a>
        </div>

        {{-- Users beheren --}}
        <div id="manage-users">
            <h2 style="
                font-size: 1.3rem;
                font-weight: 800;
                margin: 0 0 0.8rem 0;
                color: #410B13;
            ">
                Manage Users
            </h2>

            <p style="margin:0 0 0.8rem 0; font-size:0.9rem; color:#742632;">
                Here you can edit or delete users and give admin rights where needed.
            </p>

            <div style="overflow-x:auto; border-radius:1rem; border:1px solid #F4C7D3; background:#FFF6F8;">
                <table style="
                    width:100%;
                    border-collapse:collapse;
                    font-size:0.9rem;
                ">
                    <thead>
                    <tr style="background:#CD5D67; color:#FFD6E8;">
                        <th style="padding:0.7rem 0.8rem; text-align:left;">Name</th>
                        <th style="padding:0.7rem 0.8rem; text-align:left;">Email</th>
                        <th style="padding:0.7rem 0.8rem; text-align:left;">Admin</th>
                        <th style="padding:0.7rem 0.8rem; text-align:left;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr style="border-top:1px solid #F4C7D3; background:#FFFDFE;">
                            <td style="padding:0.6rem 0.8rem; color:#410B13;">{{ $user->name }}</td>
                            <td style="padding:0.6rem 0.8rem; color:#742632;">{{ $user->email }}</td>
                            <td style="padding:0.6rem 0.8rem; color:#410B13;">
                                {{ $user->is_admin ? 'Yes' : 'No' }}
                            </td>
                            <td style="padding:0.6rem 0.8rem;">
                                {{-- Edit button --}}
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   style="
                                        display:inline-block;
                                        margin-right:0.4rem;
                                        padding:0.35rem 0.9rem;
                                        border-radius:999px;
                                        background:#410B13;
                                        color:#FFD6E8;
                                        font-weight:600;
                                        text-decoration:none;
                                        font-size:0.85rem;
                                        box-shadow:0 3px 8px rgba(0,0,0,0.25);
                                        transition:all .2s;
                                   "
                                   onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.05)'"
                                   onmouseout="this.style.backgroundColor='#410B13'; this.style.transform='scale(1)'">
                                    Edit
                                </a>

                                {{-- Delete form --}}
                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST"
                                      style="display:inline-block; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this user?');"
                                            style="
                                                padding:0.35rem 0.9rem;
                                                border-radius:999px;
                                                background:#91171F;
                                                color:#FFD6E8;
                                                font-weight:600;
                                                border:none;
                                                cursor:pointer;
                                                font-size:0.85rem;
                                                box-shadow:0 3px 8px rgba(0,0,0,0.25);
                                                transition:all .2s;
                                            "
                                            onmouseover="this.style.backgroundColor='#BA1F33'; this.style.transform='scale(1.05)'"
                                            onmouseout="this.style.backgroundColor='#91171F'; this.style.transform='scale(1)'">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($users->isEmpty())
                        <tr>
                            <td colspan="4" style="padding:0.9rem 0.8rem; text-align:center; color:#742632;">
                                No users found.
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
