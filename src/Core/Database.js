// Implementação do padrão Singleton para conexão com banco de dados
import sqlite3 from 'sqlite3';

export class Database {
  static instance = null;
  connection = null;

  constructor() {
    if (Database.instance) {
      throw new Error('Use Database.getInstance()');
    }
    Database.instance = this;
  }

  static getInstance() {
    if (!Database.instance) {
      Database.instance = new Database();
    }
    return Database.instance;
  }

  initialize() {
    this.connection = new sqlite3.Database(':memory:', (err) => {
      if (err) {
        console.error('Erro ao conectar ao banco:', err);
      } else {
        console.log('Conectado ao banco SQLite');
        this.createTables();
      }
    });
  }

  createTables() {
    const sql = `
      CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        price REAL NOT NULL,
        description TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
      )
    `;
    
    this.connection.run(sql);
  }

  getConnection() {
    return this.connection;
  }
}