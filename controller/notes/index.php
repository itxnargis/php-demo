<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$notes = $db->query('SELECT * FROM note WHERE user_id = 2')->get();

view("notes/index.view.php", [
    'heading' => "My Notes",
    'notes' => $notes
]);
