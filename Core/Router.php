<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
  protected $routes = [];

  protected function add($uri, $controller, $method, $middleware = null)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
      'middleware' => $middleware
    ];

    return $this;
  }

  public function get($uri, $controller)
  {
    return $this->add($uri, $controller, 'GET');
  }

  public function post($uri, $controller)
  {
    return $this->add($uri, $controller, 'POST');
  }

  public function delete($uri, $controller)
  {
    return $this->add($uri, $controller, 'DELETE');
  }

  public function put($uri, $controller)
  {
    return $this->add($uri, $controller, 'PUT');
  }

  public function patch($uri, $controller)
  {
    return $this->add($uri, $controller, 'PATCH');
  }

  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        Middleware::resolve($route['middleware']);
        return require base_path($route['controller']);
      }
    }
    $this->abort();
  }

  protected function abort($status_code = Response::NOT_FOUND)
  {
    http_response_code($status_code);

    require base_path("views/{$status_code}.php");

    die();
  }

  public function only($auth)
  {
    $this->routes[array_key_last($this->routes)]['middleware'] = $auth;
    return $this;
  }
}
