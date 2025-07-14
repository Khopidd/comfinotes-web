@props(['PageTitle', 'PageSubtitle', 'notifications' => collect()])

<div class="sidebar-admin">
    <div class="title-side-admin">
        <a href="{{ route('dashboard-admin') }}"><img src="{{ asset('asset/image/logo-2.png') }}" alt="logo admin" class="logo-admin"></a>
    </div>
    <ul class="menu">
        <li class="{{ request()->routeIs('dashboard-admin') || request()->routeIs('money.view') || request()->routeIs('admin.profile-admin') ? 'active-btn' : '' }}">
            <iconify-icon icon="mage:dashboard-fill"></iconify-icon><a href="{{ route('dashboard-admin') }}">Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('comunity-admin') ? 'active-btn' : '' }}">
            <iconify-icon icon="heroicons:user-group-solid"></iconify-icon><a href="{{ route('comunity-admin') }}">Community</a>
        </li>
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
                <iconify-icon icon="pepicons-pencil:bell" class="bell icon-notif" data-action="toggle-dropdown" data-target="notif-dropdown"></iconify-icon>
                <div class="notif-dropdown" id="notif-dropdown">
                    <div class="header-notif">
                        <h2>Notification</h2>
                    </div>
                    <hr class="border">
                    <div class="scroll-bar">
                     @forelse($notifications as $notif)
                        <div class="notif-items"
                            data-action="open-modal"
                            data-target="modal-notifications"
                            data-id="{{ $notif->id }}"
                            data-acara="{{ $notif->nama_acara }}"
                            data-jumlah="{{ number_format($notif->total, 0, ',', '.') }}"
                            data-img="{{ asset('uploads/' . $notif->supporting_image) }}"
                            data-divisi="{{ $notif->user->divisi->name_divisi }}">

                            <div class="bg-icon">
                                <iconify-icon icon="iconoir:send-mail" class="icon-notif"></iconify-icon>
                            </div>
                            <div class="notif-box">
                                <div class="notif-text">
                                    <h3 class="title-notif">{{ $notif->user->divisi->name_divisi }}</h3>
                                    <p class="des-notif">menunggu catatan keuangan yang disetujui</p>
                                </div>
                                <div class="notif-date">
                                    <iconify-icon icon="tabler:clock" class="history"></iconify-icon>
                                    <p>{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        <hr class="border">
                        @empty
                        <div class="notif-empty">
                            <p class="text-none">Tidak ada notifikasi.</p>
                        </div>
                    @endforelse
                    </div>
                </div>
            </div>

            <div class="drop-akun">
                <div class="drop-akun">
                    <ul class="dropdown-menu">
                        <li class="dropbutton">
                            <button class="dropdown-button" id="userDropdownButton" onclick="toggleDropdown()">
                                <img src="{{ asset('asset/image/profile-1.jpg') }}" alt="User Logo" class="user-logo">
                            </button>

                            <div class="drop-down" id="userDropdownMenu">
                                <div class="drop-title">
                                    <h2>Hello, {{ $admin->username }}</h2>
                                    <p>{{ $admin->role }}</p>
                                </div>
                                <hr>
                                <div class="drop-menu">
                                    <a href="{{ route('admin.profile-admin') }}" class="menu-items"><iconify-icon icon="solar:user-linear" class="icon-user-1"></iconify-icon>Profile</a>
                                    <hr>
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
</div>






