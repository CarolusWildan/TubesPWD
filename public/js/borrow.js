// Fungsi helper: format Date -> "YYYY-MM-DD"
function formatDateToInput(date) {
    const year  = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // bulan mulai dari 0
    const day   = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

document.addEventListener('DOMContentLoaded', function () {
    const tglPinjam  = document.getElementById('tgl_pinjam');
    const tglKembali = document.getElementById('tgl_kembali');

    // Kalau form ini tidak ada di halaman, langsung keluar biar nggak error
    if (!tglPinjam || !tglKembali) return;

    const today = new Date();
    const returnDate = new Date(today);
    returnDate.setDate(today.getDate() + 7); // H+7

    // Set nilai default
    const todayStr      = formatDateToInput(today);
    const returnDateStr = formatDateToInput(returnDate);

    // Tanggal peminjaman = hari ini, readonly
    tglPinjam.value   = todayStr;
    tglPinjam.readOnly = true; // readonly, tapi tetap ikut terkirim ke POST

    // Tanggal pengembalian:
    tglKembali.value = returnDateStr;
    tglKembali.min   = todayStr;      // tidak boleh sebelum hari ini
    tglKembali.max   = returnDateStr; // tidak boleh lewat 7 hari

    // Validasi kalau user mengubah tanggal pengembalian
    tglKembali.addEventListener('change', function () {
        if (this.value > this.max) {
            alert('Tanggal pengembalian maksimal 7 hari dari hari ini.');
            this.value = this.max;
        }

        if (this.value < this.min) {
            alert('Tanggal pengembalian tidak boleh sebelum tanggal peminjaman.');
            this.value = this.min;
        }
    });
});
