<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 10/02/2016
 * Time: 14:16
 */
namespace Core;


class Logs {
	private static $accessLog = 'app/logs/access.log';
	private static $errorLog = 'app/logs/error.log';

	public static function access($info){
		file_put_contents(self::$accessLog, $_SERVER['REMOTE_ADDR'].' : '.date("[d/m/y H:i:s]")." : ".$info." \n", FILE_APPEND);
	}
	public static function error($info){
		file_put_contents(self::$errorLog, $_SERVER['REMOTE_ADDR'].' : '.date("[d/m/y H:i:s]")." : ".$info." \n", FILE_APPEND);

	}
}
