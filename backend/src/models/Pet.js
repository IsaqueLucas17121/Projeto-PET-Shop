import { Sequelize, DataTypes } from "sequelize";
import database from '../../database.js';

const Pet = database.define('Pet', {
  id: {
    type: DataTypes.UUID,
    primaryKey: true,
    defaultValue: DataTypes.UUIDV4 // Auto-genera UUID
  },
  nome_do_pet: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
  identidade: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
  tipo: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
  raca: {
    type: DataTypes.STRING(50),
    allowNull: false
  },
}, {
  tableName: 'Pets', 
  timestamps: true    
});

export default Pet;
