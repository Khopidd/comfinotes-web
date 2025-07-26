document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('[data-action="toggle-dropdown"]').forEach(trigger => {
        trigger.addEventListener("click", function (e) {
            e.stopPropagation();
            const targetId = this.getAttribute("data-target");
            const dropdown = document.getElementById(targetId);

            if (dropdown) {
                const isVisible = getComputedStyle(dropdown).display === "block";
                document.querySelectorAll(".notif-dropdown").forEach(d => d.style.display = "none");
                dropdown.style.display = isVisible ? "none" : "block";
            }
        });
    });

    document.addEventListener("click", function (e) {
        document.querySelectorAll(".notif-dropdown").forEach(d => d.style.display = "none");
    });

    document.querySelectorAll('[data-action="open-modal"]').forEach(button => {
        button.addEventListener("click", function () {
            const modalId = this.getAttribute("data-target");
            const modal = document.getElementById(modalId);
            if (modal) modal.style.display = "flex";
        });
    });

    document.querySelectorAll('[data-action="close-modal"]').forEach(button => {
        button.addEventListener("click", function () {
            const modalId = this.getAttribute("data-target");
            const modal = document.getElementById(modalId);
            if (modal) modal.style.display = "none";
        });
    });

    window.addEventListener("click", function (e) {
        document.querySelectorAll(".modal").forEach(modal => {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });
    });
});


document.querySelectorAll(".toggle-password").forEach(toggle => {
    toggle.addEventListener("click", function () {
        const passwordField = this.previousElementSibling;
        if (passwordField && passwordField.type === "password") {
            passwordField.type = "text";
            this.setAttribute("icon", "proicons:eye");
        } else if (passwordField) {
            passwordField.type = "password";
            this.setAttribute("icon", "proicons:eye-off");
        }
    });
});

document.querySelectorAll(".button-dropdown").forEach(button => {
    button.addEventListener("click", function (event) {
        event.stopPropagation();
        const container = button.closest(".dropdown-table");
        const dropdown = container ? container.querySelector(".dropdown-content") : null;

        document.querySelectorAll(".dropdown-content").forEach(d => {
            if (d !== dropdown) d.classList.remove("show");
        });

        if (dropdown) dropdown.classList.toggle("show");
    });
});

window.addEventListener("click", function () {
    document.querySelectorAll(".dropdown-content").forEach(d => {
        d.classList.remove("show");
    });
});


document.addEventListener("DOMContentLoaded", function () {
  const imageUploadBlocks = document.querySelectorAll(".image-add-acount");

  imageUploadBlocks.forEach((block) => {
    const fileInput = block.querySelector(".supporting-file");
    const previewContainer = block.querySelector(".image-preview-container");
    const imagePreview = block.querySelector(".image-preview");
    const deleteButton = block.querySelector(".delete-image");
    const uploadLabel = block.querySelector(".custom-file-label");

    previewContainer.style.display = "none";
    imagePreview.src = "";

    if (fileInput && previewContainer && imagePreview && uploadLabel && deleteButton) {
      fileInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file && file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = function (e) {
            imagePreview.src = e.target.result;
            previewContainer.style.display = "block";
            uploadLabel.style.display = "none";
          };
          reader.readAsDataURL(file);
        }
      });

      deleteButton.addEventListener("click", function () {
        fileInput.value = '';
        imagePreview.src = '';
        previewContainer.style.display = 'none';
        uploadLabel.style.display = 'inline-flex';
      });

      uploadLabel.addEventListener("click", function () {
        fileInput.click();
      });
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('catatan-detail');

    textarea.addEventListener('focus', function () {
        if (this.value.trim() === '') {
            this.value = '- ';
        }
    });
    textarea.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();

            const start = this.selectionStart;
            const end = this.selectionEnd;
            const value = this.value;

            const before = value.substring(0, start);
            const after = value.substring(end);

            this.value = before + '\n- ' + after;
            this.selectionStart = this.selectionEnd = start + 3;
        }
    });
});

document.querySelectorAll('[data-action="open-modal"]').forEach(item => {
        item.addEventListener("click", function () {
            const modalId = this.dataset.target;
            const modal = document.getElementById(modalId);
            const status = this.dataset.status;
            const notifId = this.dataset.id;

            const iconWrapper = modal.querySelector('#status-icon');
            const title = modal.querySelector('#status-title');
            const message = modal.querySelector('#status-message');

            iconWrapper.innerHTML = '';
            iconWrapper.className = 'status-icon';

            let iconHTML = '';
            let bgColor = '';
            let msg = '';

            if (status === 'pending') {
                iconHTML = `<iconify-icon icon="tabler:clock" class="icon-notif"></iconify-icon>`;
                bgColor = 'bg-orange';
                msg = 'Pengajuan anda sedang diproses.';
            } else if (status === 'approved') {
                iconHTML = `<iconify-icon icon="mdi:check-circle-outline" class="icon-notif"></iconify-icon>`;
                bgColor = 'bg-green';
                msg = 'Pengajuan anda disetujui.';
                markAsRead(notifId);
            } else if (status === 'rejected') {
                iconHTML = `<iconify-icon icon="mdi:close-circle-outline" class="icon-notif"></iconify-icon>`;
                bgColor = 'bg-red';
                msg = 'Pengajuan anda ditolak.';
                markAsRead(notifId);
            }

            iconWrapper.classList.add(bgColor);
            iconWrapper.innerHTML = iconHTML;
            message.textContent = msg;
            title.textContent = 'Status Pengajuan';

            modal.classList.add("active");
        });
    });

    function markAsRead(id) {
        let readIds = JSON.parse(localStorage.getItem("readNotifs") || "[]");
        if (!readIds.includes(id)) {
            readIds.push(id);
            localStorage.setItem("readNotifs", JSON.stringify(readIds));
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        let readIds = JSON.parse(localStorage.getItem("readNotifs") || "[]");
        document.querySelectorAll('.notif-items').forEach(item => {
            const status = item.dataset.status;
            const id = item.dataset.id;

            if (status !== 'pending' && readIds.includes(id)) {
                item.style.display = 'none';
            }
        });
    });
