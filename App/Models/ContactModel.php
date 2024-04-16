<?php
namespace App\Models;

class ContactModel extends DataBase{
    public $id_contact;
    public $name;
    public $last_name;
    public $email;
    public $telephones;
    public $require_filds = [
        'apellido',
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
}