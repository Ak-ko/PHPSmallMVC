<?php

use Core\Validator;
use Core\App;

$db = App::resolve("Core\Database");

$title = $_POST['title'];
$body = $_POST['body'];
$errors = [];
$currentId = 1;

if (!Validator::string($title)) {
  $errors['title'] = 'The title field is required';
}

if (!Validator::string($body)) {
  $errors['body'] = 'The body field is required';
}

if (!Validator::string($body, 1, 1000)) {
  $errors['body'] = 'The body field can\'t exceeds 1,000 characters';
}

// put into the db when no elements in errors
$hasError = !empty($errors);
if ($hasError) {
  view('notes/create', [
    'heading' => 'Create Note',
    'errors' => $errors
  ]);
}

$db->query('INSERT INTO notes(title, body, user_id) VALUES ( :title, :body, :currentId );', [
  'title' => $title,
  'body' => $body,
  'currentId' => $currentId
]);

header("location: /notes");
exit();
