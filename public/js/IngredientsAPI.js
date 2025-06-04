import {DataService} from "./DataService.js";
class IngredientsAPI extends DataService {

    constructor() {
        super("ingredientsAPI");
    }

    async getIngredients(string = '') {
        return await this.sendRequest(
            "getIngredients" + string,
            "POST",
            100,
            null,
            []);
    }
}

export {IngredientsAPI}