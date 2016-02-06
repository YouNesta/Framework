<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 06/02/2016
 * Time: 18:30
 */
require_once 'vendor/autoload.php';
use Core\Router;

$routeur = new Router;


Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('src/View');
$twig = new Twig_Environment($loader);


$result =  $routeur->start($_GET['url']);
$header = $twig->loadTemplate('defaut/header.twig');
$footer = $twig->loadTemplate('defaut/footer.twig');

$template = $twig->loadTemplate($result['controller'].'/'.$result['action'].'.twig');


echo $header->render(array());
echo $template->render($result);
echo $footer->render(array());



