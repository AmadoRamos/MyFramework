<?php
	/*
		URLs

		para recibir datos por get 
		usaran los corchetes( {} ) para determinar
		el nombre con el cual vamos a trabajar 
		y el que se va a recibir de parametro en la funcion del contructor

		se escribira el nombre sin espacios separando los corchetes y el nombre.
	*/

	
	Route::new_route("/hola/{mensaje}", "HolaController@hola");
	Route::new_route("/hola/{mensaje}/{mensaje2}", "HolaController@hola2");
	//Route::new_route("/{value}", "HolaController@index_2");
	Route::new_route("/", "HolaController@index");
?>