import express from 'express';
import cors from 'cors'; // Adicionando CORS
import helmet from 'helmet'; // Segurança básica
import config from '../../config.js'; // Configurações do projeto
import jwt from 'jsonwebtoken';

const JWT_SECRET = process.env.JWT_SECRET || 'seuSegredoSuperSeguroAqui';

const origin = config.web.origin
const methods = config.web.methods

function EssencialsMiddleware() {
    
    const app = express()

    app.use(helmet({
        contentSecurityPolicy: {
            useDefaults: true,
            directives: {
                "default-src": ["'self'"],
                "script-src": ["'self'", origin],
                "object-src": ["'none'"],
                "upgrade-insecure-requests": [],
            },
        },
        referrerPolicy: { policy: "no-referrer" },
        frameguard: { action: "deny" },
        hidePoweredBy: true,
        hsts: {
            maxAge: 31536000,
            includeSubDomains: true,
            preload: true
        },
        xssFilter: true,
        noSniff: true,
        dnsPrefetchControl: { allow: false }
    }));

    app.use(express.json());
    app.use(express.urlencoded({ extended: true }));

    app.use(cors({
        origin: origin,
        methods: methods,
        allowedHeaders: ['Content-Type', 'Authorization']
    }));
}

function ErrorGlobalMiddleware() {
    app.use((err, req, res, next) => {
        console.error(err.stack);
        res.status(500).json({ error: 'Erro interno no servidor' });
      });
}

export const authenticateToken = (req, res, next) => {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (!token) {
        return res.status(401).json({
            success: false,
            message: '❌ Token de autenticação não fornecido.'
        });
    }

    jwt.verify(token, JWT_SECRET, (err, user) => {
        if (err) {
            return res.status(403).json({
                success: false,
                message: '❌ Token inválido ou expirado.'
            });
        }
        
        req.user = user;
        next();
    });
};

export { EssencialsMiddleware, ErrorGlobalMiddleware }