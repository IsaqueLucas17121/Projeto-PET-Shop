import BaseController from "./Base.Controller.js";
import { User } from "../models/index.js"; // A

class UserController extends BaseController {
    constructor() {
        super();
        this.model = User;
        this.modelName = 'User';
    }
}

export default UserController;