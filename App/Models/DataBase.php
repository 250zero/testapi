<?php 

namespace App\Models;

use App\Helpers\ReadEnvFile;
use mysqli;

class DataBase{
    private $conecction;
    private $hostname ;
    private $user ;
    private $pass ;
    private $database ;
    private $port ;

    public function __construct()
    {
        $this->hostname = ReadEnvFile::getEnvValueByKey('DB_HOST');
        $this->user = ReadEnvFile::getEnvValueByKey('DB_USERNAME');
        $this->pass = ReadEnvFile::getEnvValueByKey('DB_PASSWORD');
        $this->database = ReadEnvFile::getEnvValueByKey('DB_DATABASE');
        $this->port = ReadEnvFile::getEnvValueByKey('DB_PORT');
        $this->connect();
    }
    private function connect() {
        $this->conecction =  new mysqli($this->hostname,$this->user,$this->pass,$this->database,$this->port);
        if ($this->conecction->connect_error) {
            print_r(  $this->conecction->connect_error);
        }
    }
    protected function execQuery($query)
    {
        if (!empty($this->conecction->connect_errno )) {
            $this->connect();
        }
        $result = $this->conecction->query($query);
        if(!empty($result)){
            print_r($this->conecction->error);  
        }
        return $result;
    }
    
    protected function executeInsertQuery($query)
    {
        $result = $this->conecction->query($query); 
        if(!empty($result)){
            print_r($this->conecction->error);  
        }
        return  $this->conecction->insert_id; 
    }
     
    protected function closeConnection(){
        $this->conecction->close();
    }
}