import { DataTypes } from "sequelize";
import database from '../server/database.js';


const Products = database.define('Products', {
  id: {
    type: DataTypes.UUID,
    primaryKey: true,
  },
  name_product: {
    type: DataTypes.STRING(50),
    validate: {
      isAlpha: true
    },
    allowNull: false
  },

  description: {
  type: DataTypes.STRING(100),
      validate: {
      isAlpha: true
    },
  allowNull: false
  },
  price: {
    type: DataTypes.DECIMAL(10.2),
    allowNull: false,
    validate: {
      isDecimal: true
    }
    },
    quantity: {
    type: DataTypes.INTEGER,
    allowNull: false,
    validate: {
      isNumeric: true,
    },
    },
    id_supplier: {
      type: DataTypes.UUID,
      allowNull: false,
      references: {
        model: 'Suppliers', // name of Target model
        key: 'id' // key in Target model that we're referencing
      }
    },
    id_employee: {
      type: DataTypes.UUID,
      allowNull: false,
      references: {
        model: 'Employees', // name of Target model
        key: 'id' // key in Target model that we're referencing
      }
    },
    createdAt: {
      type: DataTypes.DATE,
      defaultValue: DataTypes.NOW
    },
    updatedAt: {
      type: DataTypes.DATE,
      defaultValue: DataTypes.NOW
    }
}, {
  tableName: 'products',
  timestamps: true 
});

export default Products;