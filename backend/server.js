import sequelize from './database.js';
import express from 'express';
import userRoutes from './src/routes/user.routes.js';
import petRoutes from './src/routes/pet.routes.js';
import config from './config.js';
import { ErrorGlobalMiddleware, EssencialsMiddleware } from './src/middleware/EssencialsMiddleware.js';

const port = config.web.port;

const app = express();

// Middlewares ESSENCIAIS 
app.use(EssencialsMiddleware);
app.use(ErrorGlobalMiddleware);

// Rotas
app.use('/user', userRoutes); // Versionamento da API
app.use('/pet', petRoutes); // Versionamento da API


const startServer = async (retries = 5) => {
    try {
        await sequelize.authenticate();
        console.log('✅ Banco de dados conectado com sucesso.');
        await sequelize.sync({ alter: true });
        console.log('✅ Modelos sincronizados com o banco.');
        app.listen(port, () => {
            console.log(`🚀 Servidor rodando em http://localhost:${port}`);
        });
    } catch (error) {
        console.error('❌ Falha ao iniciar o servidor:', error);
        if (retries > 0) {
            console.log(`🔄 Tentando novamente em 5 segundos... (${retries} tentativas restantes)`);
            setTimeout(() => startServer(retries - 1), 5000);
        } else {
            console.log('❌ Não foi possível conectar após várias tentativas. Encerrando.');
            process.exit(1);
        }
    }
};

// Inicialização controlada
startServer();