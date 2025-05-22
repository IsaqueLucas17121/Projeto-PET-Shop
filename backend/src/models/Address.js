import { Sequelize, DataTypes } from "sequelize";
import database from '../../database.js';

const Address = database.define('Address', {
    zip_code: {
        type: DataTypes.STRING(10),
        allowNull: false,
        validate: {
            isNumeric: true
        }
    },
    street: {
        type: DataTypes.STRING(100),
        allowNull: false,
        validate: {
            isAlpha: true
        }
    },
    number: {
        type: DataTypes.STRING(10),
        allowNull: false,
        validate: {
            isNumeric: true
        }
    },
    neighborhood: {
        type: DataTypes.STRING(50),
        allowNull: false,
        validate: {
            isAlpha: true
        }
    },
    city: {
        type: DataTypes.STRING(50),
        allowNull: false,
        validate: {
            isAlpha: true
        }
    },
    state: {
        type: DataTypes.STRING(2),
        allowNull: false,
        validate: {
            isAlpha: true
        }
    },
}, {
  tableName: 'Address',  // Optional: explicit table name
  timestamps: true    // Enable automatic timestamps
});

export default Address;