import { Sequelize, DataTypes } from "sequelize";
import database from '../server/database.js';

const Supplier = database.define('Supplier', {
  id: {
    type: DataTypes.UUID,
    primaryKey: true,
  },
  supplier: {
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
  site: {
    type: DataTypes.STRING(100),
    allowNull: false,
    unique: true,
    validate: {
      isUrl: true
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
  cnpj: {
    type: DataTypes.STRING(14),
    allowNull: false,
    unique: true,
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
  tableName: 'Suppliers',  // Optional: explicit table name
  timestamps: true    // Enable automatic timestamps
});

export default Supplier;