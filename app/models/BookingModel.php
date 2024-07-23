<?php

class BookingModel {
    private $id;
    private $bus_id;
    private $route_id;
    private $customer_id;
    private $schedule_id;
    private $user_id;
    private $seat_id;
    private $booking_date;
    private $qty;
    private $total_price;
    private $status;

 
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setBusId($bus_id) {
        $this->bus_id = $bus_id;
    }

    public function getBusId() {
        return $this->bus_id;
    }

    public function setRouteId($route_id) {
        $this->route_id = $route_id;
    }

    public function getRouteId() {
        return $this->route_id;
    }

    public function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function getCustomerId() {
        return $this->customer_id;
    }

    public function setScheduleId($schedule_id) {
        $this->schedule_id = $schedule_id;
    }

    public function getScheduleId() {
        return $this->schedule_id;
    }

    public function setUserId($user_id) {
        $this->schedule_id = $user_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setSeatId($seat_id) {
        $this->seat_id = $seat_id;
    }

    public function getSeatId() {
        return $this->seat_id;
    }

    public function setBookingDate($booking_date) {
        $this->booking_date = $booking_date;
    }

    public function getBookingDate() {
        return $this->booking_date;
    }

    public function setQty($qty) {
        $this->qty = $qty;
    }

    public function getQty() {
        return $this->qty;
    }
    
    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }
    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

 

    public function toArray() {
        return [
            "bus_id" => $this->getBusId(),
            "route_id" => $this->getRouteId(),
            "customer_id" => $this->getCustomerId(),
            "schedule_id" => $this->getScheduleId(),
            "user_id" => $this->getUserId(),
            "seat_id" => $this->getSeatId(),
            "booking_date" => $this->getBookingDate(),
            "qty" => $this->getQty(),
            "total_price" => $this->getTotalPrice(),
            "status" => $this->getStatus(),
         
        ];
    }
}
?>