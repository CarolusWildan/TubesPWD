document.addEventListener('DOMContentLoaded', function() {
    
    // Elemen DOM
    const formContainer = document.getElementById('addBookFormContainer');
    const toggleBtn = document.getElementById('toggleAddBookForm');
    const form = document.getElementById('addBookForm');
    const formTitle = document.getElementById('formTitle');
    const btnSave = document.getElementById('btnSave');
    const btnCancel = document.getElementById('btnCancelEdit');
    const coverInput = document.getElementById('cover');
    const coverHint = document.getElementById('cover-hint');

    // URL Dasar untuk Action (Sesuaikan dengan route Anda)
    // Asumsi: Create -> action=create, Update -> action=update
    const baseURL = "indexAdmin.php?controller=book";

    // --- FUNGSI 1: RESET FORM KE MODE 'TAMBAH' ---
    function resetFormToCreate() {
        form.reset(); // Kosongkan input
        document.getElementById('book_id').value = ''; // Kosongkan ID hidden
        
        // Ubah UI
        formTitle.textContent = "Form Tambah Buku Baru";
        btnSave.textContent = "Simpan Data";
        toggleBtn.textContent = "Sembunyikan Form"; // Karena form sedang terbuka
        
        // Ubah Action URL
        form.action = baseURL + "&action=create";
        
        // Cover wajib diisi saat tambah baru
        coverInput.required = true;
        coverHint.style.display = 'none';
        btnCancel.style.display = 'none';
    }

    // --- FUNGSI 2: SET FORM KE MODE 'EDIT' ---
    function setFormToEdit(data) {
        // Buka form jika tertutup
        if (!formContainer.classList.contains('expanded')) {
            formContainer.classList.add('expanded');
            toggleBtn.textContent = "Sembunyikan Form";
            toggleBtn.style.backgroundColor = '#f39c12';
        }

        // Isi input dengan data dari tombol
        document.getElementById('book_id').value = data.id;
        document.getElementById('title').value = data.title;
        document.getElementById('author').value = data.author;
        document.getElementById('publish_year').value = data.year;
        document.getElementById('category').value = data.category;

        // Ubah UI
        formTitle.textContent = "Edit Data Buku";
        btnSave.textContent = "Update Data";
        
        // Ubah Action URL
        form.action = baseURL + "&action=update&id=" + data.id;

        // Cover opsional saat edit
        coverInput.required = false;
        coverHint.style.display = 'block';
        btnCancel.style.display = 'inline-block';
        
        // Scroll ke form agar user melihat
        formContainer.scrollIntoView({ behavior: 'smooth' });
    }

    // --- EVENT LISTENER TOMBOL UTAMA (+ Tambah) ---
    if (toggleBtn && formContainer) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Jika form sedang dalam mode edit, klik tombol ini akan mereset ke mode tambah
            if (document.getElementById('book_id').value !== '') {
                resetFormToCreate();
            } else {
                // Logika toggle biasa (buka/tutup)
                formContainer.classList.toggle('expanded');
                if (formContainer.classList.contains('expanded')) {
                    this.textContent = 'Sembunyikan Form';
                    this.style.backgroundColor = '#f39c12';
                } else {
                    this.textContent = '+ Tambah Buku Baru';
                    this.style.backgroundColor = '#2ecc71';
                }
            }
        });
    }

    // --- EVENT LISTENER TOMBOL EDIT (Di dalam tabel) ---
    // Gunakan event delegation karena tombol edit mungkin banyak
    document.querySelector('.data-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-edit-trigger')) {
            const btn = e.target;
            
            // Ambil data dari atribut data-*
            const data = {
                id: btn.getAttribute('data-id'),
                title: btn.getAttribute('data-title'),
                author: btn.getAttribute('data-author'),
                year: btn.getAttribute('data-year'),
                category: btn.getAttribute('data-category')
            };

            setFormToEdit(data);
        }
    });

    // --- EVENT LISTENER TOMBOL BATAL EDIT ---
    if (btnCancel) {
        btnCancel.addEventListener('click', function() {
            resetFormToCreate();
            // Opsional: Tutup form juga
            formContainer.classList.remove('expanded');
            toggleBtn.textContent = '+ Tambah Buku Baru';
            toggleBtn.style.backgroundColor = '#2ecc71';
        });
    }

    // --- LOGIKA AJAX SUBMIT (TETAP SEPERTI SEBELUMNYA) ---
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = form.querySelector('.btn-submit');
            const originalText = submitBtn.innerText;
            submitBtn.innerText = 'Memproses...';
            submitBtn.disabled = true;

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Berhasil: ' + data.message);
                    window.location.reload();
                } else {
                    alert('Gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi.');
            })
            .finally(() => {
                submitBtn.innerText = originalText;
                submitBtn.disabled = false;
            });
        });
    }
});