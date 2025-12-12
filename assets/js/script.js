// ============================
// Garasi Muda JS SCRIPT
// ============================

// Navbar Scroll Effect
window.addEventListener("scroll", function () {
    const header = document.querySelector("header"); // ambil elemen header
    if (window.scrollY > 50) {
        // jika scroll lebih dari 50px, tambahkan class "scrolled"
        header.classList.add("scrolled");
    } else {
        // jika scroll kurang dari 50px, hapus class "scrolled"
        header.classList.remove("scrolled");
    }
});

// Fade-in Animation saat scroll
const fadeElements = document.querySelectorAll(".fade-in"); // ambil semua elemen fade-in

function showElements() {
    const triggerBottom = window.innerHeight * 0.85; // posisi trigger muncul elemen
    fadeElements.forEach(el => {
        const boxTop = el.getBoundingClientRect().top; // posisi elemen relatif ke viewport
        if (boxTop < triggerBottom) {
            // jika elemen sudah terlihat, tambahkan class "visible"
            el.classList.add("visible");
        } else {
            // jika elemen belum terlihat, hapus class "visible"
            el.classList.remove("visible");
        }
    });
}

// jalankan fungsi showElements saat scroll
window.addEventListener("scroll", showElements);
// jalankan sekali saat halaman dimuat
showElements();

// Scroll To Top Button
const scrollBtn = document.createElement("button"); // buat tombol scroll top
scrollBtn.textContent = "↑";                         // isi teks tombol
scrollBtn.id = "scrollTopBtn";                      // beri id
document.body.appendChild(scrollBtn);              // tambahkan ke body

// Tambahkan event klik untuk scroll ke atas
scrollBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: 'smooth' }); // scroll smooth ke atas
});

// Tampilkan tombol hanya saat scroll lebih dari 200px
window.addEventListener("scroll", () => {
    scrollBtn.style.display = window.scrollY > 200 ? "block" : "none";
});

// Efek form contact
const form = document.querySelector("form"); // ambil form
if (form) {
    form.addEventListener("submit", (e) => {
        // tampilkan alert saat submit
        alert("Pesan kamu berhasil dikirim! Terima kasih sudah menghubungi Garasi Muda 🚗💨");
    });
}
