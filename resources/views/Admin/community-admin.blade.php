<x-admin-layout>
    <x-slot:title>Community - Comfinote's</x-slot:title>
    <x-slot:PageTitle>Community</x-slot:PageTitle>
    <x-slot:PageSubtitle>Informasi terperinci tentang keuangan komunitas Anda</x-slot:PageSubtitle>

    <div class="main-content">
        <div class="card-content">
            <div class="card-acount">
                <div class="head-card">
                    <div class="head-title">
                        <h2>Semua Grup</h2>
                        <p>Lihat daftar semua grup</p>
                    </div>
                    <div class="head-button">
                        <button class="add-acount">
                            grup baru <iconify-icon icon="ic:outline-plus" class="icon-card-5"></span>
                        </button>
                    </div>
                </div>
                <div class="main-card">
                    @foreach ( $divisi as $index => $group )
                    <div class="card">
                        <div class="card-image-head">
                            @if ($group->image)
                                <img src="{{ asset('asset/image/Profile _ Group.png') }}" alt="" class="card-image">
                            @else
                             <p>No Image</p>
                            @endif

                        </div>
                        <div class="card-text">
                            <p class="label-card">Dibuat: 27 Januari 2025</p>
                            <h3>{{ $group->name_divisi }}</h3>
                            <h4>IDR 4.500.000</h4>
                        </div>
                        <button class="card-button">Lihat Group</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="table-acount">
            <div class="header-acount">
                <div class="head-acount">
                    <div class="head-title">
                        <h2>Daftar Akun Admin</h2>
                        <p>Lihat daftar semua akun admin</p>
                    </div>
                    <div class="head-button">
                        <button class="add-acount">
                            akun baru <iconify-icon icon="ic:outline-plus" class="icon-card-5"></span>
                        </button>
                    </div>
                </div>
                <div class="data-table">
                    <table class="style-table">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">No</th>
                                <th onclick="sortTable(1)">Foto</th>
                                <th onclick="sortTable(2)">Username</th>
                                <th onclick="sortTable(2)">Email</th>
                                <th onclick="sortTable(3)">Jenis Pengguna</th>
                                <th onclick="sortTable(4)">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $comunity as $index => $acount )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($acount->image)
                                        <img src="#" alt=""></td>
                                    @else
                                        No image
                                    @endif

                                <td>{{ $acount->username }}</td>
                                <td>{{ $acount->email }}</td>
                                <td>{{ $acount->role }}</td>
                                <td>
                                    <button class="btn-delete">
                                        <iconify-icon icon="tabler:trash-filled" class="icon-card-5"></span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
