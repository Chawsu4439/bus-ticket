
<?php

class ScheduleController extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('ScheduleModel');
        $this->db = new Database();
    }

    public function schedule()
    {

        // Fetch all schedules
        $schedules = $this->db->readAll('bus_schedule_info');

        // Prepare an array to store schedule IDs that have bookings
        // $scheduledWithBookings = [];

        // Check which schedules have bookings
        // foreach ($schedules as $schedule) {
        //     // Fetch bookings for the current schedule
        //     $bookings = $this->db->getByColumnValue('bookings',  $schedule['schedule_id'], "schedule_id");
        //     // var_dump($bookings);
        //     // die();

        //     // Check if there are any bookings for the current schedule
        //     $scheduledWithBookings[$schedule['schedule_id']] = !empty($bookings);
        // }

        // Fetch buses data
        $buses = $this->db->readAll('buses');

        // Fetch routes data
        $routes = $this->db->readAll('routes');

        // Prepare data for the view
        $data = [
            'schedules' => $schedules,
            'buses' => $buses,
            'routes' => $routes,
            // 'scheduledWithBookings' => $scheduledWithBookings  // Pass this data to the view
        ];

        $this->view('admin/schedulelist/schedule', $data);
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $bus_id = $_POST['bus_id'];
            $route_id = $_POST['route_id'];
            $departure_time = $_POST['departure_time'];
            $arrival_time = $_POST['arrival_time'];

            $price_per_seat = $_POST['price_per_seat'];

            // echo($price);
            // exit;

            $schedule = new ScheduleModel();


            $schedule->setBusId($bus_id);
            $schedule->setRouteId($route_id);
            $schedule->setDepartureTime($departure_time);
            $schedule->setArrivalTime($arrival_time);

            $schedule->setPricePerSeat($price_per_seat);
            $schedule->setDate(Date('Y-m-d H:i:s'));

            $scheduleCreated = $this->db->create('schedules', $schedule->toArray());

            setMessage('success', 'Create schedule successful!');
            redirect('ScheduleController/schedule');
        }
    }

    public function edit($id)
    {
        $schedule = $this->db->getById('schedules', $id);
        $buses = $this->db->readAll('buses');
        $routes = $this->db->readAll('routes');

        $data = [
            'schedules' => $schedule,
            'buses' => $buses,
            'routes' => $routes
        ];

        $this->view('admin/schedulelist/schedule', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['schedule_id'];
            $bus_id = $_POST['bus_id'];
            $route_id = $_POST['route_id'];
            $departure_time = $_POST['departure_time'];
            $arrival_time = $_POST['arrival_time'];

            $price_per_seat = $_POST['price_per_seat'];


            $schedule = new ScheduleModel();
            $schedule->setId($id);
            $schedule->setBusId($bus_id);
            $schedule->setRouteId($route_id);
            $schedule->setDepartureTime($departure_time);
            $schedule->setArrivalTime($arrival_time);

            $schedule->setPricePerSeat($price_per_seat);
            $schedule->setDate(Date('Y-m-d H:i:s'));

            $scheduleUpdated = $this->db->update('schedules', $schedule->getId(), $schedule->toArray());

            setMessage('success', 'Update schedule successful!');
            redirect('ScheduleController/schedule');
        }
    }


    public function destroy($id)
    {

        $id = base64_decode($id); // Decode the base64-encoded ID
        $schedule = new ScheduleModel();
        $schedule->setId($id);

        $ScheduleDeleted = $this->db->delete('schedules', ['id' => $id]);


if ($ScheduleDeleted) {
            setMessage('success', 'Delete Bus successful!');
        } else {
            setMessage('error', 'Delete Bus failed!');
        }

        redirect('ScheduleController/schedule');
    }


    public function getPrice($schedule_id)
    {
        $schedule = $this->db->getById('schedules', $schedule_id);
        if ($schedule) {
            echo json_encode(['price_per_seat' => $schedule['price_per_seat']]);
        } else {
            echo json_encode(['error' => 'Schedule not found']);
        }
    }
}