import { v4 as uuidv4 } from 'uuid';
import bcrypt from 'bcrypt';
import jwt from 'jsonwebtoken';

const JWT_SECRET = process.env.JWT_SECRET || 'seuSegredoSuperSeguroAqui';

class BaseController {
    constructor(model) {
        this.model = model;
    }

    // Criar usuário
    async create(req, res) {
        try {
            let { password, ...otherData } = req.body;
            let data = { ...otherData, id: uuidv4() };

            if (password) {
                const hashPassword = await bcrypt.hash(password, 10);
                data.password = hashPassword;
            }

            const newItem = await this.model.create(data);

            res.status(201).json({
                success: true,
                message: '✅ Registro criado com sucesso!',
                item: newItem
            });
        } catch (error) {
            console.error('❌ Erro ao criar registro:', error);
            res.status(500).json({
                success: false,
                message: '❌ Erro ao criar registro.',
                error: error.message
            });
        }
    }

    // Listar todos (protegido)
    async read(req, res) {
        try {
            const items = await this.model.findAll({
                attributes: { exclude: ['password'] } // Não retorna senhas
            });
            
            res.status(200).json({
                success: true,
                message: '✅ Registros encontrados com sucesso!',
                items
            });
        } catch (error) {
            console.error('❌ Erro ao listar registros:', error);
            res.status(500).json({
                success: false,
                message: '❌ Erro ao listar registros.',
                error: error.message
            });
        }
    }

    // Buscar por ID (protegido)
    async readById(req, res) {
        try {
            const { id } = req.params;
            const item = await this.model.findOne({ 
                where: { id },
                attributes: { exclude: ['password'] }
            });

            if (!item) {
                return res.status(404).json({
                    success: false,
                    message: '❌ Registro não encontrado.'
                });
            }

            res.status(200).json({
                success: true,
                message: '✅ Registro encontrado com sucesso!',
                item
            });
        } catch (error) {
            console.error('❌ Erro ao buscar registro:', error);
            res.status(500).json({
                success: false,
                message: '❌ Erro ao buscar registro.',
                error: error.message
            });
        }
    }

    // Usuário atual (protegido)
    async getCurrentUser(req, res) {
        try {
            // Usuário é anexado pelo middleware de autenticação
            const user = req.user;
            
            if (!user) {
                return res.status(404).json({
                    success: false,
                    message: '❌ Usuário não encontrado.'
                });
            }

            // Busca dados atualizados do usuário
            const currentUser = await this.model.findOne({
                where: { id: user.id },
                attributes: { exclude: ['password'] }
            });

            res.status(200).json({
                success: true,
                message: '✅ Usuário atual encontrado!',
                user: currentUser
            });
        } catch (error) {
            console.error('❌ Erro ao buscar usuário atual:', error);
            res.status(500).json({
                success: false,
                message: '❌ Erro ao buscar usuário atual.',
                error: error.message
            });
        }
    }

    // Atualizar (protegido)
    async update(req, res) {
        try {
            const { id } = req.params;
            let { password, ...otherData } = req.body;
            let data = { ...otherData };

            const item = await this.model.findOne({ where: { id } });

            if (!item) {
                return res.status(404).json({
                    success: false,
                    message: '❌ Registro não encontrado.'
                });
            }

            // Verifica se o usuário tem permissão
            if (req.user.id !== item.id && !req.user.isAdmin) {
                return res.status(403).json({
                    success: false,
                    message: '❌ Você não tem permissão para atualizar este usuário.'
                });
            }

            if (password) {
                const hashPassword = await bcrypt.hash(password, 10);
                data.password = hashPassword;
            }

            await item.update(data);

            // Remove a senha da resposta
            const { password: _, ...updatedItem } = item.dataValues;

            res.status(200).json({
                success: true,
                message: '✅ Registro atualizado com sucesso!',
                item: updatedItem
            });
        } catch (error) {
            console.error('❌ Erro ao atualizar registro:', error);
            res.status(500).json({
                success: false,
                message: '❌ Erro ao atualizar registro.',
                error: error.message
            });
        }
    }

    // Deletar (protegido)
    async delete(req, res) {
        try {
            const { id } = req.params;
            const item = await this.model.findOne({ where: { id } });

            if (!item) {
                return res.status(404).json({
                    success: false,
                    message: '❌ Registro não encontrado.'
                });
            }

            // Verifica se o usuário tem permissão
            if (req.user.id !== item.id && !req.user.isAdmin) {
                return res.status(403).json({
                    success: false,
                    message: '❌ Você não tem permissão para deletar este usuário.'
                });
            }

            await item.destroy();

            res.status(200).json({
                success: true,
                message: '✅ Registro deletado com sucesso!'
            });
        } catch (error) {
            console.error('❌ Erro ao deletar registro:', error);
            res.status(500).json({
                success: false,
                message: '❌ Erro ao deletar registro.',
                error: error.message
            });
        }
    }

    // Login
    async login(req, res) {
        try {
            const { email, password } = req.body;

            const user = await this.model.findOne({ where: { email } });

            if (!user) {
                return res.status(404).json({
                    success: false,
                    message: '❌ Usuário não encontrado.'
                });
            }

            const isMatch = await bcrypt.compare(password, user.password);

            if (!isMatch) {
                return res.status(401).json({
                    success: false,
                    message: '❌ Credenciais inválidas.'
                });
            }

            const { password: _, ...userWithoutPassword } = user.dataValues;

            const token = jwt.sign(
                {
                    id: user.id,
                    email: user.email,
                    isAdmin: user.isAdmin || false
                },
                JWT_SECRET,
                { expiresIn: '1d' }
            );

            res.status(200).json({
                success: true,
                message: '✅ Login realizado com sucesso!',
                user: userWithoutPassword,
                token
            });
        } catch (error) {
            console.error('❌ Erro ao realizar login:', error);
            res.status(500).json({
                success: false,
                message: '❌ Erro ao realizar login.',
                error: error.message
            });
        }
    }


    async forgotPassword(req, res) {
        try {
            const { email } = req.body;

            const user = await this.model.findOne({ where: { email } });

            if (!user) {
                return res.status(404).json({ 
                    error: "Usuário não encontrado" 
                });
            }

            // Implementar lógica de recuperação de senha, se necessário
            return res.status(200).json({ 
                message: "Email de recuperação enviado" 
            });
        } catch (error) {
            return res.status(500).json({ 
                error: error.message 
            });
        }
    }
    async resetPassword(req, res) {
        try {
            const { email, newPassword } = req.body;

            const user = await this.model.findOne({ where: { email } });

            if (!user) {
                return res.status(404).json({ 
                    error: "Usuário não encontrado" 
                });
            }

            user.password = newPassword;
            await user.save();

            return res.status(200).json({ 
                message: "Senha alterada com sucesso" 
            });
        } catch (error) {
            return res.status(500).json({ 
                error: error.message 
            });
        }
    }

    // Rota não encontrada
    async notFound(req, res) {
        res.status(404).json({
            success: false,
            message: '❌ Rota não encontrada.'
        });
    }
}

export default BaseController;