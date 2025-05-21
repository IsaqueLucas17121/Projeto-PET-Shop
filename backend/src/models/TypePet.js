import { Sequelize, DataTypes } from "sequelize";
import database from '../server/database.js';

const TypePet = database.define('TypePet', {
  id: {
    type: DataTypes.UUID,
    primaryKey: true,
    defaultValue: DataTypes.UUIDV4
  },
  tipo: {  // "Cachorro", "Gato", "Pássaro", etc.
    type: DataTypes.STRING(50),
    allowNull: false
  },
  raca: {  // Raça específica (opcional)
    type: DataTypes.STRING(50),
    allowNull: true
  }
}, {
  tableName: 'TypePets', 
  timestamps: true    
});

export default TypePet;