<?php 

class ContactController{
    public function list(){
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
    public function detail(){
        return json_encode([
            'nombre'=>'bony',
            'apellido'=>'clade',
            'telefonos'=>
            [
                '809-9998-9999',
                '5655666666',
                '568566865'
            ]
            ]);
    }
}