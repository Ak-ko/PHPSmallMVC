<?php

use Core\Response;

function dd($value)
{
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
  die();
}

function isCurrentUrl($value)
{
  return $_SERVER['REQUEST_URI'] === $value ? 'bg-gray-900 text-white' : 'text-gray-300';
}

function authorize($condition)
{
  if (!$condition) {
    return abort(Response::FORBIDDEN);
  }
}

function base_path($path)
{
  return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
  extract($attributes);
  require base_path("views/$path.view.php");
}

function abort($status_code = Response::NOT_FOUND)
{
  http_response_code($status_code);

  require base_path("views/{$status_code}.php");

  die();
}

function login($attributes)
{
  $_SESSION['user'] = [
    'email' => $attributes['email']
  ];
  session_regenerate_id(true);
}

function logout()
{
  $_SESSION = [];
  session_destroy();

  $params = session_get_cookie_params();
  setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
