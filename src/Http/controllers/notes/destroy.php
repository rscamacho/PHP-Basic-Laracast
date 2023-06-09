<?php

use Core\App;
use Core\Database;
use Core\Session;

$currentUserId = Session::get('user')['id'];

$db = App::resolve(Database::class);

$note = $db->query('SELECT id, body, user_id FROM notes WHERE id = :id', [
  'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('DELETE FROM notes WHERE id = :id', [
  'id' => $_POST['id']
]);

redirect('/notes');
