document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("loginForm");
  if (!form) return; // kalau bukan halaman login, biarkan saja

  form.addEventListener("submit", function (e) {
    const username = form.username.value.trim();
    const password = form.password.value.trim();

    const errors = [];

    // Cek username
    if (!username) {
      errors.push("Username wajib diisi.");
    }

    // Cek password
    if (!password) {
      errors.push("Password wajib diisi.");
    }

    if (errors.length > 0) {
      e.preventDefault(); // stop pengiriman ke PHP
      alert(errors.join("\n"));
    }
  });
});
