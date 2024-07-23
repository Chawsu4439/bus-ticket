<?php
class dashboard extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();   
    }

    public function admin()
        {   
            $totalBuses = $this->db->getTotalCount('buses');
            $totalRoutes = $this->db->getTotalCount('routes');
            $totalBookings = $this->db->getTotalCount('bookings');
            $totalusers = $this->db->getTotalCount('users');
    
    
            $data = [
                'totalBuses' => $totalBuses,
                'totalRoutes' => $totalRoutes,
                'totalBookings' => $totalBookings,
                'totalUsers' => $totalusers,
            ];
    
            $this->view('admin/dashboard', $data);
        }
    
    public function logout(){
        $this->view('pages/login');
    }

   
   
}
