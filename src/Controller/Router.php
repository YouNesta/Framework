<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 06/02/2016
 * Time: 20:07
 */

namespace src\Controller;

class Router {

	private $route = [
		"lol" => [
			"test", "close"
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

					if($action != null){
						if(in_array($action, $this->route[$controller])){
							$controller = new $controller;
							$response = $controller->$action($param);

							return $response;
						}
					}else{
						$controller = new $controller;
						$response = $controller->index();
						return $response;
					}
				}else
				{
					throw new \Exception('No Controller '.$controller.' found');
				}
			}else{
				require_once 'src/Controller/Home.php';
				$controller = new Home;
				$response = $controller->index();
				return $response;

			}


	}
}