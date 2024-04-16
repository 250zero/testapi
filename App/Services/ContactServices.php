<?php

namespace App\Services;

use App\Helpers\ReadEnvFile;
use App\Models\ContactModel;
use App\Models\TelephoneModel;

class ContactServices
{
    public function getAllActiveContact()
    {
        $contact = new ContactModel();
        $resultContact =  $contact->getAll([], ['status' => 1]);
        $result = [];
        if (!empty($resultContact)) {

            while ($row = $resultContact->fetch_assoc()) {
                $telephone = new TelephoneModel();
                $resultPhone = $telephone->getAllTelephoneContact([], ['id_contact' => $row['id_contact']]);
                $resultPhoneContact = [];

                while ($rowPhone = $resultPhone->fetch_assoc()) {
                    $resultPhoneContact[] = $rowPhone['phone_number'];
                }

                $result[] = [
                    'name' => $row['name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'telephone' => $resultPhoneContact
                ];
            }
        }
        return $result;
    }
    public function getDetailContact($id_contact)
    {
        $contact = new ContactModel();
        $resultContact =  $contact->getAll([], ['id_contact' => $id_contact]);
        $result = [];
        if (!empty($resultContact)) {
            while ($row = $resultContact->fetch_assoc()) {
                $telephone = new TelephoneModel();
                $resultPhone = $telephone->getAllTelephoneContact([], ['id_contact' => $id_contact]);
                $resultPhoneContact = [];

                while ($rowPhone = $resultPhone->fetch_assoc()) {
                    $resultPhoneContact[] = $rowPhone['phone_number'];
                }

                $result  = [
                    'name' => $row['name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'telephone' => $resultPhoneContact
                ];
            }
        }

        return $result;
    }
    public function createContact($data)
    {
        $contact = new ContactModel();
        $contact->name = $data['name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->save();
        if (!empty($data['telephone'])) {
            foreach ($data['telephone'] as $phone) {
                $telephone = new TelephoneModel();
                $telephone->id_contact = $contact->id_contact;
                $telephone->phone_number = $phone;
                $telephone->save();
            }
        }
        return  $contact->id_contact;
    }
    public function deleteContact($id_contact)
    {
        $contact = new ContactModel();
        $allow_delete = ReadEnvFile::getEnvValueByKey('ALLOW_DELETE'); 

        $contact->id_contact =  $id_contact;
        if (!empty($allow_delete)) {
            $result = $contact->delete();
        } else {
            $contact->status =  0;
            $resultContact =  $contact->getAll([], ['id_contact' => $id_contact]);
            $result = [];
            if (!empty($resultContact)) {
                while ($row = $resultContact->fetch_assoc()) { 
                    $contact->name =  $row['name'];
                    $contact->last_name =  $row['last_name'];
                    $contact->email =  $row['email'];                        
                }
            }
            $result = $contact->save(); 
        }
        if (!empty($result)) {
            return 'Contacto eliminado con exito';
        }
        return 'El contacto no pudo ser eliminado';
    }
}
