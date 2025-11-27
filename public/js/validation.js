document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("loginForm");
  if (!form) return; // kalau bukan halaman login, jangan apa-apa

  form.addEventListener("submit", function (e) {
    const username = form.username.value.trim();
    const password = form.password.value.trim();
    const role     = form.role.value.trim();

    const errors = [];

    // Cek username
    if (!username) {
      errors.push("Username wajib diisi.");
    }

    // Cek password
    if (!password) {
      errors.push("Password wajib diisi.");
    } else if (password.length < 6) {
      errors.push("Password minimal 6 karakter.");
    }

    // Cek role
    if (!role) {
      errors.push("Silakan pilih role (user atau librarian).");
    }

    if (errors.length > 0) {
      e.preventDefault(); // stop submit ke PHP
      alert(errors.join("\n")); // tampilkan semua error
    }
  });
});
