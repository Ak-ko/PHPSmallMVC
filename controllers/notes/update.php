<?php

use Core\App;
use Core\Validator;

$db = App::resolve("Core\Database");

// validate
$title = $_POST['title'];
$body = $_POST['body'];
$errors = [];
if (!Validator::string($title)) {
  $errors['title'] = 'The title field is required';
}

if (!Validator::string($body)) {
  $errors['body'] = 'The body field is required';
}

if (!Validator::string($body, 1, 1000)) {
  $errors['body'] = 'The body field can\'t exceeds 1,000 characters';
}

if (!empty($errors)) {
  $note = $db->query("select * from notes where id = :id", [
    'id' => $_POST['id']
  ])->findOrFail();
  view('notes/edit', [
    'heading' => "Edit Page",
    'note' => $note,
    'errors' => $errors
  ]);
}

$db->query("update notes set body = :body, title = :title where id = :id", [
  'id' => $_POST['id'],
  "body" => $_POST['body'],
  'title' => $_POST['title']
]);

header("location: /notes");
exit();
