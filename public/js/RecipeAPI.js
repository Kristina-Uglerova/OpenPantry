import {DataService} from "./DataService.js";
class RecipesAPI extends DataService {

    constructor() {
        super("recipesApi");
    }

    async getRecipes(string = '') {
        return await this.sendRequest(
            "getRecipes" + string,
            "POST",
            200,
            null,
            []);
    }
}

export {RecipesAPI}