<?php

/**
* 
*/
class Route
{
	private static $routes 	= array();
	private static $path 	= array();

	private static function path() {
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
		self::$path = array_values($path);
   	}

	public function get_route()
	{
		self::path();
		if( self::is_index() )
			self::$path = array("");
		$routes  		= self::$routes;
		//eliminar URLs sin la misma cantidad de datos que el path
		$routes 		= self::dif_count($routes);
		//emilinar las que no sean absolutamente iguales, 
		//si se retorna un arreglo vacio se buscaran councidencias
		$temp_routes 	= self::not_equals($routes);
		if( !empty($temp_routes))
			$routes = $temp_routes;
		else
		{
			//se buscaran la cantidad de "palabras" iguales y la cantidad de argumentos
			$matches = self::matches($routes);
			list($temp_routes, $matches) = self::delete_unmatches($routes, $matches);
			if( count($temp_routes) == 1 )
				$routes = $temp_routes;
			else {
				$temp_routes = self::cant_matches($routes, $matches);
				if( !empty($temp_routes) )
					$routes = $temp_routes;
				else
					return "404";
			}
		}
		$route 	= array_keys($routes);
		$route 	=  explode("/", $route[0]);
		unset($route[0]);
		$route 	= array_values($route);

		$keys 	= array_keys($routes);
		$v 		= $routes[ $keys[0] ];
		$v 		= explode("@", $v);

		return array( "controller" => $v[0], "function" => $v[1] , "has_arguments" => self::has_arguments( $route ), "arguments" => self::arguments($route) );
	}

	public function new_route($route, $controller)
	{
		self::$routes[$route] = $controller;
	}

	private static function dif_count($routes)
	{
		foreach ($routes as $route => $controller) {
			$r 	=  explode("/", $route);
			unset($r[0]);
			$r 	= array_values($r);
			if( count(self::$path) != count($r) ){
				unset($routes[$route]);
			}
		}
		return $routes;
	}

	private static function not_equals($routes)
	{
		foreach ($routes as $route => $controller) {
			$r 	=  explode("/", $route);
			unset($r[0]);
			$r 	= array_values($r);
			for ($i=0; $i < count($r); $i++) { 
				if( self::$path[$i] != $r[$i] )
				{
					unset($routes[$route]);
				}
			}
		}
		return $routes;
	}

	private static function matches($routes)
	{
		$m = array();
		foreach ($routes as $route => $controller) {
			$r 	=  explode("/", $route);
			unset($r[0]);
			$r 	= array_values($r);
			$ca = array( "words" => 0, "arguments" => 0 );
			for ($i=0; $i < count($r); $i++) { 
				if( self::$path[$i] != $r[$i] )
				{
					if( self::is_argument($r[$i]) ){
						$ca["arguments"]++;
					}
				}
				else {
					$ca["words"]++;
				}
			}
			$m[$route] = $ca;
		}
		return $m;
	}

	private static function delete_unmatches($routes, $matches)
	{
		foreach ($matches as $route => $match) {
			$r 	=  explode("/", $route);
			unset($r[0]);
			$r 	= array_values($r);
			if( count($r) != ( $match['words'] + $match['arguments'] ) ){
				unset($routes[$route]);
				unset($matches[$route]);
			}
		}
		return array($routes, $matches);
	}

	private static function cant_matches($routes, $matches)
	{
		$large 	= 0;
		$r 		= array();
		foreach ($matches as $route => $match) {
			if( $match['words'] > $large ){
				$large = $match["words"];
				$r[$route] = $routes[$route];
			}
		}
		
		return $r;
	}


	

	private static function is_argument($route)
	{
		if(  ereg("(^{)*(}$)", $route )  )
			return True;
		else
			return False;
	}

	private static function has_arguments($route)
	{
		for ($i=0; $i < count($route); $i++) 
		{ 
			if(  ereg("(^{)*(}$)", $route[$i] )  )
				return True;
		}
		return False;
	}
	
	private static function arguments( $route) 
	{
		$path 		= self::$path;
		$arguments 	= array();
		for ($i=0; $i < count($path); $i++) 
		{ 
			if(  ereg("(^{)*(}$)", $route[$i] )  )
			{
				if( $path[$i] != "" )
				{
					$replace = array("{","}");
					$w = str_replace($replace,"",$route[$i]);
					$arguments[$w] = $path[$i];
				}
			}
		}
		return $arguments;
	}

	private static function is_index()
	{
		if( empty(self::$path) )
			return True;
		else
			return False;
	}
}

?>