document.addEventListener('DOMContentLoaded', function() {
    const formContainer = document.getElementById('addBookFormContainer');
    const toggleBtn = document.getElementById('toggleAddBookForm');

    // Set state awal tombol
    // Periksa apakah elemen ditemukan sebelum menambahkan listener
    if (toggleBtn && formContainer) {
        toggleBtn.textContent = '+ Tambah Buku Baru';

        // Fungsi untuk men-toggle form (expand/collapse)
        toggleBtn.addEventListener('click', function() {
            // Toggle class 'expanded'
            formContainer.classList.toggle('expanded');

            // Ubah teks tombol berdasarkan status form
            if (formContainer.classList.contains('expanded')) {
                this.textContent = 'Sembunyikan Form';
                this.style.backgroundColor = '#f39c12'; // Warna orange untuk Sembunyikan
            } else {
                this.textContent = '+ Tambah Buku Baru';
                this.style.backgroundColor = '#2ecc71'; // Warna hijau untuk Tambah
            }
        });
    }


    // Logika Fade Out Pesan Sukses/Error (Dipertahankan)
    // Selektor menggunakan attribute style yang unik
    const successAlert = document.querySelector('.book-management-container > div[style*="d4edda"]');
    const errorAlert = document.querySelector('.book-management-container > div[style*="f8d7da"]');

    if (successAlert || errorAlert) {
        // Durasi transisi
        const transitionDuration = '1s';
        
        setTimeout(() => {
            // Tambahkan transisi ke element alert untuk smooth fade out
            if (successAlert) {
                successAlert.style.transition = `opacity ${transitionDuration} ease-out`;
                successAlert.style.opacity = '0';
            }
            if (errorAlert) {
                errorAlert.style.transition = `opacity ${transitionDuration} ease-out`;
                errorAlert.style.opacity = '0';
            }
        }, 5000); // Pesan akan mulai hilang setelah 5 detik
        
        // Hapus element dari DOM setelah transisi selesai (Opsional)
        setTimeout(() => {
            if (successAlert) successAlert.remove();
            if (errorAlert) errorAlert.remove();
        }, 5000 + (parseInt(transitionDuration) * 1000)); 
    }
});