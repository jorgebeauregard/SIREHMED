<?php
class Personal{
	private $psql;
    private $mysql;

    //user info
    private $id;
    private $email;
    private $pwd;
    private $permit;

    //MEDICAL_PERSONNEL data
    private $name;
    private $last_name;
    private $specialty;
    private $active;


    public function __construct(PDO $db){
        $this->mysql = $db;
    }

    public function setId($id){
        $this->id = $id;
    }

    

    public function save(){

    }

    public function get(){

    }

    public function update(){

    }

    public function delete(){
        
    }

    public function getAllPatients(){
        //last name, name, age , gender, weight
        try{
            $query = $this->mysql->prepare('SELECT name,last_name, age,gender,weight, height FROM patients');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
?>


