import {DataService} from "./DataService.js";
class IngredientsAPI extends DataService {

    constructor() {
        super("ingredientsApi");
    }

    async getIngredients(string = '') {
        return await this.sendRequest(
            "getIngredients" + string,
            "POST",
            200,
            null,
            []);
    }
}

export {IngredientsAPI}