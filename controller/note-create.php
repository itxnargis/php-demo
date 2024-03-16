<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Create note';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = [];

    if(strlen($_POST['body']) === 0){
        $errors['body'] = 'A body is required';
    }

    if(empty($errors)) {
        $db->query('INSERT INTO note(body, user_id) VALUES(:body, :user_id)',[
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
    }
}

require "views/note-create.view.php";