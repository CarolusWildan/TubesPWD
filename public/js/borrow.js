// Fungsi untuk menambahkan leading zero
function padZero(num) {
    return String(num).padStart(2, '0');
}

// Set tanggal otomatis saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    // Cek apakah elemen tanggal ada (hindari error di halaman lain)
    if (!document.getElementById('pinjam-hari')) return;

    const today = new Date();
    const returnDate = new Date(today);
    returnDate.setDate(today.getDate() + 7);

    // Ambil komponen tanggal
    const pinjamHari = padZero(today.getDate());
    const pinjamBulan = padZero(today.getMonth() + 1);
    const pinjamTahun = today.getFullYear();

    const kembaliHari = padZero(returnDate.getDate());
    const kembaliBulan = padZero(returnDate.getMonth() + 1);
    const kembaliTahun = returnDate.getFullYear();

    // Isi input
    document.getElementById('pinjam-hari').value = pinjamHari;
    document.getElementById('pinjam-bulan').value = pinjamBulan;
    document.getElementById('pinjam-tahun').value = pinjamTahun;

    document.getElementById('kembali-hari').value = kembaliHari;
    document.getElementById('kembali-bulan').value = kembaliBulan;
    document.getElementById('kembali-tahun').value = kembaliTahun;
});