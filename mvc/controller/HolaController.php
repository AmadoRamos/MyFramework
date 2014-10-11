<?php
	/**
	* Controller
	*/
	class HolaController
	{
		/*
			si la funcion recibe argumentos estos seran enviados en un unico
			ARRAY asociativo, donde el key de los datos seran los nombres 
			que hayan sido nombrado en las rutas

			"/hola/{mensaje}" => "HolaController@hola"

			se recivira un array asociativo con una unica posicion y donde 
			el key sera "mensaje"

			$array["mensaje"]

		*/
		public function index()
		{
			return View::output("hola.index");
		}

		public function hola($argv)
		{
			//return "<br>hola, " . $argv['value'] . " <br>";
			$params = array( "name" => 'data', "value" => $argv['value'] );
			return View::output("hola.mundo", $params );
		}

		

		
	}
?>