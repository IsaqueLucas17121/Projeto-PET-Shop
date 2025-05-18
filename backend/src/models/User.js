import { Sequelize, DataTypes } from "sequelize";
import database from '../../database.js';

const User = database.define('User', {
  id: {
    type: DataTypes.UUID,
    primaryKey: true,
  },
  nome: {
    type: DataTypes.STRING(50),
    allowNull: false
  },

  Sobrenome: {
  type: DataTypes.STRING(50),
  allowNull: false
  },
  email: {
    type: DataTypes.STRING(100),
    allowNull: false,
    unique: true,
    validate: {
      isEmail: true
    }
  },
  celular: {
    type: DataTypes.STRING(15),
    allowNull: false,
    unique: true,
    validate: {
      isNumeric: true
    }
  },
  cpf: {
    type: DataTypes.STRING(11),
    allowNull: false,
    unique: true,
  },
  password: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  createdAt: {
    type: DataTypes.DATE,
    defaultValue: Sequelize.NOW
  },
  updatedAt: {
    type: DataTypes.DATE,
    defaultValue: Sequelize.NOW
  }
}, {
  tableName: 'Users', 
  timestamps: true    
});

export default User;