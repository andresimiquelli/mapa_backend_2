<?php

require_once('Connection.php');
require_once('IModel.php');

class Course extends Connection implements IModel{

    private $conn;
    private $table;
    
    private 
        $id, 
        $nameCourse, 
        $description, 
        $dateStart, 
        $dateFinish, 
        $status, 
        $createdAt, 
        $updatedAt;
    

    public function __construct()
    {
        $this->conn = $this->getConnection();
        $this->table = "course";
    }

    public function fill($data)
    {
        $this->id = $data['id'];
        $this->nameCourse = $data['nameCourse'];
        $this->description = $data['description'];
        $this->dateStart = $data['dateStart'];
        $this->dateFinish = $data['dateFinish'];
        $this->status = $data['status'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
    }

    public function findAll()
    {
        $sql = "SELECT * FROM ".$this->table." ORDER BY nameCourse ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE id=:ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':ID' => $id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($result) > 0){
            $this->fill($result[0]);
        }

        return $result;
    }

    public function search($data)
    {
        $sql = "SELECT * FROM ".$this->table."  WHERE status = :STATUS AND nameCourse LIKE :NAME";
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute($data);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        return $result;
    }

    public function save()
    {
        if($this->id > 0){
            return $this->update();
        }else{
            return $this->insert();
        }
    }

    private function insert()
    {
        $sql = "INSERT INTO ".$this->table
        ."(nameCourse, description, dateStart, dateFinish, status) "
        ."VALUES(:NAME_COURSE, :DESCRIPTION, :DATE_START, :DATE_FINISH, :STATUS)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute(array(
            ':NAME_COURSE' => $this->nameCourse,
            ':DESCRIPTION' => $this->description,
            ':DATE_START' => $this->dateStart,
            ':DATE_FINISH' => $this->dateFinish,
            ':STATUS' => $this->status
        ));

        if($stmt->rowCount()>0)
            return true;
        else
            return false;
    }

    private function update()
    {
        $sql = "UPDATE ".$this->table
        ." SET nameCourse = :NAME_COURSE, 
        description = :DESCRIPTION, 
        dateStart = :DATE_START, 
        dateFinish = :DATE_FINISH, 
        status = :STATUS 
        WHERE id = :ID";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute(array(
            ':NAME_COURSE' => $this->nameCourse,
            ':DESCRIPTION' => $this->description,
            ':DATE_START' => $this->dateStart,
            ':DATE_FINISH' => $this->dateFinish,
            ':STATUS' => $this->status,
            ':ID' => $this->id
        ));

        if($stmt->rowCount()>0)
            return true;
        else
            return false;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ".$this->table." WHERE id = :ID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(":ID" => $id));

        if($stmt->rowCount()>0)
            return true;
        else
            return false;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNameCourse($name)
    {
        $this->nameCourse = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setDateStart($date)
    {
        $this->dateStart = $date;
    }

    public function setDateFinish($date)
    {
        $this->dateFinish = $date;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNameCourse()
    {
        return $this->nameCourse;
    }

    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function getDateFinish()
    {
        return $this->dateFinish;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}