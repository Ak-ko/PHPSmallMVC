<?php

use Core\App;

$db = App::resolve("Core\Database");

$currentId = 1;

$note = $db->query("select * from notes where id = :id", [
  'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentId);

view('notes/edit', [
  'heading' => "Edit Page",
  'note' => $note,
  'errors' => []
]);
