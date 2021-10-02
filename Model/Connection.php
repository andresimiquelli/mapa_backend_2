<?php

abstract class Connection {
    
    protected function getConnection()
    {
        try{
            $conn = new PDO("mysql:host=localhost;dbname=mapa_ii", "root", "");
            return $conn;
        }catch(PDOException $e){
            die($e->getMessage());
        }        
    }
}