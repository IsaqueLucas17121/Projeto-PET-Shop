import { Sequelize, DataTypes } from "sequelize";
import database from '../../database.js';

// Use the imported database connection instead of creating a new one
const User = database.define('User', {
  id_user: {
    type: DataTypes.UUID,
    primaryKey: true,
  },
  name: {
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
  password: {
    type: DataTypes.STRING(100),  // Changed from DATE to STRING
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
  tableName: 'users',  // Optional: explicit table name
  timestamps: true    // Enable automatic timestamps
});

export default User;