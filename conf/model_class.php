<?php


/**
* 
*/
class Model
{
	public function all()
	{
		$sql 		= "SELECT * FROM $this->table";
		$r 			= mysql_query($sql);
		$results	= array();
		while ( $object = mysql_fetch_object($r) ) {
			$results[] = $object;
		}

		return mysql_fetch_object($results);
	}

	public function get_by_id($id, $order_by = array())
	{
		/*
			order_by : 
					array(
						[ order ] 	=> ASC or DESC
						[  field ]	=> field database
					)
			get_object_vars 
		*/
		$sql 		= "SELECT * FROM $this->table WHERE id = $id";
		$sql_order 	= "";
		
		$sql 	.= $this->order_by();
		$result  = mysql_query($sql);
		return mysql_fetch_object($result);
	}

	public function sql_order($order_by = array())
	{
		$sql_order = "";
		if( !empty($order_by) )
		{
			$sql_order = " ORDER BY ";
			if( !array_key_exists( 0, $order_by) )
			{
				$sql_order .= " ". $order_by['field'] . " " . $order_by['order'];
			}
			else 
			{
				foreach ($order_by as $key => $value) 
				{
					$sql_order .= " ". $value['field'] . " " . $value['order'];
					if( sizeof($order_by) != $key )
						$sql_order .= ",";
				}
			}
		}

		return $sql_order;
	}
}
?>