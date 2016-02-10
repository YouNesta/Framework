<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 06/02/2016
 * Time: 20:07
 */

namespace Core;
require_once 'vendor/autoload.php';

class Router {

	private $route = [
		"User" => [
			"login", "close"
		],
		"Jules" => [
			"ouvrirSesFesses", "close"
		]
	];

	public function start($url){


		\Twig_Autoloader::register();
		$loader = new \Twig_Loader_Filesystem('src/View');
		$twig = new \Twig_Environment($loader);

		$url = explode("/" ,$url);

		isset($url[0]) ? $controller = $url[0] : $controller = null;
		isset($url[1]) ? $action = $url[1] : $action = null;
		isset($url[2]) ? $param = $url[2] : $param = null;

			if($controller != null){
				if(array_key_exists($controller, $this->route))
				{

					if($action != null && in_array($action, $this->route[$controller])){
						$response['controller'] = $controller;
						$response['action'] = $action;
							$response['param'] = $param;
							$namespace = "\\App\\Controller\\".$controller;
							$controller = new  $namespace;
							$response['result'] = $controller->$action($param);


						$response["template"] = $twig->loadTemplate($response['controller'].'/'.$response['action'].'.twig');


						return $response;

					}else{
						$response['controller'] = $controller;
						$response['action'] = 'index';
						$response['param'] = $action;
						$namespace = "\\App\\Controller\\".$controller;
						$controller = new  $namespace;
						$response['result'] = $controller->index();


						$response["template"] = $twig->loadTemplate($response['controller'].'/index.twig');

						return $response;
					}
				}else
				{
					throw new \Exception('No Controller '.$controller.' found');
				}
			}else{
				require_once 'src/Controller/Home.php';
				$controller = "Home";
				$response['controller'] = $controller;
				$response['action'] = 'index';
				$controller = new $controller;
				$response['result'] = $controller->index();

				$response["template"] = $twig->loadTemplate('Home/index.twig');
				return $response;

			}


	}
}