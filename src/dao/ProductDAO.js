// Implementação do padrão DAO (Data Access Object)
import { Database } from '../core/Database.js';
import { Product } from '../models/Product.js';

export class ProductDAO {
  constructor() {
    this.db = Database.getInstance().getConnection();
  }

  // Busca todos os produtos
  findAll() {
    return new Promise((resolve, reject) => {
      this.db.all('SELECT * FROM products', [], (err, rows) => {
        if (err) reject(err);
        resolve(rows);
      });
    });
  }

  // Busca um produto pelo ID
  findById(id) {
    return new Promise((resolve, reject) => {
      this.db.get('SELECT * FROM products WHERE id = ?', [id], (err, row) => {
        if (err) reject(err);
        resolve(row);
      });
    });
  }

  // Cria um novo produto
  create(product) {
    return new Promise((resolve, reject) => {
      const sql = 'INSERT INTO products (name, price, description) VALUES (?, ?, ?)';
      this.db.run(sql, [product.name, product.price, product.description], function(err) {
        if (err) reject(err);
        resolve({ id: this.lastID, ...product });
      });
    });
  }

  // Atualiza um produto existente
  update(id, product) {
    return new Promise((resolve, reject) => {
      const sql = 'UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?';
      this.db.run(sql, [product.name, product.price, product.description, id], (err) => {
        if (err) reject(err);
        resolve({ id, ...product });
      });
    });
  }

  // Remove um produto
  delete(id) {
    return new Promise((resolve, reject) => {
      this.db.run('DELETE FROM products WHERE id = ?', [id], (err) => {
        if (err) reject(err);
        resolve(true);
      });
    });
  }
}