// =========================
// ADMIN PAGE INTERACTIONS
// =========================

// Fade-in animation saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", () => {
    const fadeEls = document.querySelectorAll(".fade-in");
    fadeEls.forEach(el => {
        el.style.opacity = 0;
        el.style.transform = "translateY(10px)";
        setTimeout(() => {
            el.style.transition = "all 0.8s ease";
            el.style.opacity = 1;
            el.style.transform = "translateY(0)";
        }, 300);
    });
});

// Optional: auto scroll to top saat submit form
const form = document.querySelector("form");
if (form) {
    form.addEventListener("submit", () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// =========================
// DELETE MODAL FUNCTIONALITY
// =========================
const modal = document.getElementById("deleteModal");
const closeBtn = document.querySelector(".modal .close");
const cancelBtn = document.getElementById("cancelBtn");
const confirmDelete = document.getElementById("confirmDelete");
let deleteId = null;
let deleteType = null;

document.querySelectorAll(".btn-delete").forEach(btn => {
    btn.addEventListener("click", function () {
        deleteId = this.dataset.id;
        deleteType = this.dataset.type;

        if (deleteType === "mobil") {
            confirmDelete.href = `delete_mobil.php?id=${deleteId}`;
        } else if (deleteType === "sparepart") {
            confirmDelete.href = `delete_sparepart.php?id=${deleteId}`;
        } else if (deleteType === "gallery") {
            confirmDelete.href = `delete_gallery.php?id=${deleteId}`;
        } else if (deleteType === "contact") {
            confirmDelete.href = `delete_contact.php?id=${deleteId}`;
        }
        modal.style.display = "flex";
    });
});

closeBtn.onclick = () => modal.style.display = "none";
cancelBtn.onclick = () => modal.style.display = "none";
window.onclick = function (e) {
    if (e.target == modal) modal.style.display = "none";
};

// ==========================
// MODAL LOGOUT
// ==========================
const logoutBtn = document.getElementById("logoutBtn");
const logoutModal = document.getElementById("logoutModal");
const logoutClose = document.getElementById("logoutClose");
const cancelLogout = document.getElementById("cancelLogout");

logoutBtn.addEventListener("click", e => {
    e.preventDefault(); // cegah redirect default sementara modal dibuka
    logoutModal.style.display = "flex";
});

logoutClose.addEventListener("click", () => {
    logoutModal.style.display = "none";
});

cancelLogout.addEventListener("click", () => {
    logoutModal.style.display = "none";
});

window.addEventListener("click", e => {
    if (e.target == logoutModal) logoutModal.style.display = "none";
});
