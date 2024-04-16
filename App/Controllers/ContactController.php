<?php 

namespace App\Controllers;

 use  App\Helpers\Validator;
use App\Models\ContactModel;
use App\Services\ContactServices;

class ContactController
{

    public function list()
    {
        $contact_services = new ContactServices();
        $result = $contact_services->getAllActiveContact(); 

        return ['status'=>200,'message'=>$result]; 
    }
    public function detail($data)
    {
        $validator =new Validator();
        $message_error = $validator->validateInputs($data,['id_contact']);
        if(!empty($message_error)){
            return  ['status'=>500,'message'=>$message_error['message']];
        }
        $id_contact =$data['id_contact'];
        $contact_services = new ContactServices();
        $result = $contact_services->getDetailContact($id_contact);
        return ['status'=>200,'message'=>$result]; 
    }
    public function create($data)
    {
        $validator = new Validator(); 
        $message_error = $validator->validateModel(new ContactModel(),$data);
        if(!empty($message_error)){
            return  ['status'=>500,'message'=>$message_error['message']];
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
    public function addPhoneContact($data)
    {
        $validator =new Validator();
        $message_error = $validator->validateInputs($data,['id_contact','phone']);
        if(!empty($message_error)){
            return  ['status'=>500,'message'=>$message_error['message']];
        }
        $id_contact =$data['id_contact'];
        $phone =$data['phone'];
        $contact_services = new ContactServices();
        $result = $contact_services->addPhoneContact($id_contact,$phone);
        return ['status'=>200,'message'=>$result];  
    }
    public function delete($data)
    {
        $validator =new Validator();
        $message_error = $validator->validateInputs($data,['id_contact']);
        if(!empty($message_error)){
            return  ['status'=>500,'message'=>$message_error['message']];
        }
        $id_contact =$data['id_contact'];
        $contact_services = new ContactServices();
        $result = $contact_services->deleteContact($id_contact);
        return ['status'=>200,'message'=>$result]; 
    }
}