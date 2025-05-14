import bcrypt from 'bcrypt';
import User from '../models/User.js';
import jwt from 'jsonwebtoken';
import { v4 as uuidv4 } from 'uuid';

export const createUser = async (req, res) => {
    try {
        const { name, email, password } = req.body;
        
        const salt = await bcrypt.genSalt(10);
        const hashedPassword = await bcrypt.hash(password, salt);

        const novoUser = await User.create({
            id_user: uuidv4(),
            name,
            email,
            password: hashedPassword,
        });

        const userResponse = { ...novoUser.get(), password: undefined };
        
        res.status(201).json({
            success: true,
            message: '✅ Usuário criado com sucesso!',
            user: userResponse
        });

    } catch (error) {
        console.error('Error creating user:', error);
        res.status(500).json({
            success: false,
            message: 'Erro ao criar usuário',
            error: error.message
        });
    }
};

export const readUser = async (req, res) => {
    try {
        const users = await User.findAll({
            attributes: { exclude: ['password'] }
        });
        res.status(200).json({
            success: true,
            data: users
        });
    } catch (error) {
        console.error('Error fetching users:', error);
        res.status(500).json({
            success: false,
            message: 'Erro ao buscar usuários',
            error: error.message
        });
    }
};

export const updateUser = async (req, res) => {
    try {
        const id_user = req.params.id;
        const [updated] = await User.update(req.body, {
            where: { id_user }
        });

        if (updated) {
            res.status(200).json({
                success: true,
                message: `Usuário ${id_user} atualizado com sucesso!`
            });
        } else {
            res.status(404).json({
                success: false,
                message: `Usuário ${id_user} não encontrado`
            });
        }
    } catch (error) {
        console.error('Error updating user:', error);
        res.status(500).json({
            success: false,
            message: `Erro ao atualizar usuário ${id_user}`,
            error: error.message
        });
    }
};

export const deleteUser = async (req, res) => {
    try {
        const id_user = req.params.id;
        const deleted = await User.destroy({
            where: { id_user }
        });

        if (deleted) {
            res.status(200).json({
                success: true,
                message: `Usuário ${id_user} deletado com sucesso!`
            });
        } else {
            res.status(404).json({
                success: false,
                message: `Usuário ${id_user} não encontrado`
            });
        }
    } catch (error) {
        console.error('Error deleting user:', error);
        res.status(500).json({
            success: false,
            message: `Erro ao deletar usuário ${id_user}`,
            error: error.message
        });
    }
};

export const getUserId = async (req, res) => {
    try {
        const id_user = req.params.id;
        const user = await User.findByPk(id_user, {
            attributes: { exclude: ['password'] }
        });

        if (user) {
            res.status(200).json({
                success: true,
                data: user
            });
        } else {
            res.status(404).json({
                success: false,
                message: `Usuário ${id_user} não encontrado`
            });
        }
    } catch (error) {
        console.error('Error fetching user:', error);
        res.status(500).json({
            success: false,
            message: `Erro ao buscar usuário ${id_user}`,
            error: error.message
        });
    }
};

export const getCurrentUser = async (req, res) => {
    const { email, password } = req.body;

    try {
        if (!email || !password) {
            return res.status(400).json({
                success: false,
                message: 'Email e senha são obrigatórios'
            });
        }

        const user = await User.findOne({ where: { email } });

        if (!user) {
            return res.status(404).json({ 
                success: false, 
                message: 'Usuário não encontrado' 
            });
        }

        console.log('Senha fornecida:', password); // Depuração
        console.log('Senha no banco:', user.password); // Depuração

        // Verifica se a senha no banco está hasheada
        const isPasswordValid = await bcrypt.compare(password, user.password);
        console.log('Resultado da comparação:', isPasswordValid); // Depuração

        if (!isPasswordValid) {
            return res.status(401).json({ 
                success: false, 
                message: 'Credenciais inválidas' 
            });
        }

        // Autenticação bem-sucedida
        res.status(200).json({ 
            success: true, 
            user: {
                id: user.id_user,
                name: user.name,
                email: user.email
            }
        });

    } catch (error) {
        console.error('Erro ao buscar usuário:', error);
        res.status(500).json({ 
            success: false, 
            message: 'Erro interno no servidor' 
        });
    }
};

export const userLogin = async (req, res) => {
    const { email, password } = req.body;

    try {
        // 1. Validação dos campos de entrada
        if (!email || !password) {
            return res.status(400).json({
                success: false,
                message: 'Email e senha são obrigatórios'
            });
        }

        // 2. Busca o usuário (sem usar scope incorreto)
        const user = await User.findOne({ 
            where: { email },
            attributes: ['id_user', 'name', 'email', 'password'] // Inclui password explicitamente
        });

        if (!user) {
            return res.status(401).json({
                success: false,
                message: 'Email não cadastrado'
            });
        }

        // 3. Debug: Verifique os valores antes da comparação
        console.log('[DEBUG] Senha recebida:', password);
        console.log('[DEBUG] Hash no banco:', user.password);

        // 4. Comparação de senha com tratamento de erro
        let isMatch;
        try {
            isMatch = await bcrypt.compare(password, user.password);
        } catch (bcryptError) {
            console.error('[BCRYPT ERROR]', bcryptError);
            return res.status(500).json({
                success: false,
                message: 'Erro ao verificar senha'
            });
        }

        if (!isMatch) {
            return res.status(401).json({
                success: false,
                message: 'Senha incorreta'
            });
        }

        // 5. Geração do token
        const token = jwt.sign(
            { 
                id_user: user.id_user,
                email: user.email 
            },
            process.env.JWT_SECRET || 'fallback-secret-key',
            { expiresIn: '1h' }
        );

        // 6. Resposta formatada
        res.status(200).json({
            success: true,
            message: '✅ Login realizado com sucesso',
            token,
            user: {
                id_user: user.id_user,
                name: user.name,
                email: user.email
            }
        });


    } catch (error) {
        console.error('[LOGIN ERROR]', error);
        res.status(500).json({
            success: false,
            message: 'Erro interno no servidor',
            error: error.message 
        });        
    }
};

export const notFound = (req, res) => {
    res.status(404).json({
        success: false,
        message: 'Endpoint não existente'
    });
};