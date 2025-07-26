<x-user-layout>
<x-slot:title>pengajuan Dana - Comfinotes</x-slot:title>
<x-slot:PageTitle>Dashboard</x-slot:PageTitle>
<x-slot:PageSubtitle>Informasi terperinci tentang keuangan komunitas Anda</x-slot:PageSubtitle>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        showAlert("{{ session('success') }}", "success", 4000);
        });
    </script>
@endif

<div class="main-content">
    <div class="submission-content">
        <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data" class="submission-header">
        @csrf
            <div class="form-right">
                <div class="form-header">
                    <h1>Pengajuan baru</h1>
                </div>
                <hr>
                <div class="add-money">
                    <label for="nama_acara">Nama Acara<strong>*</strong></label>
                    <input type="text" name="nama_acara" id="keterangan" placeholder="Tambah Keterangan">
                    @error('nama_acara')
                        <p class="pesan-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="add-money">
                    <label for="nominal">Masukan Jumlah<strong>*</strong></label>
                    <input type="text" class="rupiah-format" placeholder="Masukan Angka Rp. 0">
                    <input type="hidden" name="total" id="jumlah-real">
                    @error('total')
                        <p class="pesan-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="add-money">
                    <label for="catatan-detail">Detail Acara<strong>*</strong></label>
                    <span>Sertakan min. 50 karakter untuk detail acara</span>
                    <textarea name="catatan" id="catatan-detail" placeholder="Tambah detail kebutuhan"></textarea>
                    @error('catatan')
                        <p class="pesan-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-left">
                <div class="image-add-acount">
                    <h2 class="img-text">File Pendukung</h2>
                    <span>Seperti tanda terima, foto rencana acara, dll.</span>
                    <input type="file" name="supporting_image" class="supporting-file" hidden>
                    <label class="custom-file-label">
                        <iconify-icon icon="icon-park-outline:upload-one" class="icon-upload"></iconify-icon>
                        <p id="file-label-text">Seret dan Jatuhkan di sini, Atau Pilih dari File</p>
                    </label>

                    <div class="image-preview-container">
                        <img class="image-preview" src="" alt="Preview">
                        <button type="button" class="delete-image">
                            <iconify-icon icon="tabler:trash-filled" class="icon-sampah"></iconify-icon>
                        </button>
                    </div>
                    @error('supporting_image')
                        <p class="pesan-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="add-money">
                    <label for="tanggal">Tanggal<strong>*</strong></label>
                    <div class="split">
                        <input type="number" name="jumlah_hari" id="jumlah_hari" placeholder="Jumlah Hari">
                        <input type="text" class="hari" value="Hari" disabled>
                        <input type="date" name="tanggal_pengajuan" id="tanggal_awal">
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" readonly>
                    </div>
                </div>

                <div class="button-add">
                    <button type="submit" class="button-submission">Ajukan Dana</button>
                </div>
            </div>
        </form>
    </div>
</div>

</x-user-layout>
