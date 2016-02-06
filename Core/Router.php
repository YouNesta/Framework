<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 06/02/2016
 * Time: 20:07
 */

namespace Core;

class Router {

	private $route = [
		"User" => [
			"login", "close"
		]
	];

	public function start($url){

		$url = explode("/" ,$url);

		isset($url[0]) ? $controller = $url[0] : $controller = null;
		isset($url[1]) ? $action = $url[1] : $action = null;
		isset($url[2]) ? $param = $url[2] : $param = null;

			if($controller != null){
				if(array_key_exists($controller, $this->route))
				{
					require_once 'src/Controller/'.$controller.'.php';

					$response['controller'] = $controller;

					if($action != null && in_array($action, $this->route[$controller])){
							$response['action'] = $action;
							$response['param'] = $param;
							$controller = new $controller;
							$response['result'] = $controller->$action($param);
							return $response;

					}else{
						$response['action'] = 'index';
						$response['param'] = $action;
						$controller = new $controller;
						$response['result'] = $controller->index();
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
				return $response;

			}


	}
}