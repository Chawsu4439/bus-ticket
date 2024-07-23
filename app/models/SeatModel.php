<?php
class SeatModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $bus_id;
    private $seat_number;
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

    public function setBusId($bus_id)
    {
        $this->bus_id = $bus_id;
    }

    public function getBusId()
    {
        return $this->bus_id;
    }

    public function setSeatNumber($seat_number)
    {
        $this->seat_number = $seat_number;
    }

    public function getSeatNumber()
    {
        return $this->seat_number;
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

    public function toArray()
    {
        return [
            "bus_id" => $this->getBusId(),
            "seat_number" => $this->getSeatNumber(),
            "status" => $this->getStatus(),
            "date" => $this->getDate(),
           
        ];
    }
}