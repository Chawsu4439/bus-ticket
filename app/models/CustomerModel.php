<?php

class CustomerModel
{
    // Access Modifiers: public, private, protected
    private $id;
    private $name;
    // private $email;
    private $phone;
    private $date;

    
    public function setID($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    // public function setEmail($email)
    // {
    //     $this->email = $email;
    // }
    // public function getEmail()
    // {
    //     return $this->email;
    // }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function getPhone()
    {
        return $this->phone;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getDate()
    {
        return $this->date;
    }

    

    public function toArray()
    {
        return [
            "name" => $this->getName(),
            // "email" => $this->getEmail(),
            "phone" => $this->getPhone(),
            "date" => $this->getDate(),
 
        ];
    }
}