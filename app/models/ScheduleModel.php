<?php

class ScheduleModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $bus_id;
    private $route_id;
    private $departure_time;
    private $arrival_time;
    private $price_per_seat;

    private $date;

    public function setId($id)
    {
        $this->id= $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setBusId($bus_id)
    {
        $this->bus_id= $bus_id;
    }
    public function getBusId()
    {
        return $this->bus_id;
    }

    public function setRouteId($route_id)
    {
        $this->route_id = $route_id;
    }
    public function getRouteId()
    {
        return $this->route_id;
    }

    public function setDepartureTime($departure_time)
    {
        $this->departure_time = $departure_time;
    }
    public function getDepartureTime()
    {
        return $this->departure_time;
    }

    public function setArrivalTime($arrival_time)
    {
        $this->arrival_time =  $arrival_time;
    }
    public function getArrivalTime()
    {
        return $this->arrival_time;
    }

 
    public function setPricePerSeat($price_per_seat)
    {
        $this->price_per_seat =  $price_per_seat;
    }
    public function getPricePerSeat()
    {
        return $this->price_per_seat;
    }
    public function setDate($date)
    {
        $this->date =  $date;
    }
    public function getDate()
    {
        return $this->date;
    }


   

    public function toArray() {
        return [
       
            "bus_id" => $this->getBusId(),
            "route_id" => $this->getRouteId(),
            "departure_time" => $this->getDepartureTime(),
            "arrival_time" => $this->getArrivalTime(),
  
            "price_per_seat" => $this->getPricePerSeat(),
            "date" => $this->getDate(),
        
        ];
    }

    


}