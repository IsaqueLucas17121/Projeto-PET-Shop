export default {
    db: {
      host: 'localhost',
      user: 'root',
      password: '', // sua senha do MySQL
      database: 'ps',
      dialect: 'mysql',
    },
    web: {
      origin: 'http://localhost:5173',
      methods: ['GET', 'POST', 'PUT', 'DELETE'],
      port: '3333',
    },
  };