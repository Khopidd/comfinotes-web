<div class="sidebar-admin">
    <div class="title-side-admin">
        <a href="{{ route('dashboard-admin') }}"><img src="{{ asset('asset/image/logo-2.png') }}" alt="logo admin" class="logo-admin"></a>
    </div>
    <ul class="menu">
        <li class="{{ request()->routeIs('dashboard-admin') ? 'active-btn' : '' }}">
            <iconify-icon icon="mage:dashboard-fill"></iconify-icon><a href="{{ route('dashboard-admin') }}">Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('comunity-admin') ? 'active-btn' : '' }}">
            <iconify-icon icon="heroicons:user-group-solid"></iconify-icon><a href="{{ route('comunity-admin') }}">Community</a>
        </li>
    </ul>
</div>
