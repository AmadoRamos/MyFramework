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
			$u = new User;
			$u->username = "ander2";
			$u->password = "ander2";
			$result = $u->save();
			//$v = $u->where("id",'>',"0")->order_by('id', 'DESC')->get();

			//$v = User::all();
			//$v = $u->all();

			$params = array( "name" => 'data', "value" => $u );
			return View::output("hola.index", $params);
		}

		public function hola($argv)
		{
			//return "<br>hola, " . $argv['value'] . " <br>";
			$params = array( "name" => 'data', "value" => $argv['value'] );
			return View::output("hola.mundo", $params );
		}

		

		
	}
?>