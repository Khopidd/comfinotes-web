<div class="modal-logout">
    <div class="logout-notification" id="logout-notification">
        <div class="logout-content">
            <h2>Sign Out?</h2>
            <p>Do you want to exit the app now?</p>
            <div class="logout-actions">
                <button class="btn-cancel" data-action="cancel-logout">Cancel</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-confirm">Sign Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete popup --->
<div class="modal-delete">
    <div class="modal" id="modal-delete" style="display: none;">
        <div class="modal-box">
            <div class="modal-icon">
                <iconify-icon icon="tabler:trash-filled" class="icon-delete"></iconify-icon>
            </div>
            <div class="modal-text">
                <h2>Hapus Akun?</h2>
                <p>Apakah Anda yakin ingin menghapus akun ini?</p>
            </div>
            <div class="delete-action">
                <form id="deleteForm" method="POST">
                @csrf
                    <button type="submit" class="btn-confirm">Ya, Hapus</button>
                    <button type="button" class="btn-cancel" data-action="close-modal" data-target="modal-delete">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal-add" id="addUser">
    <div class="modal-content-add">
        <h2>Tambah Group</h2>
        <form action="{{ route('admin.add-group') }}" method="POST" enctype="multipart/form-data" id="formAddUser">
            @csrf
            <input type="hidden" name="source" value="addUser">
            <div class="image-add-acount">
                <h2 class="img-text">Upload Gambar<span>Opsional</span></h2>
                <input type="file" name="image" class="supporting-file" hidden>
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
            </div>


            <div class="input-content-add">
                <label for="username-user">Group Name<strong>*</strong></label>
                <input type="text" name="username" id="username-user" placeholder="Masukan Nama">
                @error('username')
                    <p class="pesan-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-content-add">
                <label for="email-user">Email<strong>*</strong></label>
                <input type="text" name="email" id="email-user" placeholder="Masukan Email">
                @error('email')
                    <p class="pesan-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-content-add">
                <label for="password-user">Password<strong>*</strong></label>
                <input type="password" name="password" id="password-user" placeholder="Masukan Password">
                @error('password')
                    <p class="pesan-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-modal">
                <button type="button" class="button-reject" data-action="close-popup" data-target="addUser">Batal</button>
                <button type="submit" class="button-approv">Buat Akun</button>
            </div>
        </form>
    </div>
</div>
