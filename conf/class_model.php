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
		
		var_dump(self::$sql);
		$r 			 = mysqli_query( self::connect() ,self::$sql);
		if( $r ){
			$results	 = array();
			while ( $object = mysqli_fetch_object($r) ) {
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
		$result  = mysqli_query( $this->connect() ,self::$sql);
		return mysqli_fetch_object($result);
	}

	
	public function where($field, $symbol,  $value, $order_by = array())
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
		//$sql 	.= $this->order_by();
		//$result  = mysql_query($sql);
		//return mysql_fetch_object($result);

		return self::getInstance();
	}

	public function order_by($field, $order = "ASC")
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
		$result = mysqli_query($this->connect() , $sql );
		echo self::$sql . self::$sql_order;
		//var_dump($result);
		while ( $object =  mysqli_fetch_object($result)) {
			$r[] = $object;
		}
		return $r;
		//return self::$sql;
	}
	
	/*
	private function sql_order($order_by = array())
	{
		$sql_order = "";
		if( !empty($order_by) )
		{
			$sql_order = " ORDER BY ";
			if( !array_key_exists( 0, $order_by) )
			{
				$sql_order .= sprintf(" %s %s", $order_by['field'], $order_by['order'] );
			}
			else 
			{
				foreach ($order_by as $key => $value) 
				{
					$sql_order .= sprintf(" %s %s", $order_by['field'], $order_by['order'] );
					if( sizeof($order_by) != $key )
						$sql_order .= ",";
				}
			}
		}

		return $sql_order;
	}
	*/
}
?>