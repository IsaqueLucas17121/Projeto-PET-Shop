import model from "../models/index.js";
import BaseController from "./Base.Controller.js";

class PetController extends BaseController {
    constructor() {
        super(model.Pet);
    }

 
}



export default PetController;