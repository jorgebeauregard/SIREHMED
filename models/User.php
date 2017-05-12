<?php 
class User{
	private $psql;
    private $mysql;

    private $id;
    private $email;
    private $password
    private $permission

    public function __construct(Database $psql, Database $mysql){
		$this->psql = new $psql;
        $this->mysql = new $mysql;
	}

	public function save(){
		try{
			$query = $this->psql->prepare('INSERT INTO users(email, password, permission) values (?,?,?)');
			$query->bindParam(1,$this->email, PDO::PARAM_STR);
			$query->bindParam(2,$this->password, PDO::PARAM_STR);
			$query->bindParam(3,$this->permission, PDO::PARAM_INT);
			$query->execute();
			$this->psql->close();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	
}

?>