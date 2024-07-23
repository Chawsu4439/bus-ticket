<?php
require_once APPROOT . '/views/inc/header.php';
class BookingController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->model('BookingModel');
        $this->db = new Database();
    }

    public function booking()
    {
        $booking = $this->db->readAll('booking_info');

        // $customer = $this->db->readAll('customers');

        $bus = $this->db->readAll('buses');


        $route = $this->db->readAll('routes');

        $schedule = $this->db->readAll('schedules');

        // $user = $this->db->readAll('users');

        $data = [
            'booking_info' => $booking,
            // 'customers' => $customer,
            'buses' => $bus,
            'routes' => $route,
            'schedules' => $schedule,
            // 'users' => $user,
        ];
        $this->view('admin/bus/booking', $data);
    }
    // Method to store a new booking
    // Method to store a new booking
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $bus_id = $_POST['bus_id'];
            $route_id = $_POST['route_id'];
            $schedule_id = $_POST['schedule_id'];
            $user_id = $_POST['user_id'];
            $customer_id = $_POST['customer_id'];
            $selected_seats = explode(',', $_POST['selected_seats']);
            $qty = $_POST['qty'];
            $total_price = $_POST['total_price'];
            $booking_date = date('Y-m-d H:i:s');
            $status = 'booked'; // Default status

            // Customer information

        
        

            $user = $this->db->readAll('users', ['id' => $user_id]);
            if (!$user) {
                setMessage('error', 'User does not exist.');
                // Redirect or handle the error as needed
                return;
            }
            $customer_name= $_POST['name'];
            $customer_phone = $_POST['phone'];
            
            // Insert customer data
            $customer_id = $this->db->create('customers', [

                'name' => $customer_name,
                'phone' => $customer_phone,
               
            ]);

            if (!$customer_id) {
                setMessage('error', 'Failed to create customer.');
                //  redirect('pages/home');
                return;
            }


            // Insert booking data
            $booking_id = $this->db->create('bookings', [
                'bus_id' => $bus_id,
                'route_id' => $route_id,
                'customer_id' => $customer_id,
                'schedule_id' => $schedule_id,
                'user_id' => $user_id,
                'booking_date' => $booking_date,
                'qty' => $qty,
                'total_price' => $total_price,
                'status' => $status
            ]);

            if (!$booking_id) {
                setMessage('error', 'Failed to create booking.');
                //  redirect('pages/home');
                return;
            }

            // Insert selected seats
            foreach ($selected_seats as $seat_number) {
                $seat_id = $this->db->create('seats', [
                    'bus_id' => $bus_id,
                    'seat_number' => $seat_number,
                    'booking_id' => $booking_id,
                    'status' => 'booked'
                ]);

                if (!$seat_id) {
                    setMessage('error', 'Failed to create booking.');
                    //  redirect('pages/home');
                    return;
                }
                // Link seats to the booking
                //  $this->db->create('booking_info', [
                //      'booking_id' => $booking_id,
                //      'selected_seats' => $seat_number
                //  ]);
            }

            setMessage('success', 'Booking created successfully!');
            redirect('pages/bookSuccess');
        }
    }
    // public function edit($id)
    // {
    //     $booking = $this->db->getById('bookings', $id);
    //     $buse = $this->db->readAll('buses');
    //     $route = $this->db->readAll('routes');
    //     $schedule= $this->db->readAll('schdules');

    //     $data = [
    //         'bookings' => $booking,
    //         'buses' => $buse,
    //         'routes' => $route,
    //         'schedules' => $schedule,
    //     ];

    //     $this->view('admin/bus/booking', $data);
    // }

    // public function update()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Get POST data
    //         $booking_id = $_POST['booking_id'];
    //         $user_name = $_POST['user_name'];
    //         $user_email = $_POST['user_email'];
    //         $customer_phone = $_POST['customer_phone'];
    //         $customer_name = $_POST['customer_name'];
    //         $bus_id = $_POST['bus_id'];
    //         $route_id = $_POST['route_id'];
    //         $schedule_id = $_POST['schedule_id'];
    //         $booking_date = $_POST['booking_date'];
    //         $qty = $_POST['qty'];
    //         $total_price = $_POST['total_price'];
    //         $status = $_POST['status'];
    
    //         // Validate required fields
    //         if (!$booking_id) {
    //             setMessage('error', 'Booking ID is required.');
    //             redirect('BookingController/booking');
    //             return;
    //         }
    
    //         // Retrieve booking details to get the associated customer ID
    //         $booking = $this->db->getById('bookings', $booking_id);
    
    //         if (!$booking) {
    //             setMessage('error', 'Booking not found.');
    //             redirect('BookingController/booking');
    //             return;
    //         }
    
    //         // Retrieve the customer ID from the booking
    //         $customer_id = $booking['customer_id'];
    
    //         if (!$customer_id) {
    //             setMessage('error', 'Customer ID not found in the booking.');
    //             redirect('BookingController/booking');
    //             return;
    //         }
    
    //         // Update customer information
    //         $customerUpdated = $this->db->update('customers', $customer_id, [
    //             'phone' => $customer_phone,
    //             'name' => $customer_name
    //         ]);
    
    //         if (!$customerUpdated) {
    //             setMessage('error', 'Failed to update customer.');
    //             redirect('BookingController/booking');
    //             return;
    //         }
    
    //         // Update user information
    //         $userUpdated = $this->db->update('users', $booking['user_id'], [
    //             'name' => $user_name,
    //             'email' => $user_email
    //         ]);
    
    //         if (!$userUpdated) {
    //             setMessage('error', 'Failed to update user.');
    //             redirect('BookingController/booking');
    //             return;
    //         }
    
    //         // Update booking information
    //         $bookingUpdated = $this->db->update('bookings', $booking_id, [
    //             'bus_id' => $bus_id,
    //             'route_id' => $route_id,
    //             'schedule_id' => $schedule_id,
    //             'schedule_id' => $schedule_id,
    //             'booking_date' => $booking_date,
    //             'qty' => $qty,
    //             'total_price' => $total_price,
    //             'status' => $status
    //         ]);
    
    //         if ($bookingUpdated) {
    //             setMessage('success', 'Booking updated successfully!');
    //         } else {
    //             setMessage('error', 'Failed to update booking.');
    //         }
    
    //         redirect('BookingController/booking');
    //     } else {
    //         setMessage('error', 'Invalid request method.');
    //         redirect('BookingController/booking');
    //     }
    // }
    

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $booking_id = $_POST['booking_id'];

            if ($this->db->delete('bookings', ['id' => $booking_id])) {
                setMessage('success', 'Booking deleted successfully!');
            } else {
                setMessage('error', 'Failed to delete booking.');
            }

            redirect('bookingController/booking');
        }
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $source = $_POST['source'];
            $destination = $_POST['destination'];
            $date = $_POST['date'];

            $schedules = $this->db->readAll('schedules');
            $routes = $this->db->readAll('routes');


// Filter schedules by source, destination, and date
            $filteredSchedules = [];
            foreach ($schedules as $schedule) {
                foreach ($routes as $route) {
                    if (
                        $route['id'] == $schedule['route_id'] &&
                        $route['source'] == $source &&
                        $route['destination'] == $destination &&
                        date('Y-m-d', strtotime($schedule['departure_time'])) == $date
                    ) {
                        $filteredSchedules[] = $schedule;
                    }
                }
            }

            $data = [
                'schedules' => $filteredSchedules
            ];

            $this->view('pages/home', $data);
        }
    }

    public function history()
{
    // Assuming user is logged in and user_id is stored in session
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page or show an error message if user_id is not set in session
        redirect('users/login');
        return;
    }

    $user_id = $_SESSION['user_id'];
 
    // Get all bookings
    $bookings = $this->db->readAll('booking_history');
    // var_dump($bookings);

    // Filter bookings made by the user in the last 24 hours
    $recentBookings = array_filter($bookings, function ($booking) use ($user_id) {
        return $booking['user_id'] == $user_id && strtotime($booking['booking_date']) >= strtotime('-1 day');
    });
    // var_dump($recentBookings);
    // exit;
    // Prepare data for the view
    $data = [
        'bookings' => $recentBookings
    ];

    $this->view('pages/history', $data);
}
}