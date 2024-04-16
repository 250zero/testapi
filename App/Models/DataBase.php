<?php 

namespace App\Models;

use App\Helpers\ReadEnvFile;
use mysqli;

class DataBase{
    private $conecction;

    public function __construct()
    {
        $hostname = ReadEnvFile::getEnvValueByKey('DB_HOST');
        $user = ReadEnvFile::getEnvValueByKey('DB_USERNAME');
        $pass = ReadEnvFile::getEnvValueByKey('DB_PASSWORD');
        $database = ReadEnvFile::getEnvValueByKey('DB_DATABASE');
        $port = ReadEnvFile::getEnvValueByKey('DB_PORT');
        $this->conecction = new mysqli($hostname,$user,$pass,$database,$port);
        if($this->conecction->connect_error){
            print_r($this->conecction->connect_error); 
        }
    }
    protected function execQuery($query)
    {
        $result = $this->conecction->query($query);
        if(!empty($result)){
            print_r($this->conecction->error);  
        }
        return $result;
    }
    protected function closeConnection(){
        $this->conecction->close();
    }
}