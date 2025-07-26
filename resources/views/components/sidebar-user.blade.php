@props(['PageTitle', 'PageSubtitle'])

<div class="sidebar-user">
    <div class="title-side-user">
        <a href="{{ route('dashboard-user') }}"><img src="{{ asset('asset/image/logo-2.png') }}" alt="logo user" class="logo-user"></a>
    </div>
    <ul class="menu">
        <li class="{{ request()->routeIs('dashboard-user') ? 'active-btn' : '' }}"><iconify-icon icon="mage:dashboard-fill"></iconify-icon><a href="{{ route('dashboard-user') }}">Dashboard</a></li>
    </ul>
</div>

<div class="main-header">
    <div class="header-menu">
        <div class="header-title">
            <h1>{{ $PageTitle }}</h1>
            <p>{{ $PageSubtitle }}</p>
        </div>
        <div class="notif-content">
            <div class="notif">
                <iconify-icon icon="pepicons-pencil:bell" class="bell icon-notif"
                    data-action="toggle-dropdown" data-target="notif-dropdown">
                </iconify-icon>

                <div class="notif-dropdown" id="notif-dropdown">
                    <h2>Notification</h2>
                    <hr class="border">
                    @foreach ($notifications as $notif)
                        <div class="notif-items"
                            data-id="{{ $notif->id }}"
                            data-status="{{ $notif->status }}"
                            data-action="open-modal"
                            data-target="modal-notifications">
                            <div class="bg-icon">
                                <iconify-icon icon="iconoir:send-mail" class="icon-notif"></iconify-icon>
                            </div>
                            <div class="notif-box">
                                <div class="notif-text">
                                    <h3 class="title-notif">Hasil Pengajuan</h3>
                                    <p class="des-notif">Klik untuk melihat status pengajuan</p>
                                </div>
                                <div class="notif-date">
                                    <iconify-icon icon="tabler:clock" class="history"></iconify-icon>
                                    <p>{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr class="border">
                </div>
            </div>

            <div class="drop-akun">
                <ul class="dropdown-menu">
                    <li class="dropbutton">
                        <button class="dropdown-button" id="userDropdownButton" onclick="toggleDropdown()">
                            @if ($user->image)
                                <img src="{{ asset('uploads/' . $user->image) }}" alt="User Logo" class="user-logo">
                             @else
                                <img src="{{ asset('asset/image/profile-1.jpg') }}" alt="User Logo" class="user-logo">
                            @endif
                        </button>
                        <div class="drop-down" id="userDropdownMenu">
                            <div class="drop-title">
                                <h2>Hello, {{ $user->username }}</h2>
                                <p>{{ $user->role }}</p>
                            </div>
                            <hr>
                            <div class="drop-menu">
                                <button type="button" class="menu-items logout-button" data-action="confirm-logout" data-target="logout-notification">
                                    <iconify-icon icon="mdi-light:logout" class="icon-user-2"></iconify-icon>Logout
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="modal-notifications" class="modal">
    <div class="modal-content">
        <h1 class="title-modal" id="status-title">Status</h1>
        <span class="close-button" data-action="close-modal" data-target="modal-notifications">&times;</span>
        <div class="status-icon-wrapper">
            <div class="status-icon" id="status-icon"></div>
        </div>
        <p id="status-message" style="text-align: center">Pesan akan muncul di sini</p>
    </div>
</div>



