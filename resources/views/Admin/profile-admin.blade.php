<x-admin-layout>
<x-slot:title>Halaman Profile - Comfinotes</x-slot:title>
<x-slot:PageTitle>Profile Admin</x-slot:PageTitle>
<x-slot:PageSubtitle>Informasi terperinci tentang keuangan komunitas Anda</x-slot:PageSubtitle>

<div class="main-content">
    <div class="profile-header">
        <div class="profile-left">
            <div class="profile-content-1">
                <div class="header-1">
                    <h2>Gambar Profile</h2>
                </div>
                <hr>
                <div class="content-1">
                    @if ($profileAdmin->image)
                    <img src="{{ asset('uploads/' . $profileAdmin->image) }}" alt="" class="profile-image">
                    @else
                    <img src="{{ asset('asset/image/profile-1.jpg') }}" alt="" class="profile-image">
                    @endif
                    <div class="profile-nickname">
                        <h2>{{ $profileAdmin->username }}</h2>
                        <span>{{ $profileAdmin->role }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-right">
            <div class="profile-content-2">
                <div class="header-2">
                    <h2>Edit Profile</h2>
                </div>
                <div class="content-2">
                    <form action="#">
                        <div class="profile-input">
                            <label for="profile-image">Upload</label>
                            <input type="file" id="profile-image" hidden>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</x-admin-layout>
