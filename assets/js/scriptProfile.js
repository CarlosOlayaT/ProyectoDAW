const modal = document.getElementById('modalPerfil');
const btnOpen = document.getElementById('openModal');
const btnClose = document.getElementById('closeModal');

btnOpen.onclick = () => modal.style.display = "flex";
btnClose.onclick = () => modal.style.display = "none";

window.onclick = (e) => {
    if (e.target == modal) modal.style.display = "none";
}