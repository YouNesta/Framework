<?php


require_once('vendor/autoload.php');

function do_tabs($n = 0)
{
	$ret = "\t";
	for ($i=0; $i < $n; $i++) {
		$ret .= "\t";
	}
	return $ret;

}
function jump($n = 0)
{

	$ret = "\n";
	for ($i=0; $i < $n; $i++) {
		$ret .= "\n";
	}
	return $ret;

}

// DOCTRINE SELECT FIELDS IN TABLE to FIELDS

$fields = array();

$className = $argv[1];

foreach ( $argv as $arg){
	if($arg == $argv[0] || $arg == $argv[1]){

	}else{
		array_push($fields, $arg);
	}

}
// Do some magic here
$code = "<?php " . jump(2);
$code .= "namespace App\\Model;" . jump(2);
$code .= "class ".ucfirst($className).jump()."{" . jump();
foreach ($fields as $field)
{
	$code .= do_tabs() . 'protected $'.$field.";" . jump();
}
$code .= jump();
foreach ($fields as $field)
{
	$code .= do_tabs() . 'public function get'.ucfirst($field)."()" . jump();
	$code .= do_tabs() . "{" . jump();
	$code .= do_tabs(1) . 'return $this->'.$field.";" . jump();
	$code .= do_tabs() . "}" . jump(2);
	$code .= do_tabs() . 'public function set'.ucfirst($field).'($'.$field.")" . jump();
	$code .= do_tabs() . "{" . jump();
	$code .= do_tabs(1) . '$this->'.$field.' = $'.$field.";" . jump();
	$code .= do_tabs() . "}" . jump(2);
}

$code .= do_tabs() . "public function save()" . jump();
$code .= do_tabs() . "{" . jump();
$code .= do_tabs(1) . '$this->persist($this) '.";" . jump();
$code .= do_tabs() . "}" . jump(2);

$code .= do_tabs() . "public static function factory()" . jump();
$code .= do_tabs() . "{" . jump();
$code .= do_tabs(1) . 'return new '.ucfirst($className).";" . jump();
$code .= do_tabs() . "}" . jump(2);

$code .= do_tabs() . "public static function countItem()" . jump();
$code .= do_tabs() . "{" . jump();
$code .= do_tabs(1) . '$self = self::factory()'.";" . jump();
$code .= do_tabs(1) . '$result = $self::countItems($self)'.";" . jump();
$code .= do_tabs(1) . 'return $result'.";" . jump();
$code .= do_tabs() . "}" . jump(2);


$code .= "}\n";
file_put_contents("src/Model/".$className.".php", $code);


//Create Class With Index method
$methods = array();
foreach ( $argv as $arg){
	if($arg == $argv[0] || $arg == $argv[1]){

	}else{
		array_push($methods, $arg);
	}

}

$code = "<?php " . jump(2);
$code .= "namespace App\\Controller;" . jump(2);
$code .= "class ".ucfirst($className).jump()."{" . jump();

$code .= do_tabs() . "public function index()" . jump();
$code .= do_tabs() . "{" . jump();
$code .= do_tabs() . "}" . jump(2);
foreach ($methods as $method)
{
	$code .= do_tabs() . 'public function '.$method."()" . jump();
	$code .= do_tabs() . "{" . jump();
	$code .= do_tabs() . "}" . jump(2);

}

$code .= "}\n";

file_put_contents("src/Controller/".$className.".php", $code);


//Create View index



if(!is_dir('src/View/'.ucfirst($className))){
	mkdir('src/View/'.ucfirst($className));
}

$code = "<div class='".$className."Index'>" . jump(2);

$code .=jump(2);

$code .="</div>";


file_put_contents("src/View/".ucfirst($className)."/index.twig", $code);

foreach ($methods as $method)
{
	$code = "<div class='".$className.ucfirst($method)."'>" . jump(2);

	$code .=jump(2);

	$code .="</div>";
	file_put_contents("src/View/".ucfirst($className)."/".$method.".twig", $code);


}

// Do some magic here