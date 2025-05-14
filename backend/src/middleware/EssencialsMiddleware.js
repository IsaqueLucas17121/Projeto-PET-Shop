import express from 'express';
import cors from 'cors'; // Adicionando CORS
import helmet from 'helmet'; // Segurança básica
import config from '../../server/config.js';

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

export { EssencialsMiddleware, ErrorGlobalMiddleware }