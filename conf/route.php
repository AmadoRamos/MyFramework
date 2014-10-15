<?php
	$data  			= Route::get_route();
	if( $data != "404" ){
		$class 			=  new $data['controller'];

		if( $data['has_arguments'] )
			$output =  $class->{ $data['function'] }( $data['arguments'] );
		else
			$output =$class->{ $data['function'] }();
	} else {
		$output =ErrorsController::_404();
	}
	echo $output;
	
?>