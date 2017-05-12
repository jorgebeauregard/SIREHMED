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


    public function __construct(Database $db){
        $this->mysql = new $db;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function save($n_id, $n_email, $n_pwd, $n_permit,$n_name,$n_last_name,$n_age,$n_height,$n_weight,$n_gender,$n_blood_type,$n_birthdate,$n_emergency_name,$n_emergency_phone,$n_body_mass_index){
        try{

            //First create user
            $query = $this->mysql->prepate('')


            //Then create patient
            $query = $this->mysql->prepare('INSERT INTO patients(
                name,last_name,age,height,weight,gender,blood_type,birth_date,
                emergency_name,emergency_phone,body_mass_index) VALUES (?,?,?,?,?,?,?,?,?,?,setBodyMassIndex(?,?))');
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
            $query->bindParam(11,$n_height, PDO::PARAM_STR);

        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function update($id,$n_name,$n_last_name,$n_age,$n_height,$n_weight,$n_gender,$n_blood_type,$n_birthdate,$n_emergency_name,$n_emergency_phone,$n_body_mass_index,$n_active){
        try{

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

            $this->mysql->close();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

     public function get(){
        //name,last_name,birth_date,age,gender,bloodtype,emergency contact name, emergency contact phone, bmi, height, weight
        try{

        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function getLogInInfo(){
        try{
            $query = $this->con->prepare('SELECT *
                                        FROM users where users.email = ?;');
            $query->bindParam(1, $this->email, PDO::PARAM_STR);
            $query->execute();
            $this->con->close();
            return $query->fetch(PDO::FETCH_OBJ);
        }
        catch(PDOException $e) {
            echo  $e->getMessage();
        }
    }
?>


