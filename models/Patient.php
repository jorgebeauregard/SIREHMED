<?php
class Patient{
	private $psql;
    private $mysql;

    //user info
    private $id;
    private $email;
    private $pwd;
    private $permit;    

    //patient
    private $name;
    private $last_name;
    private $age;
    private $height;
    private $weight;
    private $gender;
    private $blood_type;
    private $birthdate;
    private $emergency_name;
    private $emergency_phone;
    private $body_mass_index;
    private $active;


    public function __construct(PDO $db){
        $this->mysql = $db;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    //gets id from user using email 
    public function getId($email){
        try{
            $query = $this->mysql->prepare('SELECT id FROM users WHERE email = ?');
            $query->bindParam(1,$email,PDO::PARAM_STR);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);

        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }   
    }
    //Done
    public function save($n_email, $n_pwd, $n_permit,$n_name,$n_last_name,$n_age,$n_height,$n_weight,$n_gender,$n_blood_type,$n_birthdate,$n_emergency_name,$n_emergency_phone){
        try{

            //First create user
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

            //Then create patient
            $query = $this->mysql->prepare('INSERT INTO patients(id,
                name,last_name,age,height,weight,gender,blood_type,birth_date,
                emergency_name,emergency_phone,body_mass_index) VALUES (?,?,?,?,?,?,?,?,?,?,?,setBodyMassIndex(?,?))');
            $query->bindParam(1,$id, PDO::PARAM_INT);
            $query->bindParam(2,$n_name, PDO::PARAM_STR);
            $query->bindParam(3,$n_last_name, PDO::PARAM_STR);
            $query->bindParam(4,$n_age, PDO::PARAM_INT);
            $query->bindParam(5,$n_height, PDO::PARAM_STR);
            $query->bindParam(6,$n_weight, PDO::PARAM_STR);
            $query->bindParam(7,$n_gender, PDO::PARAM_STR);
            $query->bindParam(8,$n_blood_type, PDO::PARAM_STR);
            $query->bindParam(9,$n_birthdate, PDO::PARAM_STR);
            $query->bindParam(10,$n_emergency_name, PDO::PARAM_STR);
            $query->bindParam(11,$n_emergency_phone, PDO::PARAM_STR);
            $query->bindParam(12,$n_weight, PDO::PARAM_STR);
            $query->bindParam(13,$n_height, PDO::PARAM_STR);
            $query->execute();

        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    //Incomplete
    public function update($id,$n_name,$n_last_name,$n_age,$n_height,$n_weight,$n_gender,$n_blood_type,$n_birthdate,$n_emergency_name,$n_emergency_phone){
        try{
            $query = $this->mysql->prepare('UPDATE patients SET 
                name = ?,   last_name = ?,  age = ?,
                height = ?, weight = ?,     gender = ?,
                blood_type = ?, birth_date = ?, emergency_name = ?,
                emergency_phone = ?, body_mass_index = setBodyMassIndex(?,?)
            WHERE id = ?');
            $query->bindParam(1,$n_name, PDO::PARAM_STR);
            $query->bindParam(2,$n_last_name, PDO::PARAM_STR);
            $query->bindParam(3,$n_age, PDO::PARAM_INT);
            $query->bindParam(4,$n_height, PDO::PARAM_STR);
            $query->bindParam(5,$n_weight, PDO::PARAM_STR);
            $query->bindParam(6,$n_gender, PDO::PARAM_STR);
            $query->bindParam(7,$n_blood_type, PDO::PARAM_STR);
            $query->bindParam(8,$n_birthdate, PDO::PARAM_STR);
            $query->bindParam(9,$n_emergency_name, PDO::PARAM_STR);
            $query->bindParam(10,$n_emergency_phone, PDO::PARAM_STR);
            $query->bindParam(11,$n_weight, PDO::PARAM_STR);
            $query->bindParam(12,$n_height, PDO::PARAM_STR);
            $query->bindParam(13,$id, PDO::PARAM_INT);
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
    //Show list of conditions
    public function getMedicalConditionList(){
        try{
            $query = $this->mysql->prepare('SELECT condition_description,condition_type FROM medical_conditions WHERE patient_id = ?');
            $query->bindParam(1,$this->id,PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);

        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }
    //Show medical procedures //Todo el procedure y nombre completo del doc, specialty
    public function getMedicalProceduresList(){
        try{
            $query = $this->mysql->prepare('SELECT medical_procedures.id, medical_procedures.cause, medical_procedures.procedure_type, medical_procedures.observations, CONCAT(medical_personnel.name,\' \', medical_personnel.last_name) AS name, medical_personnel.specialty FROM medical_procedures INNER JOIN medical_personnel ON medical_procedures.doctor_id = medical_personnel.id WHERE patient_id = ?');
            $query->bindParam(1,$this->id,PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);

        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }
    //Show procedure based on id of it
    public function showMedicalProcedure($procedure_id){
        try{
            $query = $this->mysql->prepare('SELECT medical_procedures.cause, medical_procedures.procedure_type, medical_procedures.observations,medical_procedures.date_realized, CONCAT(medical_personnel.name,\' \', medical_personnel.last_name) AS name, medical_personnel.specialty FROM medical_procedures INNER JOIN medical_personnel ON medical_procedures.doctor_id = medical_personnel.id WHERE medical_procedures.id = ?');
            $query->bindParam(1,$procedure_id,PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
    //Show drugs from procedure
    public function getDrugsFromProcedure($procedure_id){
        try{
            $query = $this->mysql->prepare('SELECT * FROM medical_procedure_drugs WHERE medical_procedure_id = ?');
            $query->bindParam(1,$procedure_id,PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
    //Profile view
    public function get(){
        try{
            $query = $this->mysql->prepare('SELECT * FROM patients WHERE id = ?');
            $query->bindParam(1,$this->id,PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);

        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }
    //Session control
    public function getLogInInfo(){
        try{
            $query = $this->mysql->prepare('SELECT *
                                        FROM users where users.email = ?;');
            $query->bindParam(1, $this->email, PDO::PARAM_STR);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }
    
}

?>

