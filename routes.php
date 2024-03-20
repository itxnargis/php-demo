<?php

$router->get('/', 'controller/index.php');
$router->get('/about', 'controller/about.php');
$router->get('/contact', 'controller/contact.php');

$router->get('/notes', 'controller/notes/index.php')->only('auth');
$router->get('/note', 'controller/notes/show.php');
$router->delete('/note', 'controller/notes/destroy.php');

$router->get('/note/edit', 'controller/notes/edit.php');
$router->patch('/note', 'controller/notes/update.php');

$router->get('/notes/create', 'controller/notes/create.php');
$router->post('/notes', 'controller/notes/store.php');

$router->get('/register', 'controller/registration/create.php')->only('guest');
$router->post('/register', 'controller/registration/store.php');