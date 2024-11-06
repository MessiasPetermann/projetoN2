<?php
namespace App\Core;

class Router {
    private array $routes = [];
    
    public function addRoute(string $method, string $path, array $handler): void {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }
    
    public function handleRequest(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($this->matchRoute($route['path'], $uri) && $route['method'] === $method) {
                $params = $this->extractParams($route['path'], $uri);
                $controller = new $route['handler'][0]();
                $action = $route['handler'][1];
                
                echo json_encode($controller->$action(...$params));
                return;
            }
        }
        
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada']);
    }
    
    private function matchRoute(string $routePath, string $uri): bool {
        $pattern = preg_replace('/\{[^}]+\}/', '[^/]+', $routePath);
        return preg_match("#^$pattern$#", $uri);
    }
    
    private function extractParams(string $routePath, string $uri): array {
        $params = [];
        $routeParts = explode('/', $routePath);
        $uriParts = explode('/', $uri);
        
        foreach ($routeParts as $index => $part) {
            if (preg_match('/\{([^}]+)\}/', $part, $matches)) {
                $params[] = $uriParts[$index];
            }
        }
        
        return $params;
    }
}