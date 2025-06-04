import {IngredientsAPI} from "./IngredientsAPI.js";
window.openModal = openModal;
function openModal(id) {
    console.log("Opening modal with ID:", id);
    document.getElementById(id).style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";
}

window.closeModal = closeModal;
function closeModal(id) {
    document.getElementById(id).style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
}

function openMessageModal(id, message) {
    document.getElementById(id).textContent = message;
    openModal(id);
}

window.openIngredientModal = openIngredientModal
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


document.getElementById("ingredientSearchBar").onchange += async () => {
    await triggerIngredientSearch()
}

document.getElementById("ingredientSearchBar").oninput = async () => {
    triggerIngredientSearch()
}
window.triggerIngredientSearch = async function () {
    console.log("Triggering ingredient search...");
    var ingredientsAPI = new IngredientsAPI()

    const query = document.getElementById('ingredientSearchBar').value.trim();
    try {
        const result = await ingredientsAPI.getIngredients('&name=' + query);
        console.log(result);
        renderSearchResults(result);
    } catch (error) {
        console.error("Error fetching ingredients:", error);
    }
}

function renderSearchResults(results) {
    const resultList = document.getElementById('searchResults');
    resultList.innerHTML = '';
    if (!results || results.length === 0) {
        resultList.innerHTML = '<li>No results found.</li>';
        return;
    }

    results.forEach(ingredient => {
        const li = document.createElement('li');
        li.textContent = `${ingredient.name} (${ingredient.unit})`;

        li.addEventListener('dblclick', () => {
            addIngredientToSelectedList(ingredient);
        });

        resultList.appendChild(li);
    });
}

function addIngredientToSelectedList(ingredient) {
    const selectedList = document.getElementById('selectedIngredients');

    const li = document.createElement('li');
    li.innerHTML = `
            ${ingredient.name} (${ingredient.unit})
            <input type="number" placeholder="Amount" id="amountInput"">
        `;

    selectedList.appendChild(li);
}

function addNewIngredient() {
    //ingredient = document.getElementById('newIngredientName').value;
}