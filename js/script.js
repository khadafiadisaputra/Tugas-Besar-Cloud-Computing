document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('detailModal');
    const closeModalButton = document.getElementById('closeModal');
    const memberCards = document.querySelectorAll('.detail-card');

    const modalFoto = document.getElementById('modalFoto');
    const modalNama = document.getElementById('modalNama');
    const modalNim = document.getElementById('modalNim');
    const modalKelas = document.getElementById('modalKelas');
    const modalPeran = document.getElementById('modalPeran');
    const modalDeskripsi = document.getElementById('modalDeskripsi');

    function openModal(card) {
        if (!modal) return;

        modalFoto.src = card.dataset.foto || '';
        modalFoto.alt = 'Foto ' + (card.dataset.nama || 'mahasiswa');
        modalNama.textContent = card.dataset.nama || '-';
        modalNim.textContent = card.dataset.nim || '-';
        modalKelas.textContent = card.dataset.kelas || '-';
        modalPeran.textContent = card.dataset.peran || '-';
        modalDeskripsi.textContent = card.dataset.deskripsi || '-';

        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
    }

    memberCards.forEach(function (card) {
        card.addEventListener('click', function (event) {
            if (event.target.closest('.edit-btn')) {
                return;
            }
            openModal(card);
        });

        card.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openModal(card);
            }
        });
    });

    if (closeModalButton) {
        closeModalButton.addEventListener('click', closeModal);
    }

    if (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
});
