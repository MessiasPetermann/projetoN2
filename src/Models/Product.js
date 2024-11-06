// Modelo de dados do produto usando padrão Model
export class Product {
  constructor(id = null, name, price, description) {
    this.id = id;
    this.name = name;
    this.price = price;
    this.description = description;
  }

  // Validação dos dados do produto
  validate() {
    if (!this.name || typeof this.name !== 'string') {
      throw new Error('Nome inválido');
    }
    if (!this.price || typeof this.price !== 'number' || this.price <= 0) {
      throw new Error('Preço inválido');
    }
    if (!this.description || typeof this.description !== 'string') {
      throw new Error('Descrição inválida');
    }
    return true;
  }
}