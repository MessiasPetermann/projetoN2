// Arquivo principal que inicializa o servidor Express
import express from 'express';
import { productRoutes } from './routes/productRoutes.js';
import { Database } from './core/Database.js';
import swaggerUi from 'swagger-ui-express';
import YAML from 'yamljs';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

const __dirname = dirname(fileURLToPath(import.meta.url));
const swaggerDocument = YAML.load(join(__dirname, '../swagger.yaml'));

const app = express();
app.use(express.json());

// Inicializa o banco de dados
Database.getInstance().initialize();

// Documentação Swagger
app.use('/api-docs', swaggerUi.serve, swaggerUi.setup(swaggerDocument));

// Rotas da API
app.use('/api/products', productRoutes);

// Tratamento de erros global
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).json({ error: 'Erro interno do servidor' });
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Servidor rodando na porta ${PORT}`);
});