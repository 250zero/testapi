<?php 

namespace App\Controllers;

 use  App\Helpers\Validator;
 use App\Models\ContactModel;
 
class ContactController{
    public function list(){
        $contact_model = new ContactModel();
        $result = $contact_model->getAll();
        return ['status'=>200,'message'=>$result];
        return json_encode([
            [
                'nombre'=>'adalberto',
                'apellido'=>'turby',
                'telefonos'=>
                [
                    '809-9998-9999',
                    '5655666666',
                    '568566865'
                ]
            ],
            [
                'nombre'=>'bony',
                'apellido'=>'clade',
                'telefonos'=>
                [
                    '809-9998-9999',
                    '5655666666',
                    '568566865'
                ]
            ],
        ]);
    }
    public function detail($data){
        $contact_model = new ContactModel();
        $result = $contact_model->getAll();
        return ['status'=>200,'message'=>$result];
        // return [
        //     'nombre'=>'bony',
        //     'apellido'=>'clade',
        //     'telefonos'=>
        //     [
        //         '809-9998-9999',
        //         '5655666666',
        //         '568566865'
        //     ]
        //     ];
    }
    public function create($data){
        $validator = new Validator(); 
        $mensajes = $validator->validateModel(new ContactModel(),$data);
        if(!empty($mensajes)){
            return  ['status'=>500,'message'=>$mensajes['message']];
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