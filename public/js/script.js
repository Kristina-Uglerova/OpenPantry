import {IngredientsAPI} from "./IngredientsAPI.js";
import {RecipesAPI} from "./RecipeAPI.js";
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
    var ingredientsAPI = new IngredientsAPI()
    const query = document.getElementById('ingredientSearchBar').value.trim();
    try {
        const result = await ingredientsAPI.getIngredients('&name=' + query);
        renderSearchResults(result);
    } catch (error) {
        console.error("Error fetching ingredients:", error);
    }
}

window.triggerRecipeSearch = async function () {
    var recipesApi = new RecipesAPI()
    const query = document.getElementById('recipeSearchBar').value.trim();
    try {
        const result = await recipesApi.getRecipes('&name=' + query);
        renderRecipesSearchResults(result);
    } catch (error) {
        console.error("Error fetching ingredients:", error);
    }
}

function renderRecipesSearchResults(results) {
    const resultList = document.getElementById('filteredRecipes');
    resultList.innerHTML = '';
    if (!results || results.length === 0) {
        resultList.innerHTML = '<p>No results found.</p>';
        return;
    }
    results.forEach(recipe => {
        const a = document.createElement('a');
        a.className = `recipe-card`;
        a.href = '?c=recipe&a=recipe_detail&recipeId=<?= htmlspecialchars($recipe->getId()) ?>'
        const image = document.createElement('img');
        image.alt = `${recipe.getName()}`
        image.src = `public/uploads/${recipe.getImagePath()}`
        a.appendChild(image)
        const name = document.createElement('h3')
        name.className = 'subtitle'
        name.innerText = `${($recipe.getName()) }`
        a.appendChild(name)
        resultList.appendChild(a);
    });
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
            <input type="number" placeholder="Amount" min="1" id="amountInput"">
        `;

    selectedList.appendChild(li);
}