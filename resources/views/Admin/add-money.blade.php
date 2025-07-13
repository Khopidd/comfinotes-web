<x-admin-layout>
    <x-slot:title>Tambah Dana - Comfinote's</x-slot:title>
    <x-slot:PageTitle>Tambah Dana</x-slot:PageTitle>
    <x-slot:PageSubtitle>Informasi terperinci tentang keuangan komunitas Anda</x-slot:PageSubtitle>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            showAlert("{{ session('success') }}", "success", 4000);
            });
        </script>
    @endif

    <div class="main-content">
        <div class="card-submission">
            <div class="card-total">
                <div class="header-total">
                    <div class="total-content">
                        <div class="total-head">
                            <p class="text-total">Total Dana</p>
                            <div class="card-bg-icon">
                                <iconify-icon icon="uit:wallet" class="icon-card-2"></iconify-icon>
                            </div>
                        </div>
                        <div class="total-amount">
                            <h2>IDR {{ number_format($saldo, '0', ',', '.') }}</h2>
                            <span>Saldo komunitas Saat ini</span>
                        </div>
                    </div>
                </div>

                <div class="calendar-content">
                    <div class="calendar-header">
                        <h3 id="month-year"></h3>
                        <div class="button-previous">
                            <button onclick="changeMonth(-1)"><iconify-icon icon="fe:arrow-left" class="icon-calender"></button>
                            <button onclick="changeMonth(1)"><iconify-icon icon="fe:arrow-right" class="icon-calender"></button>
                        </div>
                    </div>
                    <div class="weekdays">
                        <div>Su</div> <div>Mo</div> <div>Tu</div> <div>We</div>
                        <div>Th</div> <div>Fr</div> <div>Sa</div>
                    </div>
                    <div class="days" id="calendar-days"></div>
                </div>
            </div>

            <div class="submission-content">
                <div class="submission-add">
                    <div class="submission-title">
                        <h2>Tambah Dana</h2>
                    </div>
                        <div class="submission-input">
                            <form action="{{ route('admin.addfunds') }}" method="POST">
                            @csrf
                                <div class="add-money">
                                    <label for="nominal">Jumlah<strong>*</strong></label>
                                    <input type="text" class="rupiah-format" placeholder="Masukan Angka 0">
                                    <input type="hidden" name="jumlah" id="jumlah-real">
                                    @error('jumlah')
                                        <p class="pesan-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="add-money">
                                    <label for="tanggal">Tanggal<strong>*</strong></label>
                                    <input type="date" name="tanggal" id="tanggal">
                                    @error('tanggal')
                                        <p class="pesan-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="add-money">
                                    <label for="keterangan">Keterangan<strong>*</strong></label>
                                    <input type="text" name="keterangan" id="keterangan" placeholder="Tambah Keterangan">
                                </div>

                                <div class="button-add">
                                    <button type="submit" class="button-submission">Tambah Dana</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <div class="submission-table">
                    <div class="header-acount-user">
                        <div class="head-acount-user">
                            <div class="head-title-user">
                                <h2>Riwayat</h2>
                                <p>Lihat semua riwayat keuangan acara</p>
                            </div>
                        </div>
                        <div class="data-table-user">
                            <table class="style-table-user">
                                <thead>
                                    <tr>
                                        <th onclick="sortTable(0)">No</th>
                                        <th onclick="sortTable(1)">Jumlah</th>
                                        <th onclick="sortTable(3)">Tanggal</th>
                                        <th onclick="sortTable(3)">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($income as $index => $money )
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="nominal">+ IDR {{ number_format($money->jumlah, '0', ',', '.') }}</td>
                                        <td>{{ Carbon\Carbon::parse($money->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $money->keterangan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
