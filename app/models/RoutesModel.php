<?php

class RoutesModel
{
   
    // Access Modifier = public, private, protected
    private $id;
    private $source;
    private $destination;
    private $date;


    public function setId($id)
    {
        $this->id= $id;
    }
    public function getId()
    {
        return $this->id;
    }


    public function setSource($source)
    {
        $this->source= $source;
    }
    public function getSource()
    {
        return $this->source;
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;
    }
    public function getDestination()
    {
        return $this->destination;
    }

    public function setDate($date)
    {
        $this->date= $date;
    }
    public function getDate()
    {
        return $this->date;
    }

  

    public function toArray() {
        return [
            "source" => $this->getSource(),
            "destination" => $this->getDestination(),
            "date" => $this->getDate(),
   
        ];
    }
}