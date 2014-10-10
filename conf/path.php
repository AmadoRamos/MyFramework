<?php
if( !empty($_SERVER['PATH_INFO']) )
		$s = $_SERVER['PATH_INFO'];
	else
		$s = "/";
	$path = explode("/", $s);
	//unset($path[0]);
	foreach ($path as $key => $value) {
		if( $value == "" or $value == null )
			unset($path[$key]);
	}
	$path = array_values($path);
?>