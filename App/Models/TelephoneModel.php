<?php

namespace App\Models;

class TelephoneModel extends DataBase{
    public $id_contact;
    public $id_phone;
    public $phone_number;
    public function getAllTelephoneContact($params =[],$where =[]){
        $attributes = ['phone_number' ];
        $query = "";
        if(empty($params)){
            $query =  "SELECT ".implode(',', $attributes); 
        }else{
            $query =  "SELECT ".implode(',', $params); 
        } 
        $query .= " FROM telephone ";

        if(!empty($where)){
            foreach ($where as $key => $value) {
                $conditionsStrings[] = "$key = '$value'";
            }
            $query .= " WHERE ".implode(' AND ', $conditionsStrings);
        } 
        $result =  $this->execQuery($query);
        $this->closeConnection();
        return $result;
    }
    public function save(){
        $query = "INSERT INTO telephone (id_contact,phone_number)  values ('{$this->id_contact}','{$this->phone_number}')";
        $this->id_phone =  $this->executeInsertQuery($query);
        $this->closeConnection();
        return $this->id_phone;
    }
    public function delete(){
        $query = "DELETE FROM telephone WHERE id_phone ='{$this->id_phone}' and id_contact='{$this->id_contact}";
        $result =  $this->execQuery($query);
        $this->closeConnection();
        return $result;
    }
}