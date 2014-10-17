MyFramework
===========

FRAMEWORK de PHP desarrollado por @dev_otaku


ROUTES:     
las rutas URL se crean en el archivo data/routes.php en el cual se escribiran llamando a la funcion new_route de la clase Route, enviando como primer parametro la ruta URL y de segundo parametro la clase del controllador y la funcion que va a usar dicha URL separados por un arroba.
			
			
			Route::new("/", "IndexController@index");
        
para las rutas que reciban datos via get, usaran los corchetes( {} ) para determinar el nombre con el cual vamos a trabajar y el que se va a recibir de parametro en la funcion.
			
			
			Route::new("/hola/{saludo}", "HolaController@hola");

CONTROLLERS:    
los Controllers se crearan en la carpeta mvc/controllers, el nombre del archivo y la clase deben sesr los mismos. las funciones deben ser publicas y aquellas que reciban parametros se definira en la funcion una unica variable que sera un arreglo asosiativo donde las llaves de este arreglo seran los escritos en la ruta entre corchetes.
			
			
			array([saludo] => "mundo")
			
			
las funciones retornaran la funcion output de la clase View, dicha funcion recibira 2 parametros, el primero sera un string con el nombre del archivo php que contiene la plantilla partiendo desde la carpeta mvc/view/, si dicho arcivo se encuentra dentro de una carpeta se separara el nombre del archivo y la carpeta por un punto.
			
			
			"folder.folder.file"
			
para el archivo
			
			mvc/view/folder/folder/file.php
			
			
el segundo parametro que recibe la funcion es opcional y son los datos que seran usados en la plantilla, sera un arreglo asociativo con los siguientes datos: 
	- [name]  : sera el nombre de la variable que se usara dentro de la plantilla.
	- [value] : seran los valores usados.
	
			
			array( "name" => 'data', "value" => $argv['mensaje'] )

View:

las vistas se crearan en la carpeta mvc/views, las plantillas se crearan con extencion .php. se podra usar la varialbe declarada en el controlador.
			
			
			{{ data }}
			mundo
