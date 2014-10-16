<?php
/**
* 
*/
class Vars
{
    public static function get($output, $arguments)
    {

        if( !empty($arguments) )
            $$arguments['name'] = $arguments['value'];

        $count = self::_count($output, "{{");
        for ($i=0; $i < $count; $i++) 
        { 
            $between        = self::between("{{","}}", $output);
            $var_name       = self::clear( $between );
            $var_name       = self::separate($var_name);
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

    public static function separate($var)
    {
        
        return explode(".", $var);
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