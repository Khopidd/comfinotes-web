function showAlert(message, type = 'info', duration = 3000) {
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
  progress.style.transform = 'scaleX(1)';
  void progress.offsetWidth;
  progress.style.transition = `transform ${duration}ms linear`;
  progress.style.transform = 'scaleX(0)';

  setTimeout(() => {
    box.classList.remove('show');
  }, duration);
}


document.querySelectorAll('[data-action="open-modal"]').forEach(el => {
    el.addEventListener('click', () => {
        const id = el.dataset.id;
        const acara = el.dataset.acara;
        const jumlah = el.dataset.jumlah;
        const img = el.dataset.img;
        const divisi = el.dataset.divisi;

        document.querySelector('.title-modal').textContent = divisi;
        document.querySelector('#event').value = acara;
        document.querySelector('#amount').value = jumlah;
        document.querySelector('.image-1').src = img;

        document.getElementById('modal-notifications').dataset.notifId = id;
        document.getElementById('modal-notifications').classList.add('active');
    });
});
