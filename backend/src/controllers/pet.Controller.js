import BaseController from "./Base.Controller.js";
import { Pet, TypePet } from "../models/index.js"; // Assumindo que seus models estão exportados em index.js

class PetController extends BaseController {
    constructor() {
        super();
        this.model = Pet;
        this.modelName = 'Pet';
    }
    
    async create(req, res) {
        try {
            const { nome_do_pet, type_pet_id, id_user } = req.body;
            
            // Validações básicas
            if (!nome_do_pet || !type_pet_id || !id_user) {
                return res.status(400).json({ 
                    error: "Nome do pet, type_pet_id e id_user são obrigatórios" 
                });
            }

            // Verifica se o TypePet existe
            const typePetExists = await TypePet.findByPk(type_pet_id);
            if (!typePetExists) {
                return res.status(404).json({ 
                    error: "Tipo de pet não encontrado" 
                });
            }

            const pet = await this.model.create({ 
                nome_do_pet, 
                type_pet_id, 
                id_user 
            });

            return res.status(201).json(pet);
        } catch (error) {
            return res.status(500).json({ 
                error: error.message 
            });
        }
    }

    async getAll(req, res) {
        try {
            const pets = await this.model.findAll({
                include: [{
                    model: TypePet,
                    as: 'TypePet'
                }]
            });
            return res.status(200).json(pets);
        } catch (error) {
            return res.status(500).json({ 
                error: error.message 
            });
        }
    }
}

export default new PetController();