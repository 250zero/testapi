<?php
namespace App\Models;

class ContactModel extends DataBase{
    public $id_contact;
    public $name;
    public $last_name;
    public $email;
    public $telephones;
    public $require_filds = [
        'name',
        'last_name', 
        'email', 
    ];
    public function getAll($params =[],$where =[]){
        $attributes = ['id_contact','name','last_name','email'];
        $query = "";
        if(empty($params)){
            $query =  "SELECT ".implode(',', $attributes); 
        }else{
            $query =  "SELECT ".implode(',', $params); 
        } 
        $query .= " FROM contact ";

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
        $attributes = [ 'name'=>$this->name,'last_name'=>$this->last_name,'email'=>$this->email];

        if(!empty($this->id_contact)){
            foreach ($attributes as $key => $value) {
                $conditionsUpdate[] = "$key = '$value'";
            }
            $query = 'UPDATE contact set '.implode(',', $conditionsUpdate).' WHERE id_contact = '.$this->id_contact; 
            $result =  $this->execQuery($query);
            $this->closeConnection();
            return $result;
        }else{
            foreach ($attributes as $key => $value) {
                $conditionsInsert[] = "'$attributes[$key]'";
                 
            }
            $query = 'INSERT INTO contact ('.implode(',',array_keys($attributes)).',status) values ('.implode(',', $conditionsInsert).',1)'; 
            $this->id_contact =  $this->executeInsertQuery($query);
            $this->closeConnection();
            return $this->id_contact;
        }
    }

    public function delete(){
        $query = 'DELETE FROM contact WHERE id_contact = '.$this->id_contact;
        $result =  $this->execQuery($query);
        $this->closeConnection();
        return $result;
    }
}