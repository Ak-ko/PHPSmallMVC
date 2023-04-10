<?php

use Core\App;

$db = App::resolve("Core\Database");

$currentId = 1;
$notes = $db->query("select * from notes where user_id = :currentId order by id desc", [
  'currentId' => $currentId,
])->get();

view('notes/index', [
  'heading' => 'My Notes',
  'notes' => $notes
]);
