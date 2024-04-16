<?php

namespace App\Helpers;


class ReadEnvFile
{
    public static function  getEnvValueByKey($key)
    {
        $dotenv_path =  __DIR__ . '/../.env'; 
        $dotenv_content = file_get_contents($dotenv_path); 
        $lines = explode("\n", $dotenv_content);
 
        foreach ($lines as $line) {  
            if(($line)>2){ 
                list($envKey, $value) = explode('=', $line, 2); 
                if(!empty($envKey)){ 
                    $envKey = trim($envKey);
                    $value = trim($value); 
                    if ($envKey === $key) {
                        return $value;
                    }
                }
            }
        }
        return ''; 
    }
}
