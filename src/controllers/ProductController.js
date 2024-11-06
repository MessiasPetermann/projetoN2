// Implementação do padrão Controller para gerenciar requisições
import { ProductService } from '../services/ProductService.js';

export class ProductController {
  constructor() {
    this.productService = new ProductService();
  }

  // Lista todos os produtos
  async index(req, res) {
    try {
      const products = await this.productService.getAllProducts();
      res.json(products);
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  }

  // Busca um produto específico
  async show(req, res) {
    try {
      const product = await this.productService.getProduct(req.params.id);
      res.json(product);
    } catch (error) {
      res.status(404).json({ error: error.message });
    }
  }

  // Cria um novo produto
  async store(req, res) {
    try {
      const product = await this.productService.createProduct(req.body);
      res.status(201).json(product);
    } catch (error) {
      res.status(400).json({ error: error.message });
    }
  }

  // Atualiza um produto existente
  async update(req, res) {
    try {
      const product = await this.productService.updateProduct(req.params.id, req.body);
      res.json(product);
    } catch (error) {
      res.status(400).json({ error: error.message });
    }
  }

  // Remove um produto
  async delete(req, res) {
    try {
      const result = await this.productService.deleteProduct(req.params.id);
      res.json(result);
    } catch (error) {
      res.status(404).json({ error: error.message });
    }
  }
}