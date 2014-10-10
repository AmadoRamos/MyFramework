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
			return "<br>index<br>";
		}

		public function index_2($argv)
		{
			return "<br>index 2 value " . $argv['value'] . " <br>";
		}

		public function index_3($argv)
		{
			return $argv['value'] . " - index_3 - " . $argv['value_2'];
		}

		public function que_hace_4($argv)
		{
			return $argv['value_0'] . " - que_hace_4 - " . $argv['value_1']  . " - " . $argv['value_2'];
		}

		public function que_hace()
		{
			return "<br>que hace<br>";
		}

		public function que_hace_3()
		{
			return "<br>que hace 3<br>";
		}

		public function que_hace_2($argv)
		{
			return "<br>que hace 2 " . $argv['value'] . "<br>";
		}

		public function hola($argv)
		{
			return "<br>hola, " . $argv['value'] . " <br>";
		}
	}
?>