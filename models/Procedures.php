<?php
class Procedures{
	private $psql;
    private $mysql;

    //info
    private $id;
     

    public function __construct(Database $db){
        $this->mysql = new $db;
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
?>


