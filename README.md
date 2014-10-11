MyFramework
===========

FRAMEWORK de PHP desarrollado por @dev_otaku


ROUTES:     
las rutas URL se crean en el archivo data/routes.php en el cual se escribiran llamando a la funcion new_route de la clase Route, enviando como primer parametro la ruta URL y de segundo parametro la clase del controllador y la funcion que va a usar dicha URL separados por un arroba.
			
			
			Route::new("/", "IndexController@index");
        
para las rutas que reciban datos via get, usaran los corchetes( {} ) para determinar el nombre con el cual vamos a trabajar y el que se va a recibir de parametro en la funcion.
			
			
			Route::new("/hola/{saludo}", "HolaController@hola");

CONTROLLERS:    los Controllers se crearan en la carpeta mvc/controllers
