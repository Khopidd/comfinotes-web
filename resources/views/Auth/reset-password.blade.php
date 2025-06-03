<x-auth-layout>
    <x-slot:title>Reset Page - Comfinote's</x-slot:title>
    <div class="container-reset">
        <div class="head-logo-reset">
            <img src="asset/image/logo-2.png" alt="">
        </div>
        <div class="form-section-reset">
            <div class="form-manage-reset">
                <div class="form-title-reset">
                    <h1>Atur ulang kata sandi</h1>
                    <p>Kata sandi harus terdiri dari minimal 8 karakter.</p>
                </div>
                <form action="">
                    <div class="label-form-reset">
                        <div class="input-container-reset">
                            <input type="password" name="password" placeholder="Masukan Kata Sandi Baru" required>
                            <iconify-icon icon="proicons:eye-off" class="toggle-password" id="toggle-password"></iconify-icon>
                        </div>
                    </div>
                    <div class="label-form-reset">
                        <div class="input-container-reset">
                            <input type="password" name="confirm-password" placeholder="Konfirmasi Kata Sandi Baru" required>
                            <iconify-icon icon="proicons:eye-off" class="toggle-password" id="toggle-password"></iconify-icon>
                        </div>
                    </div>
                    <div class="label-button-reset">
                        <button type="submit" class="btn-continue">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
