<x-admin-layout>
    <x-slot:title>Community - Comfinote's</x-slot:title>
    <x-slot:PageTitle>Community</x-slot:PageTitle>
    <x-slot:PageSubtitle>Informasi terperinci tentang keuangan komunitas Anda</x-slot:PageSubtitle>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            showAlert("{{ session('success') }}", "success", 4000);
            });
        </script>
    @endif

    @php
        $addAcountErrors = $errors->hasAny(['username', 'email', 'password']);
    @endphp

    @if ($addAcountErrors)
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById("addAcount")?.classList.add("active");
            });
        </script>
    @endif

    <div class="main-content-comunity">
        <div class="card-content">
            <div class="card-acount">
                <div class="head-card">
                    <div class="head-title">
                        <h2>Semua Grup</h2>
                        <p>Lihat daftar semua grup</p>
                    </div>
                    <div class="head-button">
                        <button class="add-acount" id="addUserButton">
                            grup baru <iconify-icon icon="ic:outline-plus" class="icon-card-5"></span>
                        </button>
                    </div>
                </div>
                @if ($divisi->isEmpty())
                    <div class="card-no-data">
                        <h1 class="text-default">Tidak ada Group</h1>
                    </div>
                @else
                <div class="main-card">
                    @foreach ( $divisi as $index => $group )
                    <div class="card">
                        <div class="card-image-head">
                            @if ($group->image)
                            <img src="{{ asset('upload/' . $group->image) }}" alt="" class="card-image">
                            @else
                             <img src="{{ asset('asset/image/Profile _ Group.png') }}" alt="" class="card-image">
                            @endif
                        </div>
                        <div class="card-text">
                            <p class="label-card">Dibuat: 27 Januari 2025</p>
                            <h3>{{ $group->name_divisi }}</h3>
                            <h4>IDR 4.500.000</h4>
                        </div>
                        <div class="card-button">
                            <a href="{{ route('admin.detail-user', $group->key_id) }}" class="btn-detail">Lihat Group</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

</x-admin-layout>
