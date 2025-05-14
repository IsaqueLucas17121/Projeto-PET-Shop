import express from 'express';
import { 
  createUser, 
  readUser, 
  updateUser, 
  deleteUser, 
  getUserId,
  userLogin,
  notFound,
  getCurrentUser,
} from '../controllers/UserController.js';
import { validateUserCreation, validateUserUpdate } from '../validators/userValidators.js';

const router = express.Router();

// Rotas públicas
router.post('/login', userLogin);
router.post('/register', validateUserCreation, createUser);

// Rotas protegidas por autenticação

router.get('/', readUser);
router.get('/me', getCurrentUser);
router.get('/:id', getUserId);
router.put('/:id', validateUserUpdate, updateUser);
router.delete('/:id', deleteUser);

// Rota de exemplo protegida

// Manipulador para rotas não encontradas
router.use(notFound);

export default router;