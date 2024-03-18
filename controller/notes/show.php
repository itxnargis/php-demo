<?php

use Core\Database;

$currentUserId = 1;

$config = require base_path('config.php');
$db = new Database($config['database']);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $note = $db->query("SELECT * FROM note WHERE id = :id", [
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query('delete from note where id = :id', [
        'id' => $_GET['id']
    ]);
}
else {

    $note = $db->query("SELECT * FROM note WHERE id = :id", [
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    view("notes/show.view.php", [
        'heading' => "Note",
        'note' => $note
    ]);
}
