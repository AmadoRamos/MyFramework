<?php
	/*
		URLs

		para recibir datos por get 
		usaran los corchetes( {} ) para determinar
		el nombre con el cual vamos a trabajar 
		y el que se va a recibir de parametro en la funcion del contructor
	*/

	
	Route::new_route("/hola/{value}", "HolaController@hola");
	//Route::new_route("/{value}", "HolaController@index_2");
	Route::new_route("/", "HolaController@index");
?>