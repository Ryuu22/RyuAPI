<?php 
	/**
	 * Template provided by Daniel K. Bueno
	 */
	class User
	{
	    // database connection and table name
    	private $conn;
    	private $table_name = "users";

    	//TODO Add public variables.
		
		function __construct($db)
		{
			$this->conn = $db; //When you load an object 
		}

		public function MyFunction
		{
			$query = ""; //Write the mysql QUERY

	        // prepare query statement
	        $stmt = $this->conn->prepare($query);
	      
	        // execute query
	        $stmt->execute();
	      
	        return $stmt; //This variable contains the result of the query.

	        /*
	        * If you want to access the data inside "$stmt" you will have to use "$stmt->fetch(PDO::FETCH_ASSOC)"
			* If you do it once you will only get the LAST row. "$row = $stmt->fetch(PDO::FETCH_ASSOC)"
			* So what I usually do is use a while loop to extract every row.
			*
			*		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			*		{
			*			$object->id = $row->id; //The name of the object is the same you put in the query. 
			*		}
			*
	        */

		}
	}
?>