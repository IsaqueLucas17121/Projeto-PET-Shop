import sequelize from './database.js';
import express from 'express';
import userRoutes from '../routes/user.routes.js';
import petRoutes from '../routes/pet.routes.js';
import productRoutes from '../routes/product.routes.js';
import config from './config.js';
import { ErrorGlobalMiddleware, EssencialsMiddleware } from '../middleware/EssencialsMiddleware.js';

const port = config.web.port;

const app = express();

// Middlewares ESSENCIAIS 
app.use(EssencialsMiddleware);
app.use(ErrorGlobalMiddleware);

// Rotas
app.use('/api/v1/user', userRoutes); // Versionamento da API
app.use('/api/v1/pet', petRoutes); // Versionamento da API
app.use('/api/v1/product', productRoutes); // Versionamento da API


const startServer = async () => {
    try {
        // Testar conexão com o banco
        await sequelize.authenticate();
        console.log('✅ Banco de dados conectado com sucesso.');

        // Sincronizar modelos
        await sequelize.sync({ alter: true });
        console.log('✅ Modelos sincronizados com o banco.');

        // Iniciar servidor
        app.listen(port, () => {
            console.log(`🚀 Servidor rodando em http://localhost:${port}`);
            console.log(`📚 Documentação da API disponível em http://localhost:${port}/api-docs`);
        });

    } catch (error) {
        console.error('❌ Falha ao iniciar o servidor:', error);
        process.exit(1); // Encerra o processo com erro
    }
}

// Inicialização controlada
startServer();