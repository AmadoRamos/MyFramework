<?php
/**
* 
*/
class DB
{
    static $_instance = null;
	static $sql_order;
    static $sql;

    function __construct(){
		
	}

    static function connect($host=HOST, $username=USERNAME, $password=PASSWORD,$database_name=DATABASE )
	{
		$enlace = mysql_connect($host,$username , $password );
		if (!$enlace) {
			die('No se pudo conectar: <br> ' . mysql_error());
		}
		//asignar la base de datos
		mysql_select_db($database_name);
	}
	/*
	function __construct($host=HOST, $username=USERNAME, $password=PASSWORD,$database_name=DATABASE )
	{
		$enlace = mysql_connect($host,$username , $password );
		if (!$enlace) {
			die('No se pudo conectar: <br> ' . mysql_error());
		}
		//asignar la base de datos
		mysql_select_db($database_name);
	}
	*/
	static function getInstance ()
    {
        if (self::$_instance === null) {
            self::$_instance = new Model;
        }
        return self::$_instance;
    }

    public function query($sql)
    {
    	$this->connect();
    	$result = mysql_query($sql );
    	if( !mysql_error() ){
    		return $result;
    	}
    	return mysql_error();
    }


}
?>