<?php
require("config.php");
try{
	$chainecon='mysql:host='.HOST.';dbname='.BD;
	$idcon=new PDO($chainecon,USER,PWD);
}
catch(PDOException $ex){
	echo $ex->getMessage();
	exit();
	//die();
}

?>