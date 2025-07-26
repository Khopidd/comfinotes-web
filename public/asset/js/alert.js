function showAlert(message, type = 'info', duration = 2500) {
  const box = document.getElementById('custom-alert');
  const title = document.getElementById('alert-title');
  const msg = document.getElementById('alert-message');
  const iconWrapper = document.getElementById('alert-icon');
  const progress = document.getElementById('alert-progress');

  box.classList.remove('show');
  iconWrapper.className = 'custom-alert-icon';

  if (type === 'success') {
    title.innerText = 'Berhasil';
    iconWrapper.classList.add('success-icon');
    iconWrapper.innerHTML = '<iconify-icon icon="mdi:check" style="color: white;"></iconify-icon>';
  } else if (type === 'error') {
    title.innerText = 'Gagal';
    iconWrapper.classList.add('error-icon');
    iconWrapper.innerHTML = '<iconify-icon icon="mdi:close" style="color: white;"></iconify-icon>';
  } else {
    title.innerText = 'Info';
    iconWrapper.classList.add('info-icon');
    iconWrapper.innerHTML = '<iconify-icon icon="mdi:information" style="color: white;"></iconify-icon>';
  }

  msg.innerText = message;
  box.classList.add('show');

  progress.style.transition = 'none';
  progress.style.transform = 'scaleY(1)';
  void progress.offsetWidth;
  progress.style.transition = `transform ${duration}ms linear`;
  progress.style.transform = 'scaleY(0)';

  setTimeout(() => {
    box.classList.remove('show');
  }, duration);
}


document.querySelectorAll('[data-action="open-modal"]').forEach(item => {
    item.addEventListener("click", function () {
        const modalId = this.dataset.target;
        const modal = document.getElementById(modalId);

        const id = this.dataset.id;
        const acara = this.dataset.acara;
        const jumlah = this.dataset.jumlah;
        const img = this.dataset.img;
        const divisi = this.dataset.divisi;
        const url = this.dataset.url;

        modal.querySelector('#notif-id').value = id;
        modal.querySelector('#event').value = acara;
        modal.querySelector('#amount').value = jumlah;
        if(img){
            modal.querySelector('#image-preview').src = img;
        }
        else{
            modal.querySelector('#image-preview').src = 'asset/image/Profile _ Group';
        }
        modal.querySelector('.title-modal').textContent = divisi;
        modal.querySelector('#detail-link').href = url || '#';
        modal.classList.add("active");
    });
});
