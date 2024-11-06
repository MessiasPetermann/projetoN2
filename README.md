# API RESTful com PHP e Padrões de Projeto

Esta API implementa um CRUD completo de produtos utilizando PHP e diversos padrões de projeto.

## Padrões de Projeto Utilizados

1. **Singleton**: Implementado na classe Database para garantir uma única conexão com o banco de dados.
2. **DAO (Data Access Object)**: Implementado em ProductDAO para separar a lógica de acesso aos dados.
3. **Service**: Implementado em ProductService para gerenciar a lógica de negócios.
4. **Controller**: Implementado em ProductController para gerenciar as requisições HTTP.
5. **Model**: Implementado na classe Product para representar a estrutura de dados.

## Estrutura do Projeto

```
src/
├── Controllers/    # Controladores da aplicação
├── Core/          # Componentes principais (Database, Router)
├── DAOs/          # Objetos de Acesso a Dados
├── Models/        # Modelos de dados
└── Services/      # Lógica de negócios
```

## Endpoints da API

- GET `/api/products` - Lista todos os produtos
- GET `/api/products/{id}` - Retorna um produto específico
- POST `/api/products` - Cria um novo produto
- PUT `/api/products/{id}` - Atualiza um produto
- DELETE `/api/products/{id}` - Remove um produto

## Como Executar

1. Instale as dependências:
   ```bash
   composer install
   ```

2. Inicie o servidor PHP:
   ```bash
   php -S localhost:8000
   ```

O servidor estará disponível em `http://localhost:8000`

## Exemplos de Requisições

### Criar Produto
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name":"Produto 1","price":29.99,"description":"Descrição do produto"}'
```

### Atualizar Produto
```bash
curl -X PUT http://localhost:8000/api/products/1 \
  -H "Content-Type: application/json" \
  -d '{"name":"Produto Atualizado","price":39.99,"description":"Nova descrição"}'
```