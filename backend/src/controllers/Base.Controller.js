import { v4 as uuidv4 } from 'uuid';
import bcrypt from 'bcrypt';
import jwt from 'jsonwebtoken';


class BaseController {
    constructor(model) {
        this.model = model;
    }

    // Helper method for error responses
    errorResponse(res, status, message, error = null) {
        return res.status(status).json({
            success: false,
            message: `❌ ${message}`,
            error: error?.message || null
        });
    }

    // Helper method for success responses
    successResponse(res, status, message, data = null) {
        return res.status(status).json({
            success: true,
            message: `✅ ${message}`,
            ...(data && { data })
        });
    }

    // Create user
    async create(req, res) {
        try {
            const { password, confirmPassword, ...otherData } = req.body;

            if (password !== confirmPassword) {
                return this.errorResponse(res, 400, 'Password and confirmation do not match');
            }

            const existingUser = await this.model.findOne({ 
                where: { email: otherData.email } 
            });

            if (existingUser) {
                return this.errorResponse(res, 409, 'User already exists');
            }

            const hashPassword = await bcrypt.hash(password, 10);
            const newItem = await this.model.create({
                ...otherData,
                id: uuidv4(),
                password: hashPassword
            });

            // Remove password from response
            const { password: _, ...userWithoutPassword } = newItem.dataValues;

            this.successResponse(res, 201, 'User created successfully', userWithoutPassword);
        } catch (error) {
            console.error('Error creating user:', error);
            this.errorResponse(res, 500, 'Error creating user', error);
        }
    }

    // List all users (protected)
    async read(req, res) {
        try {
            const items = await this.model.findAll({
                attributes: { exclude: ['password'] }
            });
            
            this.successResponse(res, 200, 'Records found successfully', items);
        } catch (error) {
            console.error('Error listing records:', error);
            this.errorResponse(res, 500, 'Error listing records', error);
        }
    }

    // Get user by ID (protected)
    async readById(req, res) {
        try {
            const { id } = req.params;
            const item = await this.model.findOne({ 
                where: { id },
                attributes: { exclude: ['password'] }
            });

            if (!item) {
                return this.errorResponse(res, 404, 'Record not found');
            }

            this.successResponse(res, 200, 'Record found successfully', item);
        } catch (error) {
            console.error('Error fetching record:', error);
            this.errorResponse(res, 500, 'Error fetching record', error);
        }
    }

    // Get current user (protected)
    async getCurrentUser(req, res) {
        try {
            const user = req.user;
            
            if (!user) {
                return this.errorResponse(res, 404, 'User not found');
            }

            const currentUser = await this.model.findOne({
                where: { id: user.id },
                attributes: { exclude: ['password'] }
            });

            this.successResponse(res, 200, 'Current user found', currentUser);
        } catch (error) {
            console.error('Error fetching current user:', error);
            this.errorResponse(res, 500, 'Error fetching current user', error);
        }
    }

    // Update user (protected)
    async update(req, res) {
        try {
            const { id } = req.params;
            let { password, confirmPassword, ...otherData } = req.body;

            const item = await this.model.findOne({ where: { id } });

            if (!item) {
                return this.errorResponse(res, 404, 'Record not found');
            }

            // Check permission
            if (req.user.id !== item.id && !req.user.isAdmin) {
                return this.errorResponse(res, 403, 'Unauthorized to update this user');
            }

            // Handle password update
            if (password) {
                if (password !== confirmPassword) {
                    return this.errorResponse(res, 400, 'Password and confirmation do not match');
                }
                const hashPassword = await bcrypt.hash(password, 10);
                otherData.password = hashPassword;
            }

            await item.update(otherData);

            // Remove password from response
            const { password: _, ...updatedItem } = item.dataValues;

            this.successResponse(res, 200, 'Record updated successfully', updatedItem);
        } catch (error) {
            console.error('Error updating record:', error);
            this.errorResponse(res, 500, 'Error updating record', error);
        }
    }

    // Delete user (protected)
    async delete(req, res) {
        try {
            const { id } = req.params;
            const item = await this.model.findOne({ where: { id } });

            if (!item) {
                return this.errorResponse(res, 404, 'Record not found');
            }

            // Check permission
            if (req.user.id !== item.id && !req.user.isAdmin) {
                return this.errorResponse(res, 403, 'Unauthorized to delete this user');
            }

            await item.destroy();

            this.successResponse(res, 200, 'Record deleted successfully');
        } catch (error) {
            console.error('Error deleting record:', error);
            this.errorResponse(res, 500, 'Error deleting record', error);
        }
    }

    // Login
    async login(req, res) {
        try {
            const { email, password } = req.body;

            const user = await this.model.findOne({ where: { email } });
            if (!user) {
                return this.errorResponse(res, 404, 'User not found');
            }

            const isMatch = await bcrypt.compare(password, user.password);
            if (!isMatch) {
                return this.errorResponse(res, 401, 'Invalid credentials');
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

            this.successResponse(res, 200, 'Login successful', {
                user: userWithoutPassword,
                token
            });
        } catch (error) {
            console.error('Login error:', error);
            this.errorResponse(res, 500, 'Login failed', error);
        }
    }

    // Forgot password
    async forgotPassword(req, res) {
        try {
            const { email } = req.body;
            const user = await this.model.findOne({ where: { email } });

            if (!user) {
                return this.errorResponse(res, 404, 'User not found');
            }

            // Create reset token (expires in 1 hour)
            const resetToken = jwt.sign(
                { email: user.email, id: user.id },
                JWT_SECRET,
                { expiresIn: '1h' }
            );

            // In a real app, you would send an email with this token
            this.successResponse(res, 200, 'Password reset email sent', { resetToken });
        } catch (error) {
            console.error('Forgot password error:', error);
            this.errorResponse(res, 500, 'Error processing password reset', error);
        }
    }

    // Reset password
    async resetPassword(req, res) {
        try {
            const { token, newPassword, confirmPassword } = req.body;

            if (newPassword !== confirmPassword) {
                return this.errorResponse(res, 400, 'Passwords do not match');
            }

            const decoded = jwt.verify(token, JWT_SECRET);
            const user = await this.model.findOne({ where: { email: decoded.email } });

            if (!user) {
                return this.errorResponse(res, 404, 'User not found');
            }

            const hashPassword = await bcrypt.hash(newPassword, 10);
            await user.update({ password: hashPassword });

            this.successResponse(res, 200, 'Password updated successfully');
        } catch (error) {
            console.error('Password reset error:', error);
            if (error.name === 'TokenExpiredError') {
                return this.errorResponse(res, 401, 'Token expired');
            }
            this.errorResponse(res, 500, 'Password reset failed', error);
        }
    }

    // Not found handler
    async notFound(req, res) {
        this.errorResponse(res, 404, 'Route not found');
    }
}

export default BaseController;