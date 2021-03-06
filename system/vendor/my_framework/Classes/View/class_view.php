<?php

/**
* 
*/
class View
{
	public function output($view, $argments = array())
	{
		$template =self::template_exist($view);
		if ( !$template ) {
			return "The specified view template does not exist";	
		}
		else
		{
			/*
			if(!empty($argments))
				$$argments['name'] = $argments['value'];
			*/
			ob_start();
	        include($template);
	        $content = ob_get_contents();
	        ob_end_clean();
			$content = Template::__layout__($content);
			$content = Template::__replace_vars__($content, $argments);
			//var_dump($vars);
	        return $content; 
		}
	}

	public static function template_exist($view)
	{
		$view = str_replace(".", "/", $view);
		$view = "mvc/views/" . $view . '.php';
        if (!file_exists($view)) 
            return False;
        else
        	return $view;
	}
	
}

?>