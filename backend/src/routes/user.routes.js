import express from 'express';
import BaseController from '../controllers/Base.Controller.js';
import { validateUserCreation, validateUserUpdate } from '../validators/userValidators.js';
import { authenticateToken } from '../middlewares/authMiddleware.js';

const router = express.Router();

// Rotas públicas
router.post('/login', BaseController.login);
router.post('/register', validateUserCreation, BaseController.create);

// Middleware de autenticação para rotas protegidas
router.use(authenticateToken);

// Rotas protegidas
router.get('/', BaseController.read);
router.get('/me', BaseController.getCurrentUser);
router.get('/:id', BaseController.readById);
router.put('/:id', validateUserUpdate, BaseController.update);
router.delete('/:id', BaseController.delete);

// Rota não encontrada
router.use(BaseController.notFound);

export default router;

router.post('', (req, res) => Products.create(req, res));
router.get('', (req, res) => Products.read(req, res));
router.get('/:id', (req, res) => Products.readById(req, res));
router.put('/:id', (req, res) => Products.update(req, res));
router.delete('/:id', (req, res) => Products.delete(req, res));