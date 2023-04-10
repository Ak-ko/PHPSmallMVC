<?php

use Core\Validator;
use Core\App;
use Core\Database;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
  $errors['email'] = 'Provide a validate email.';
}

if (!Validator::string($password, 7, 255)) {
  $errors['password'] = 'Password must be at least 7 characters';
}

if (!empty($errors)) {
  view('users/register', [
    'errors' => $errors
  ]);
}

$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();

$validate = $user && password_verify($password, $user['password']);
if (!$validate) {
  $errors['email'] = 'Your account is not valid.';
  view('users/login', [
    'errors' => $errors
  ]);
} else {
  login($user);
  header('location: /');
  exit();
}
