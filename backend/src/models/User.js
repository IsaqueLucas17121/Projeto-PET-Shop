import { DataTypes } from "sequelize";
import database from "../../database.js";

const User = database.define('User', {
  id: {
    type: DataTypes.UUID,
    primaryKey: true,
    defaultValue: DataTypes.UUIDV4
  },
  nome: {
    type: DataTypes.STRING(50),
    allowNull: false,
    validate: {
      notEmpty: {
        msg: "O nome é obrigatório"
      }
    }
  },
  sobrenome: {
    type: DataTypes.STRING(50),
    allowNull: false,
    validate: {
      notEmpty: {
        msg: "O sobrenome é obrigatório"
      }
    }
  },
  email: {
    type: DataTypes.STRING(100),
    allowNull: false,
    unique: {
      msg: "Este email já está cadastrado"
    },
    validate: {
      isEmail: {
        msg: "Por favor, insira um email válido"
      },
      notEmpty: {
        msg: "O email é obrigatório"
      }
    }
  },
  tipo_user: {
    type: DataTypes.ENUM('comum', 'vendedor', 'admin'),
    allowNull: false,
    defaultValue: 'comum'
  },
  celular: {
    type: DataTypes.STRING(15),
    allowNull: false,
    unique: {
      msg: "Este celular já está cadastrado"
    },
    validate: {
      notEmpty: {
        msg: "O celular é obrigatório"
      }
    }
  },
  cpf: {
    type: DataTypes.STRING(14),
    allowNull: false,
    unique: {
      msg: "Este CPF já está cadastrado"
    },
    validate: {
      notEmpty: {
        msg: "O CPF é obrigatório"
      }
    }
  },
  cep: {
    type: DataTypes.STRING(9),
    validate: {
      notEmpty: {
        msg: "O CEP é obrigatório"
      }
    }
  },
  rua: {
    type: DataTypes.STRING(100)
  },
  bairro: {
    type: DataTypes.STRING(50)
  },
  cidade: {
    type: DataTypes.STRING(50)
  },
  estado: {
    type: DataTypes.STRING(2)
  },
  numero: {
    type: DataTypes.STRING(10)
  },
  complemento: {
    type: DataTypes.STRING(100)
  },
  password: {
    type: DataTypes.STRING(100),
    allowNull: false,
    validate: {
      notEmpty: {
        msg: "A senha é obrigatória"
      },
      len: {
        args: [6, 100],
        msg: "A senha deve ter entre 6 e 100 caracteres"
      }
    }
  }
}, {
  tableName: 'users',
  timestamps: true,
  paranoid: true
});

export default User;