<?php

namespace App\Services;

use App\Models\ContactModel;

class ContactServices{
    public function getAllActiveContact()
    {
        $contact = new ContactModel();
        $result = $contact->getAll([],['status'=>1]);
    }
}