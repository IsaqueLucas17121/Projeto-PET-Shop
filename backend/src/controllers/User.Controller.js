import BaseController from "./Base.Controller.js";
import { User } from "../models/index.js";

class UserController extends BaseController {
    constructor() {
        super(User); // Passa o modelo User para o BaseController
    }
    
    // Você pode adicionar métodos específicos para User aqui
}

export default UserController;