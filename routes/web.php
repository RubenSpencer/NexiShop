<?php

$route = $_GET['route'] ?? 'home';

switch($route) {

    case 'products':
        require 'views/products/list.php';
        break;

    default:
        require 'views/home/index.php';
}
