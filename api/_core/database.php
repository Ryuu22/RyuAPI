<?php 

class Database
{
	//DatabaseCredentials
	private $host = "";
    private $db_name = "";
    private $user_name = "";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection()
    {
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user_name, $this->password);
            $this->conn->exec("set names utf8");
            
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>