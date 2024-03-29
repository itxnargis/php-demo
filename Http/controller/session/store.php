<?php

use Http\Forms\LoginForm;
use Core\Authenticator;
use Core\Session;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if ($form->validate($email, $password)) {

    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'No matching found for that email address and password.');
};

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $_POST['email']
]);

return redirect('/login');
