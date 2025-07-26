<div id="modal-notifications" class="modal">
    <div class="modal-content">
        <span class="close-button" data-action="close-modal" data-target="modal-notifications">&times;</span>
        <h1 class="title-modal">Divisi Logistik</h1>
        <form action="{{ route('notif.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="notif_id" id="notif-id">

            <div class="image-aproof">
                <h2 class="img-text">Supporting Files</h2><strong>*</strong><span>Optional</span>
                <p class="img-text-2">Such as receipts, photos of event plans, etc.</p>
                <img src="#" alt="Proof Not Detected" class="image-1" id="image-preview">
            </div>

            <div class="input-content">
                <label for="event">Nama Acara<strong>*</strong></label>
                <input type="text" name="event_name" id="event" placeholder="Contoh : Musyawarah" disabled>
            </div>

            <div class="input-content">
                <label for="amount">Jumlah<strong>*</strong></label>
                <input type="text" name="amount" id="amount" placeholder="Contoh : 2.450.000" disabled>
            </div>

            <div class="button-modal">
                <button type="submit" name="action" value="rejected" class="button-reject">Cancelled</button>
                <button type="submit" name="action" value="approved" class="button-approv">Approved</button>
            </div>
            <div class="link-detail">
                <a href="#" class="link-info" id="detail-link">See Details</a>
            </div>
        </form>
    </div>
</div>
