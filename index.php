<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 06/02/2016
 * Time: 18:30
 */
require_once 'vendor/autoload.php';
use src\Controller\Router;

$routeur = new Router;

echo $routeur->start($_GET['url']);


?>


