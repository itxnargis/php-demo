<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = "My Notes";

$notes = $db->query('SELECT * FROM note WHERE user_id = 2')->fetchAll();

require "views/notes.view.php";
