<?php

use Core\Database;
use Core\App;

require_once __DIR__ . '/../../Core/Validator.php';

$email = $_POST['email'];
$password = $_POST['password'];

//Validate the form inputs

$errors = [];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if(!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if(! empty($errors)) {
    return view('registration/create.view.php',[
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

//Check if the account already exists
$user = $db->query('SELECT * FROM users WHERE email = :email',[
    'email' => $email
])->find();

if($user){
    header('location: /');
    exit();
}
else {
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)',[
        'email' => $email,
        'password' => $password
    ]);

    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();

}
