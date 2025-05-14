import express from 'express';
import userController from '../controllers/User.Controller.js';
import { validateUserCreation, validateUserUpdate } from '../validators/userValidators.js';

const router = express.Router();

// Rotas públicas
router.post('/login', userController.Login);
router.post('/register', validateUserCreation, userController.create);

// Rotas protegidas por autenticação
router.get('/', userController.readUser);
router.get('/me', userController.getCurrentUser);
router.get('/:id', userController.getUserId);
router.put('/:id', validateUserUpdate, userController.update);
router.delete('/:id', userController.delete);

// Rota de exemplo protegida

// Manipulador para rotas não encontradas
router.use(userController.notFound);

export default router;