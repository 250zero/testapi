<?php 

namespace App\Controllers;

 use  App\Helpers\Validator;
 use App\Models\ContactModel;
use App\Services\ContactServices;

class ContactController{

    public function list(){
        $contact_services = new ContactServices();
        $result = $contact_services->getAllActiveContact(); 

        return ['status'=>200,'message'=>$result]; 
    }
    public function detail($data){
        $contact_model = new ContactModel();
        $result = $contact_model->getAll();
        return ['status'=>200,'message'=>$result]; 
    }
    public function create($data){
        $validator = new Validator(); 
        $mensajes = $validator->validateModel(new ContactModel(),$data);
        if(!empty($mensajes)){
            return  ['status'=>500,'message'=>$mensajes['message']];
        } 
        $contact_services = new ContactServices();
        $id = $contact_services->createContact($data);
        if(!empty($id)){
            return  ['status'=>201,'message'=>'Contacto Creado con exito'] ; 
        }else{
            return  ['status'=>500,'message'=>'Error al tratar de crear el contacto'] ; 

        }
        return  ['status'=>200,'message'=>$data] ; 
    }
    public function addPhoneContact($data){
        return  ['status'=>200,'message'=>'Ok']; 
    }
    public function delete($data){
        return ['status'=>200,'message'=>'Ok']; 
    }
}