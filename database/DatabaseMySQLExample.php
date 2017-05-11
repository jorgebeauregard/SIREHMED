<?php

class DatabaseMySQL extends PDO{
 
	//dbname
	private $dbname = "sirehmed_sql";
	//host
	private $host 	= "localhost";
	//user database
	private $user 	= "root";
	//password user
	private $pass 	= '';
	//port
	private $port 	= 3306;
    //instance
	private $dbh;
 
	//connect with postgresql and pdo
	public function __construct(){
	    try {
	        $this->dbh = parent::__construct("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->pass");
	    }
        catch(PDOException $e){
	        echo  $e->getMessage();
	    } 
	}
 
	//función para cerrar una conexión pdo
	public function close(){
    	$this->dbh = null;
	} 
}

?>