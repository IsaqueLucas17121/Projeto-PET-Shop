import { body } from 'express-validator';

export const validateUserCreation = [
  body('nome').notEmpty().trim(),
  body('Sobrenome').notEmpty().trim(),
  body('email').isEmail().normalizeEmail(),
  body('celular').isNumeric().isLength({ min: 10, max: 15 }),
  body('cpf').isNumeric().isLength({ min: 11, max: 11 }),
  body('password').notEmpty().isLength({ min: 8 }),
];

export const validateUserUpdate = [
  body('nome').optional().notEmpty().trim(),
  body('Sobrenome').optional().notEmpty().trim(),
  body('email').optional().isEmail().normalizeEmail(),
  body('celular').optional().isNumeric().isLength({ min: 10, max: 15 }),
  body('cpf').optional().isNumeric().isLength({ min: 11, max: 11 }),
  body('password').optional().isLength({ min: 8 }),
];