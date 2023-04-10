<?php

use Core\App;

$db = App::resolve("Core\Database");

$currentId = 1;

$note = $db->query("select * from notes where id = :id", [
  'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentId);

$db->query("DELETE FROM notes WHERE id = :id", [
  'id' => $_POST['id']
]);

header("location: /notes");
exit();
