import PetController from '../controllers/pet.Controller.js';
import { Router } from 'express'
const router = Router();

// Rotas protegidas por autenticação
router.post('', PetController.create);
router.get('', PetController.getAll);

export default router;