<?php
	$data  			= Route::get_route();
	if( $data != "404" ){
		$class 			=  new $data['controller'];

		if( $data['has_arguments'] )
			echo $class->{ $data['function'] }( $data['arguments'] );
		else
			echo $class->{ $data['function'] }();
	} else {
		echo ErrorsController::_404();
	}
	
?>