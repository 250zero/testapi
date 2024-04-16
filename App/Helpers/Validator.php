<?php 
namespace App\Helpers;


class Validator{
    private $_max_length;
    private $_min_length;

    public function __construct()
    { 
        $this->_max_length=ReadEnvFile::getEnvValueByKey("MAX_LENGTH");
        $this->_min_length=ReadEnvFile::getEnvValueByKey("MIN_LENGTH");
    }

    public function validateModel($model,$data ){ 
        $model_properties_key = $model->require_filds;
        $is_missing_models_key = array_diff($model_properties_key,array_keys($data));
        $error_message = [];

        if(!empty($is_missing_models_key)){
            $error_message .= 'Faltan los siguientes campos: ';
            foreach($is_missing_models_key as $missing){
                $error_message[] =  "El parametro '$missing' es requerido";
            }
        } 
        echo $this->_max_length.' asas';
        foreach($data as $propertie=>$propertie_value){
            if(!is_array( $data[$propertie] )){
                $propertie_length = strlen($propertie_value); 
                if($propertie_length <= $this->_min_length || $propertie_length >= $this->_max_length){
                    $error_message[] = "El parametro  '{$propertie}' con el valor '{$propertie_value}' no cumple con la logintud adecuada";
                } 
            }else{
                foreach($data[$propertie]  as $deep_propertie_value){
                    $propertie_length = strlen($deep_propertie_value);  
                    if($propertie_length <= $this->_min_length || $propertie_length >= $this->_max_length){
                        $error_message[] = "El parametro  '{$propertie}' con el valor '{$deep_propertie_value}' no cumple con la logintud adecuada";
                    } 
                }
            }
        }
        
        if(!empty($error_message)){ 
            return ['status'=>false,'message'=>$error_message];
        } 
    }
}