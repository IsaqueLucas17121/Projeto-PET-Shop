import { Sequelize, DataTypes } from "sequelize";
import database from '../server/database.js';

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
  type_pet_id: {  // Referência ao TypePet
    type: DataTypes.UUID,
    allowNull: false,
    references: {
      model: 'TypePets', 
      key: 'id' 
    }
  },
}, {
  tableName: 'Pets', 
  timestamps: true    
});

export default Pet;