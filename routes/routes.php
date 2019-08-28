<?php

$router->get('/', function () {
    echo 'Página Inicial';
});

$router->get('/contato', function () {
    echo 'Página de Contato';
});

$router->get('/contato/store', "Contact@store");