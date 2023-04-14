<?php

use Core\App;
use Core\Database;

$currentUserId = 1;

$db = App::resolve(Database::class);

$note = $db->query('SELECT id, body, user_id FROM notes WHERE id = :id', [
  'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/show.view.php', [
  'heading' => 'Note',
  'note' => $note
]);
