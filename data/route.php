<?php
	/*
		URLs

		para recibir datos por get 
		usaran los corchetes( {} ) para determinar
		el nombre con el cual vamos a trabajar 
		y el que se va a recibir de parametro en la funcion del contructor
	*/

	Route::new_route("/que/hace/{value}", "HolaController@que_hace_2");
	Route::new_route("/{value_0}/{value_1}/{value_2}","HolaController@que_hace_4");
	Route::new_route("/que/hace/3","HolaController@que_hace_3");
	Route::new_route("/{value}/{value_2}","HolaController@index_3");

	Route::new_route("/que/hace", "HolaController@que_hace");
	Route::new_route("/hola/{value}", "HolaController@hola");
	//Route::new_route("/{value}", "HolaController@index_2");
	Route::new_route("/", "HolaController@index");
?>