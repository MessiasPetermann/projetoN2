// Configuração das rotas da API
import express from 'express';
import { ProductController } from '../controllers/ProductController.js';

const router = express.Router();
const productController = new ProductController();

// Define as rotas para cada operação CRUD
router.get('/', (req, res) => productController.index(req, res));
router.get('/:id', (req, res) => productController.show(req, res));
router.post('/', (req, res) => productController.store(req, res));
router.put('/:id', (req, res) => productController.update(req, res));
router.delete('/:id', (req, res) => productController.delete(req, res));

export { router as productRoutes };