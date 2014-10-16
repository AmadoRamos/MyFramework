<?php


/**
* 
*/
 class Model extends DB
{


	
	function __construct(){
		parent::__construct();
	}

	public function all()
	{
		self::$sql 	 = sprintf("SELECT * FROM %s", $this->table );
		//$sql 		.= $this->order_by($order_by);
		
		//var_dump(self::$sql);
		//$r 			 = mysqli_query( self::connect() ,self::$sql);
		$r = DB::query(self::$sql);
		if( $r ){
			$results	 = array();
			while ( $object = mysql_fetch_array($r) ) {
				$results[] = $object;
			}
			return $results;
		} 
		else {
			return False;
		}
	}

	public function find($id)
	{
		/*
			order_by : 
					array(
						[ order ] 	=> ASC or DESC
						[  field ]	=> field database
					)
			get_object_vars 
		*/
		self::$sql 	 = sprintf("SELECT * FROM %s WHERE id = %d",$this->table,$id );		
		//$result  = mysqli_query( $this->connect() ,self::$sql);
		$result = DB::query(self::$sql);
		return mysql_fetch_array($result);
	}

	
	public function findWhere($field, $symbol,  $value, $order_by = array())
	{
		/*
			order_by : 
					array(
						[ order ] 	=> ASC or DESC
						[  field ]	=> field database
					)
			get_object_vars 
		*/
		self::$sql 	 = sprintf("SELECT * FROM %s WHERE %s %s '%s'", $this->table ,$field,$symbol,$value );				

		return self::getInstance();
	}

	public function orderBy($field, $order = "ASC")
	{
		if( $order != "ASC" and $order != "DESC")
			$order = "ASC";
		if( !self::$sql_order )
			self::$sql_order = " ORDER BY ";
		else
			self::$sql_order .= ", ";

		self::$sql_order .= sprintf(" %s %s", $field, $order );
		return self::getInstance();;
	}

    public function get()
	{
		$r 		= array();
		$sql 	= self::$sql . self::$sql_order;
		//$result = mysqli_query($this->connect() , $sql );
		$result = DB::query(self::$sql);

		//var_dump($result);
		while ( $object =  mysql_fetch_array($result)) {
			$r[] = $object;
		}
		return $r;
	}

	public function save()
	{
		$vars = get_object_vars($this);
		unset($vars['table']);
		self::$sql 	= sprintf("INSERT INTO %s", $this->table);
		$fields 	= "(";
		$v 			= " VALUES(";
		$c 			= 1;
		foreach ($vars as $key => $value) {
			$fields .= sprintf("%s",  $key); //`id`, `username`, `password`) 
			$v 		.= sprintf("'%s'", mysql_escape_string($value) );  //([value-1],[value-2],[value-3])
			if( $c != sizeof($vars) )
			{
				$fields .= ",";
				$v 		.= ",";
			} else {
				$fields .= ")";
				$v 		.= ")";
			}
			$c++;
		}

		self::$sql .= $fields . $v;
		$result = DB::query(self::$sql);
		$this->id = mysql_insert_id();
		return $result;

	}
}
?>