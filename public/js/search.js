document.addEventListener("DOMContentLoaded", () => {
    const searchBtn = document.getElementById("searchBtn");
    const searchInput = document.getElementById("searchInput");

    searchBtn.addEventListener("click", () => {
        const keyword = searchInput.value.trim();

        //validasi kalau button search kosong atau belum ada inputan
        if (keyword === "") {
            alert("Kolom pencarian masih kosong!");
            return;
        }

        window.location.href = `index.php?controller=book&action=search&keyword=${keyword}`;
    });

    // Tekan ENTER juga bisa untuk search
    searchInput.addEventListener("keyup", (e) => {
        if (e.key === "Enter") {
            searchBtn.click();
        }
    });
});
