import bcrypt from 'bcrypt';
import jwt from 'jsonwebtoken';
import { v4 as uuidv4 } from 'uuid';
import User from '../models/User.js';
import Pet from '../models/Pet.js';

class UserController {
  async register(req, res) {
    try {
      const { password, confirmPassword, ...userData } = req.body;

      // Validações
      if (password !== confirmPassword) {
        return res.status(400).json({
          success: false,
          message: 'Senha e confirmação de senha não coincidem'
        });
      }

      // Verificar se usuário já existe
      const userExists = await User.findOne({
        where: { email: userData.email }
      });

      if (userExists) {
        return res.status(409).json({
          success: false,
          message: 'Usuário já cadastrado com este email'
        });
      }

      // Criptografar senha
      const salt = await bcrypt.genSalt(10);
      const hashedPassword = await bcrypt.hash(password, salt);

      // Criar usuário
      const user = await User.create({
        ...userData,
        id: uuidv4(),
        password: hashedPassword
      });

      // Remover senha do retorno
      const userResponse = user.toJSON();
      delete userResponse.password;

      // Gerar token JWT
      const token = jwt.sign(
        { id: user.id, email: user.email, tipo_user: user.tipo_user },
        process.env.JWT_SECRET,
        { expiresIn: '7d' }
      );

      return res.status(201).json({
        success: true,
        message: 'Usuário cadastrado com sucesso',
        data: {
          user: userResponse,
          token
        }
      });

    } catch (error) {
      console.error('Erro no cadastro de usuário:', error);
      return res.status(500).json({
        success: false,
        message: 'Erro no cadastro de usuário',
        error: error.message
      });
    }
  }

  async getUserWithPets(req, res) {
    try {
      const { id } = req.params;

      const user = await User.findByPk(id, {
        attributes: { exclude: ['password'] },
        include: [{
          model: Pet,
          as: 'pets'
        }]
      });

      if (!user) {
        return res.status(404).json({
          success: false,
          message: 'Usuário não encontrado'
        });
      }

      return res.status(200).json({
        success: true,
        message: 'Usuário e pets encontrados',
        data: user
      });

    } catch (error) {
      console.error('Erro ao buscar usuário:', error);
      return res.status(500).json({
        success: false,
        message: 'Erro ao buscar usuário',
        error: error.message
      });
    }
  }

  // Outros métodos do controller...
}

export default new UserController();