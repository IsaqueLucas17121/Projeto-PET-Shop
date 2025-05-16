import { Sequelize } from 'sequelize';
import config from './config.js';

// Primeiro conectamos sem especificar o banco de dados
const setupSequelize = new Sequelize('', 
  config.db.user, 
  config.db.password, 
  {
    host: config.db.host,
    dialect: 'mysql',
    logging: console.log // Habilitamos logging para ver o processo
  }
);

async function initializeDatabase() {
  try {
    // Verificamos se o banco de dados existe
    const [results] = await setupSequelize.query(
      `SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '${config.db.database}'`
    );

    // Se não existir, criamos
    if (results.length === 0) {
      await setupSequelize.query(`CREATE DATABASE ${config.db.database};`);
      console.log(`Banco de dados ${config.db.database} criado com sucesso!`);
    } else {
      console.log(`Banco de dados ${config.db.database} já existe.`);
    }

    // Agora conectamos ao banco de dados específico
    const sequelize = new Sequelize(
      config.db.database,
      config.db.user,
      config.db.password,
      {
        host: config.db.host,
        dialect: 'mysql',
        logging: false,
        define: {
          timestamps: true,
          underscored: true
        }
      }
    );

    return sequelize;
  } catch (error) {
    console.error('Erro ao inicializar o banco de dados:', error);
    process.exit(1); // Encerra a aplicação em caso de erro
  } finally {
    await setupSequelize.close(); // Fecha a conexão temporária
  }
}

// Exportamos uma Promise que resolve para a instância do Sequelize
export default initializeDatabase();