<?php

use Core\Database;
use Core\App;

require_once __DIR__ . '/../../Core/Validator.php';
$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

if (!empty($errors)) {
    return view('session/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {

    if (password_verify($password, $user['password'])) {

        login([
            'email' => $email
        ]);

        header('location: /');
        exit();
    }
}


return view('session/create.view.php', [
    'errors' => [
        'email' => 'No matchiing found for that email address and password.'
    ]
]);
