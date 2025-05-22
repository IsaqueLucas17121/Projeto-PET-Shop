import PetController from '../controllers/pet.Controller.js';
import { Router } from 'express'
import model from '../models/index.js';
const router = Router();

const petController = new PetController(model.Pet);

router.post('/register', (req, res) => petController.create(req, res));


// Rotas protegidas por autenticação
router.post('', petController.create);
router.get('', petController.read);

export default router;