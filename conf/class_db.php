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
    public function connect($host=HOST, $username=USERNAME, $password=PASSWORD,$database_name=DATABASE )
	{
		$enlace = mysqli_connect($host,$username , $password , $database_name);
		if (mysqli_connect_errno()) {
		  die( "Failed to connect to MySQL: " . mysqli_connect_error());
		}
		return $enlace;
		//asignar la base de datos
		//mysql_select_db($database_name);
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
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function get()
	{

		$result = mysql_query(self::$sql . self::$sql_order );
		while ( $object =  mysql_fetch_object($result)) {
			$r[] = $object;
		}
		return $r;
		//return self::$sql;
	}
}
?>