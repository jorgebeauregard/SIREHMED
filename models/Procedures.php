<?php
class Procedures{
	private $psql;
    private $mysql;

    //info
    private $id;
    private $patient_id;
    private $cause;
    private $procedure_type;
    private $observations;
    private $doctor_id;
    private $date_realized;

    public function __construct(PDO $db){
        $this->mysql = $db;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function get(){

    }

    public function save($patient_id,$cause,$procedure_type,$observations,$doctor_id,$date_realized){
        try{
            $query = $this->mysql->prepare('INSERT INTO medical_procedures(patient_id,cause,procedure_type,observations, doctor_id,date_realized) values (?,?,?,?,?,=)');
            $query->bindParam(1,$patient_id     , PDO::PARAM_INT);
            $query->bindParam(2,$cause          , PDO::PARAM_STR);
            $query->bindParam(3,$procedure_type , PDO::PARAM_STR);
            $query->bindParam(4,$observations   , PDO::PARAM_STR);
            $query->bindParam(5,$doctor_id      , PDO::PARAM_INT);
            $query->bindParam(6,$date_realized  , PDO::PARAM_STR);

            $query->execute();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function update($id,$cause,$procedure_type,$observations,$doctor_id,$date_realized){
        try{
            $query = $this->mysql->prepare('UPDATE medical_procedures SET patient_id = ?,cause,procedure_type = ?,observations = ?, doctor_id = ?,date_realized = ?) WHERE id = ?');
            
            $query->bindParam(1,$cause          , PDO::PARAM_STR);
            $query->bindParam(2,$procedure_type , PDO::PARAM_STR);
            $query->bindParam(3,$observations   , PDO::PARAM_STR);
            $query->bindParam(4,$doctor_id      , PDO::PARAM_INT);
            $query->bindParam(5,$date_realized  , PDO::PARAM_STR);
            $query->bindParam(6,$patient_id     , PDO::PARAM_INT);

            $query->execute();
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function delete(){
        try{
            $query = $this->con->prepare('DELETE FROM medical_procedures WHERE id = ?');
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


