import express from 'express';
import UserControler from '../controllers/Base.Controller.js';
import User from '../models/User.js'; 
import { validateUserCreation, validateUserUpdate } from '../validators/userValidators.js';
import { authenticateToken } from '../middleware/EssencialsMiddleware.js';

const router = express.Router();
const userController = new UserControler(User); 

// Rotas públicas
router.post('/register', validateUserCreation, (req, res) => userController.create(req, res));
router.post('/login', (req, res) => userController.login(req, res));

router.use(authenticateToken);

// Rotas protegidas
router.get('/', (req, res) => userController.read(req, res));
router.get('/me', (req, res) => userController.getCurrentUser(req, res));
router.get('/:id', (req, res) => userController.readById(req, res));
router.put('/:id', validateUserUpdate, (req, res) => userController.update(req, res));
router.delete('/:id', (req, res) => userController.delete(req, res));

// Rota não encontrada
router.use((req, res) => userController.notFound(req, res));

export default router;