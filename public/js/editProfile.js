document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".profile-form");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // hentikan submit default

        // Ambil input
        const nameInput = document.getElementById("user");
        const addressInput = document.getElementById("address");
        const phoneInput = document.getElementById("phone");

        // Ambil data lama dari server (disimpan di dataset atau hidden field)
        const oldName = form.dataset.oldName || "";
        const oldAddress = form.dataset.oldAddress || "";
        const oldPhone = form.dataset.oldPhone || "";

        // Isi data lama kalau field kosong
        if (nameInput.value.trim() === "") {
            nameInput.value = oldName;
        }
        if (addressInput.value.trim() === "") {
            addressInput.value = oldAddress;
        }
        if (phoneInput.value.trim() === "") {
            phoneInput.value = oldPhone;
        }

        // Submit form
        form.submit();
    });
});
