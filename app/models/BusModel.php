<?php

class BusModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $name;
    private $bus_number;
    private $capacity;
 
    private $status;
    private $date;

    public function setId($id)
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

    public function setBusNumber($bus_number)
    {
        $this->bus_number = $bus_number;
    }
    public function getBusNumber()
    {
        return $this->bus_number;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }
    public function getCapacity()
    {
        return $this->capacity;
    }




    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getDate()
    {
        return $this->date;
    }
   

    public function toArray() {
        return [
            "name" => $this->getName(),
            "bus_number" => $this->getBusNumber(),
            "capacity" => $this->getCapacity(),
         
            "status" => $this->getStatus(),
            "date" => $this->getDate(),
        ];
    }
}