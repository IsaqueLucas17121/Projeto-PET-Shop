import { body } from 'express-validator';

export const validateUserCreation = [
  body('email').isEmail().normalizeEmail(),
  body('password').isLength({ min: 8 }),
  body('name').notEmpty().trim()
];

export const validateUserUpdate = [
  body('email').optional().isEmail().normalizeEmail(),
  body('password').optional().isLength({ min: 8 }),
  body('name').optional().notEmpty().trim()
];