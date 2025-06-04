import {IngredientsAPI} from "./IngredientsAPI.js";

document.getElementById("openIngredientsBtn").onclick += () => {
    openModal("ingredientSearcher")
}

document.openModal = function (id) {
    document.getElementById(id).style.display = "block";
    document.getElementById("modalOverlay").style.display = "block";
}

function closeModal(id) {
    document.getElementById(id).style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
}

function openMessageModal(id, message) {
    document.getElementById(id).textContent = message;
    openModal(id);
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


document.getElementById("ingredientSearchBar").onchange += async () => {
    await triggerIngredientSearch()
}

document.triggerIngredientSearch = async function () {
    var ingredientsAPI = new IngredientsAPI()

    console.log("I am here")
    const query = document.getElementById('ingredientSearchBar').value.trim();
    try {
        const result = await ingredientsAPI.getIngredients(query ? `?query=${encodeURIComponent(query)}` : '');
        console.log(result.size);
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

        const addButton = document.createElement('button');
        addButton.textContent = 'Add';
        addButton.classList.add('small_pill_button');
        addButton.onclick = () => addIngredientToSelectedList(ingredient);

        li.appendChild(addButton);
        resultList.appendChild(li);
    });
}

function addIngredientToSelectedList(ingredient) {
    const selectedList = document.getElementById('selectedIngredients');

    const li = document.createElement('li');
    li.innerHTML = `
            ${ingredient.name} (${ingredient.unit})
            <input type="number" placeholder="Amount" style="margin-left: 10px;">
        `;

    selectedList.appendChild(li);
}

function addNewIngredient() {
    //ingredient = document.getElementById('newIngredientName').value;
}

export {openModal};