<?php
/**
* 
*/
class Template
{

    public static function __layout__($output)
    {
        $count = self::_count($output, "{%");
        if( $count == 0 )
            return $output;
        else
        {
            for ($i=0; $i < $count; $i++) 
            { 
                list($block_name, $between) = self::block_name($output);
                //print_r($block_name);
                if( !empty($block_name) )
                {
                    if( $block_name[0] == "extends" )
                    {
                        //$extend_content     = View::output($block_name[1]);
                        $template           = View::template_exist($block_name[1]);
                        if ( !$template ) {
                            return "The specified view template does not exist";    
                        }
                        else
                        {
                            ob_start();
                            include($template);
                            $extend_content = ob_get_contents();
                            ob_end_clean();
                        }
                        $output         = str_replace("{%". $between  ."%}",  " " , $output);
                        $blocks         = self::blocks($output);

                        $extend_count   = self::_count( $extend_content, "{%");
                        //var_dump($extend_count);
                        for ($j=0; $j < $extend_count; $j++) 
                        { 
                            list($yield_name, $yield_between) = self::block_name($extend_content);
                            //var_dump($extend_content);
                            if( $yield_name[0] == 'yield' )
                            {
                                $extend_content = str_replace("{%". $yield_between ."%}", $blocks[ $yield_name[1] ], $extend_content);
                            }
                        }
                        $output = $extend_content;
                    }
                }

            }
        }
        return $output;
    }

    public static function blocks($output)
    {
        $count      = self::_count( $output, "{%");

        $blocks     = array();
        for ($i=0; $i < $count; $i++) 
        { 
            list( $block_name, $between ) = self::block_name($output);
            echo "$between <br>";
            if( $block_name[0] == 'block' )
            {
                $blocks[ $block_name[1] ] = (self::between_2( "{%" . $between . "%}", "{%endblock%}", $output ) == "") ? self::between_2( "{%" . $between . "%}", "{% endblock %}", $output ) : self::between_2( "{%" . $between . "%}", "{%endblock%}", $output ) ;
                //print_r( $blocks[ $block_name[1]]);
            }
            $output  = str_replace("{%". $between  ."%}",  " " , $output);
        }
        return $blocks;
    }
    public static function block_name($output)
    {
        $between    = self::between("{%", "%}", $output);
        $block      = self::separate($between, " ");
        foreach ($block as $key => $value) 
        {
            if( $value == "" or $value == null )
                unset($block[$key]);
        }
        $block      = array_values($block);
        return array($block, $between);
    }
    public static function __replace_vars__($output, $arguments)
    {

        if( !empty($arguments) )
            $$arguments['name'] = $arguments['value'];

        $count = self::_count($output, "{{");
        for ($i=0; $i < $count; $i++) 
        { 
            $between        = self::between("{{","}}", $output);
            $var_name       = self::clear( $between );
            $var_name       = self::separate($var_name, ".");
            $replace        = $$var_name[0];
            if( count($var_name) > 0 )
            {
                if( is_array( $replace ) )
                {
                    for ($j=1; $j < count($var_name) ; $j++) 
                    { 
                        if (isset($replace[ $var_name[$j] ]) and !empty($replace[$var_name[$j]])) 
                        {  
                            $replace = $replace[ $var_name[$j] ];
                        }
                        else
                        {
                            echo  sprintf("<h1> '%s'  variable no definida.</h1>", $var_name[$j]) ;
                            exit;
                        }
                    }
                } 
            }
            @$output   = str_replace("{{". $between  ."}}",  sprintf("%s",htmlspecialchars($replace) ) , $output);

        }
        return $output;
    }

    public static function separate($var, $delimiter )
    {        
        return explode($delimiter, $var);
    }

    public static function clear($text)
    {
        return str_replace(" ", "", $text) ;
    }

    public static function _count($text, $search)
    {
        return substr_count($text, $search);
    }
	
	public static function between ($t, $that, $inthat)
	{
		return self::before ($that, self::after($t, $inthat));
	}

    public static function between_2 ($t, $that, $inthat)
    {
        return self::before ($that, self::after_last($t, $inthat));
    }

	public static function after ($t, $inthat)
    {
        if (!is_bool(strpos($inthat, $t)))
        return substr($inthat, strpos($inthat,$t)+strlen($t));
    }

    public static function after_last ($t, $inthat)
    {
        if (!is_bool( self::strrevpos($inthat, $t)))
        return substr($inthat, self::strrevpos($inthat, $t)+strlen($t));
    }

    public static function before ($t, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $t));
    }

    public static function before_last ($t, $inthat)
    {
        return substr($inthat, 0, self::strrevpos($inthat, $t));
    }

    public static function strrevpos($instr, $needle)
	{
	    $rev_pos = strpos (strrev($instr), strrev($needle));
	    if ($rev_pos===false) return false;
	    else return strlen($instr) - $rev_pos - strlen($needle);
	}
}
?>