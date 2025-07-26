<x-admin-layout>
<x-slot:title>Detail Transaksi - Comfinote's</x-slot:title>
<x-slot:PageTitle>Detail Transaksi</x-slot:PageTitle>
<x-slot:PageSubtitle>Rincian informasi setiap transaksi</x-slot:PageSubtitle>

<div class="main-content">
    <form action="{{ route('notif.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="notif_id" value="{{ $detailTrasaction->id }}">

        <div class="transaksi-header">
            <!-- KIRI -->
            <div class="transaksi-left">
                <div class="transaksi-content-1">
                    <div class="header-1">
                        <h2>Detail Catatan</h2>
                    </div>
                    <div class="content-1">
                        <div class="transaksi-nickname">
                            <div class="trasaction-title">
                                <h2>Nama Acara</h2>
                                <span>{{ $detailTrasaction->nama_acara }}</span>
                            </div>
                            <div class="trasaction-dana">
                                <h2>Jumlah</h2>
                                <span>Rp. {{ number_format($detailTrasaction->total, '0', ',', '.') }}</span>
                            </div>
                            <div class="trasaction-text">
                                <h2></h2>
                                <span></span>
                            </div>
                            <div class="trasaction-catatan">
                                <h2>Detail Acara</h2>
                                @foreach (explode('-', $detailTrasaction->catatan) as $catatan)
                                    <span>- {{ trim($catatan) }}</span><br>
                                @endforeach
                                <span>Proposal sudah disertakan juga dalam bentuk PDF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KANAN -->
            <div class="transaksi-right">
                <div class="transaksi-content-2">
                    <div class="header-2">
                        <h2>File Pendukung</h2>
                    </div>
                    <div class="content-2">
                        <div class="supporting-file">
                            @if ($detailTrasaction->supporting_image)
                                <img src="{{ asset('uploads/' . $detailTrasaction->supporting_image) }}" alt="">
                            @else
                                <img src="{{ asset('asset/image/Profile _ Group.png') }}" alt="">
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="input-form">
                                <label for="jumlah_hari">Lama Kegiatan</label>
                                <div class="input-inline">
                                    <input type="text" id="jumlah_hari" name="jumlah_hari" value="{{ $detailTrasaction->jumlah_hari }}" disabled>
                                    <input type="text" value="Hari" disabled class="satuan-input">
                                </div>
                            </div>

                            <div class="input-form">
                                <label for="tanggal_selesai">Tanggal Pengajuan</label>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ $detailTrasaction->tanggal_pengajuan ?? '' }}" disabled>
                            </div>
                            <div class="button-modal" style="margin-top: 1.5rem;">
                                <button type="submit" name="action" value="rejected" class="button-reject">Tolak</button>
                                <button type="submit" name="action" value="approved" class="button-approv">Setujui</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</x-admin-layout>
