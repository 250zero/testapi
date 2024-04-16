<?php
namespace App\Models;

class ContactModel{
    public $id_contact;
    public $nombre;
    public $apellido;
    public $email;
    public $phones;
    public $require_filds = [
        'apellido',
        'email', 
    ];
}