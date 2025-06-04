function openModal(id) {
    document.getElementById(id).style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
}

function openIngredientModal(modalId, button) {
    document.getElementById(modalId).style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";

    const name = button.dataset.name;
    const unit = button.dataset.unit;
    const id = button.dataset.id;

    document.querySelector("#ingredientForm input[name='name']").value = name;
    document.querySelector("#ingredientForm input[name='unit']").value = unit;

    let idField = document.getElementById("ingredient-id");
    if (!idField) {
        idField = document.createElement("input");
        idField.type = "hidden";
        idField.name = "id";
        idField.id = "ingredient-id";
        document.querySelector("#ingredientForm form").appendChild(idField);
    }
    idField.value = id;
}

function showMessage(text) {
    document.getElementById('message').textContent = text;
    openModal('messageModal');
}