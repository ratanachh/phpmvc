<?php

/**
 * @var Router $router
 */

 $router->get('/', 'home@index');

 $router->get('/get/test', 'home@index');
 $router->get('/get/test2/t', 'home@index12');
 $router->get('/get/{test3}/t', 'home@index22');
 $router->get('/{get}/test4/{ss}', 'home@index34');
