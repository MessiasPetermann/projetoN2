// Implementação do padrão Service para lógica de negócios
import { ProductDAO } from '../dao/ProductDAO.js';
import { Product } from '../models/Product.js';

export class ProductService {
  constructor() {
    this.productDAO = new ProductDAO();
  }

  // Lista todos os produtos
  async getAllProducts() {
    try {
      return await this.productDAO.findAll();
    } catch (error) {
      throw new Error('Erro ao buscar produtos: ' + error.message);
    }
  }

  // Busca um produto específico
  async getProduct(id) {
    try {
      const product = await this.productDAO.findById(id);
      if (!product) {
        throw new Error('Produto não encontrado');
      }
      return product;
    } catch (error) {
      throw new Error('Erro ao buscar produto: ' + error.message);
    }
  }

  // Cria um novo produto
  async createProduct(data) {
    try {
      const product = new Product(null, data.name, data.price, data.description);
      product.validate();
      return await this.productDAO.create(product);
    } catch (error) {
      throw new Error('Erro ao criar produto: ' + error.message);
    }
  }

  // Atualiza um produto existente
  async updateProduct(id, data) {
    try {
      const product = new Product(id, data.name, data.price, data.description);
      product.validate();
      return await this.productDAO.update(id, product);
    } catch (error) {
      throw new Error('Erro ao atualizar produto: ' + error.message);
    }
  }

  // Remove um produto
  async deleteProduct(id) {
    try {
      const result = await this.productDAO.delete(id);
      if (!result) {
        throw new Error('Produto não encontrado');
      }
      return { message: 'Produto removido com sucesso' };
    } catch (error) {
      throw new Error('Erro ao remover produto: ' + error.message);
    }
  }
}