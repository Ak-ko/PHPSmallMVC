<?php

use Core\Validator;
use Core\App;
use Core\Database;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
  $errors['email'] = 'Provide a validate or new email.';
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

if ($user) {
  $errors['email'] = 'You have already registered.';
  view('users/register', [
    'errors' => $errors
  ]);
}

if (!$user) {
  $db->query('INSERT INTO users (email, password) VALUES ( :email, :password )', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
  ]);

  login($user);
}

header('location: /');
exit();
