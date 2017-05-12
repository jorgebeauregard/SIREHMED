<?php
class Drug{
	private $psql;
    private $mysql;

    //info
    private $id;


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

    public function update($medical_condition_id,$n_drug, $n_description){
        try{
            $query = $this->mysql->prepare('UPDATE medical_procedure_drugs SET 
                drug = ?, description = ?
            WHERE id = ?');
            $query->bindParam(1,$n_drug, PDO::PARAM_STR);
            $query->bindParam(2,$n_description, PDO::PARAM_STR);
            $query->bindParam(3,$medical_condition_id, PDO::PARAM_INT);
            $query->execute();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function delete(){
        try{
            $query = $this->con->prepare('DELETE FROM medical_procedure_drugs WHERE id = ?');
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


