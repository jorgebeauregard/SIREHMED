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

    public function save($n_email, $n_pwd, $n_permit,$n_name,$n_last_name,$n_specialty){
        try{
            $query = $this->mysql->prepare('CALL insertUser(?,?,?) ;');
            $query->bindParam(1,$n_email, PDO::PARAM_STR);
            $query->bindParam(2,$n_pwd, PDO::PARAM_STR);
            $query->bindParam(3,$n_permit, PDO::PARAM_INT);
            $query->execute();


            

            $query = $this->mysql->prepare('SELECT id FROM users WHERE email = ?');
            $query->bindParam(1,$n_email,PDO::PARAM_STR);
            $query->execute();
            $query_obj = $query->fetch(PDO::FETCH_OBJ);

            $id = $query_obj->id;

            $query = $this->mysql->prepare('INSERT INTO medical_personnel(id,name,last_name,specialty) values (?,?,?,?');

            $query->bindParam(1,$id,PDO::PARAM_INT);
            $query->bindParam(2,$n_name,PDO::PARAM_STR);
            $query->bindParam(3,$n_last_name,PDO::PARAM_STR);
            $query->bindParam(4,$n_specialty,PDO::PARAM_STR);
            $query->execute();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function update($id,$n_name,$n_last_name,$n_specialty){
        try{
            $query = $this->mysql->prepare('UPDATE medical_personnel SET 
                name = ?, last_name = ?, specialty = ?
            WHERE id = ?');
            $query->bindParam(1,$n_name, PDO::PARAM_STR);
            $query->bindParam(2,$n_last_name, PDO::PARAM_STR);
            $query->bindParam(3,$n_specialty, PDO::PARAM_STR);
            $query->bindParam(4,$id, PDO::PARAM_INT);
            $query->execute();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
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
            $query = $this->mysql->prepare('SELECT id,name,last_name, age,gender,weight, height FROM patients');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }

    public function getPatientInfo($id){
        try{
            $query = $this->mysql->prepare('SELECT *
                                        FROM patients where patients.id = ?;');
            $query->bindParam(1, $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function getDoctorInfo(){
        try{
            $query = $this->mysql->prepare('SELECT CONCAT(medical_personnel.name, \' \', medical_personnel.last_name) as name, specialty  FROM medical_personnel;');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

}
?>


