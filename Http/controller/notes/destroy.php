<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;
    $note = $db->query("SELECT * FROM note WHERE id = :id", [
        'id' => $_POST['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query('DELETE FROM note WHERE id = :id', [
        'id' => $_POST['id']
    ]);

    header('location:/notes');
    exit();
