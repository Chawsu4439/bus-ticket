<?php

class BusController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('BusModel');
        $this->db = new Database();
    }

    public function index()
    {
        $bus = $this->db->readAll('buses');
        // $busWithBookings = $this->checkBusesWithBookings($bus);


        // Check which schedules have bookings
        $data = [
            'buses' => $bus,
            // "busWithBookings" => $busWithBookings
        ];
        $this->view('admin/bus/index', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $bus_number = $_POST['bus_number'];
            $capacity = $_POST['capacity'];
            $availab_seats = $_POST['available_seats'];
            $status = $_POST['status'];


            $bus = new BusModel();
            $bus->setName($name);
            $bus->setBusNumber($bus_number);

            $bus->setCapacity($capacity);
           
            $bus->setStatus($status);
            $bus->setDate(date('Y-m-d H:i:s'));

            $busCreated = $this->db->create('buses', $bus->toArray());

            if ($busCreated) {
                setMessage('success', 'Create Bus successful!');
            } else {
                setMessage('error', 'Failed to create bus.');
            }
            redirect('BusController/index');
        }
    }

    public function edit($id)
    {
        $bus = $this->db->getById('buses', $id);
        $data = [
            'buses' => $bus
        ];

        $this->view('admin/bus/index', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $bus_number = $_POST['bus_number'];
            $capacity = $_POST['capacity'];
            $availab_seats = $_POST['available_seats'];
            $status = $_POST['status'];


            $bus = new BusModel();
            $bus->setId($id);
            $bus->setName($name);
            $bus->setBusNumber($bus_number);
            $bus->setCapacity($capacity);
         
            $bus->setStatus($status);
            $bus->setDate(date('Y-m-d H:i:s'));

            $isUpdated = $this->db->update('buses', $bus->getId(), $bus->toArray());
            if ($isUpdated) {
                setMessage('success', 'Bus update successful!');
            } else {
                setMessage('error', 'Failed to update bus.');
            }
            redirect('BusController/index');
        }
    }

    public function destroy($id)
    {
        $id = base64_decode($id);
        $isDeleted = $this->db->delete('buses', ['id' => $id]);

        if ($isDeleted) {
            setMessage('success', 'Bus deleted successfully!');
        } else {
            setMessage('error', 'Failed to delete bus.');
        }

        redirect('BusController/index');
    }

    // private function hasBookings($busId)
    // {
    //     $bookings = $this->db->getByColumnValue('bookings', $busId, 'bus_id');
    //     return !empty($bookings);
    // }

    // // Method to check which buses have associated bookings
    // private function checkBusesWithBookings($buses)
    // {
    //     $busWithBookings = [];
    //     foreach ($buses as $bus) {
    //         $busWithBookings[$bus['id']] = $this->hasBookings($bus['id']);
    //     }
    //     return $busWithBookings;
    // }
}