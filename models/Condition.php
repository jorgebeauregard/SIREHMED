<?php
class Condition{
	private $psql;
    private $mysql;

    //info
    private $id;
    private $patient_id;
    private $condition_description;
    private $condition_type;
  

    public function __construct(PDO $db){
        $this->mysql = $db;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function get($patiend_id){
        try{
            $query = $this->mysql->prepare('SELECT * FROM medical_conditions WHERE patiend_id = ?');
            $query->bindParam(1,$patiend_id, PDO::PARAM_INT);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_OBJ); 
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function save($n_patient_id, $n_condition_description, $n_condition_type){
        try{
            $query = $this->mysql->prepare('INSERT INTO medical_conditions(patiend_id, condition_description, condition_type) values (?,?,?)');
            $query->bindParam(1,$n_patient_id, PDO::PARAM_INT);
            $query->bindParam(2,$n_condition_description, PDO::PARAM_STR);
            $query->bindParam(3,$n_condition_type, PDO::PARAM_STR);
            $query->execute();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function update($id,$n_condition_description, $n_condition_type){
        try{
            $query = $this->mysql->prepare('UPDATE medical_conditions SET 
                condition_description = ?, condition_type = ?
            WHERE id = ?');
            $query->bindParam(1,$n_condition_description, PDO::PARAM_STR);
            $query->bindParam(2,$n_condition_type, PDO::PARAM_STR);
            $query->bindParam(3,$id, PDO::PARAM_INT);
            $query->execute();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function delete(){
        try{
            $query = $this->con->prepare('DELETE FROM medical_conditions WHERE id = ?');
            $query->bindParam(1, $this->id, PDO::PARAM_INT);
            $query->execute();
            $this->con->close();
            return true;
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
?>


