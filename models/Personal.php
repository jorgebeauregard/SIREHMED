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

    public function get(){

    }

    public function save(){

    }

    public function update($id,$n_name,$n_last_name,$n_specialty){

    }

    public function delete(){
        try{
            //set to passive
            $query = $this->mysql->prepare('UPDATE patients SET active = ? WHERE id = ?');
            $query->bindParam(1,0,PDO::PARAM_INT);
            $query->bindParam(2,$this->id,PDO::PARAM_INT);
            $query->execute();

            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
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
}
?>


