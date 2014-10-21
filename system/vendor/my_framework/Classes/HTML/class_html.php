<?php

/**
* 
*/
class HTML
{
	/*
		parameters:
				URL:
				TITLE:
				ATTRIBUTES:
	*/
	public static function a($url, $title = null, $attributes = array(), $arguments = array() )
	{

		$attrs = "";
		if( count( explode("Controller@", $url) ) > 1 )
		{
			$url = Route::action( $url, $arguments );
		}
		foreach ($attributes as $attr => $value) 
		{
			$attrs = sprintf(" %s = '%s' ", $attr , $value);
		}
		if( is_null($title ) or $title == False )
		{
			$title = $url;
		}
		return sprintf("<a href='%s' %s>%s</a> ", $url, $attrs, htmlspecialchars($title));
	}
}

?>