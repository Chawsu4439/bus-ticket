
<?php
require_once APPROOT . '/views/inc/header.php';


class UserScheduleController extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('ScheduleModel');
        $this->db = new Database();
    }


    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $source = $_POST['source'];
            $destination = $_POST['destination'];
            $date = $_POST['date'];

            // Retrieve all data from the bus_schedule_info view
            $schedules = $this->db->readAll('bus_schedule_info');

            // Filter schedules by source, destination, and date
            $filteredSchedules = array_filter($schedules, function ($schedule) use ($source, $destination, $date) {
                return $schedule['source'] == $source &&
                    $schedule['destination'] == $destination &&
                    date('Y-m-d', strtotime($schedule['departure_time'])) == $date;
            });

            $data = [
                'schedules' => $filteredSchedules
            ];

            $this->view('pages/userSchedule', $data);
        } else {
            // Retrieve all routes for the home page
            $routes = $this->db->readAll('routes');
            $data = [
                'routes' => $routes
            ];
            $this->view('pages/home', $data);
        }
    }


    public function chooseSeats()
    {
        // print_r("hello");
        // exit;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ensure schedule_id is set and valid
            if (!isset($_POST['schedule_id']) || empty($_POST['schedule_id'])) {
                die('Invalid request: schedule_id is missing.');
            }

            $schedule_id = $_POST['schedule_id'];

            // Retrieve the schedule information
            $schedules = $this->db->readAll('bus_schedule_info');
            $schedule = array_filter($schedules, function ($schedule) use ($schedule_id) {
                return $schedule['schedule_id'] == $schedule_id;
            });

            if (empty($schedule)) {
                die('Schedule not found.');
            }

            $schedule = array_values($schedule)[0];

            // Retrieve bus information
            $buses = $this->db->readAll('buses');
            $bus = array_filter($buses, function ($bus) use ($schedule) {
                return $bus['name'] == $schedule['bus_name'];
            });

            if (empty($bus)) {
                die('Bus not found.');
            }

            $bus = array_values($bus)[0];
            // Fetch seats for the specific bus that are available
            $seats = $this->db->readAll('seats'); // Assuming readAll fetches all seats

            // Filter seats by bus_id and status (assuming status column exists and is used for availability)
            $available_seats = array_filter($seats, function ($seat) use ($bus) {
                return $seat['bus_id'] == $bus['id'];
            });

            $data = [
                'schedule' => $schedule,
                'capacity' => $bus['capacity'],
                'bus_name' => $bus['name'],
                'seats' => $available_seats,

            ];

            $this->view('pages/chooseSeat', $data);
        } else {
            die('Invalid request.');
        }
    }



    // UserScheduleController.php

    public function book()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userId = null;

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
            }
            $user = $this->db->getById('users', $userId);

            $schedule_id = $_POST['schedule_id'];
            // $booking_id = $_POST['booking_id'];

            // Fetch the selected seats
            $selected_seats = $_POST['seats'] ?? [];
            $qty = count($selected_seats);


// Retrieve schedule and bus information again
            $schedules = $this->db->readAll('bus_schedule_info');
            $schedule = array_filter($schedules, function ($schedule) use ($schedule_id) {
                return $schedule['schedule_id'] == $schedule_id;
            });
            $schedule = array_values($schedule)[0];

            $buses = $this->db->readAll('buses');
            $bus = array_filter($buses, function ($bus) use ($schedule) {
                return $bus['name'] == $schedule['bus_name'];
            });
            $bus = array_values($bus)[0];

            // Calculate total price
            $price_per_seat = $schedule['price_per_seat'];
            $total_price = $qty * $price_per_seat;

            // // Retrieve schedule and bus information again
            // $bookings = $this->db->readAll('booking_info');
            // $booking = array_filter($bookings, function ($booking) use ($booking_id) {
            //     return $booking['booking_id'] == $booking_id;
            // });
            // $booking = array_values($booking)[0];
            // Fetch user data
            // $users = $this->db->readAll('users');
            // $user = array_filter($users, function ($user) use ($booking) {
            //     return $user['id'] == $booking['user_id'];
            // });
            // $user = array_values($user)[0];
            // Assuming you have a bookings table or model to insert booking data
            // Insert booking data into the database
            // Example: $this->BookingModel->insertBooking($schedule_id, $selected_seats, $qty, $total_price);

            // Prepare data to pass to confirmation view
            $data = [
                'schedule' => $schedule,
                'bus' => $bus,
                'selected_seats' => $selected_seats,
                'qty' => $qty,
                'total_price' => $total_price,
                'user' => $user
            ];

            $this->view('pages/tripSummary', $data); // Display booking confirmation
        } else {
            die('Invalid request.');
        }
    }


    // UserScheduleController.php


}