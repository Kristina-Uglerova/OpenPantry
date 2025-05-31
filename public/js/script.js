function openModal(id) {
    document.getElementById(id).style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
}