<?php

class RoutesController extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('RoutesModel');

        $this->db = new Database();
    }

    public function route()
    {
        $route = $this->db->readAll('routes');
        $data = [
            'routes'=>$route
        ];
        $this->view('admin/bus/route',$data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $source= $_POST['source'];
           
            $destination = $_POST['destination'];

  
            
            // echo($name);
            // echo($bus_number);
            // exit;
            $route = new RoutesModel();

            $route->setSource($source);
            $route-> setDestination($destination);
            $route->setDate(date('Y-m-d H:i:s'));
         
     

            $RoutesCreated = $this->db->create('routes', $route->toArray());
            // echo($busCreated);
            // exit;
            setMessage('success', 'Create Bus successful!');
            redirect('RoutesController/route');
        }
    }

    public function edit($id)
    {
        $route = $this->db->readAll('routes', $id);
        $data = [
            'routes' => $route
        ];
        $this->view('admin/bus/route', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $id = $_POST['id'];
            $source = $_POST['source'];
            $destination = $_POST['destination'];

            $route = new RoutesModel();
            $route->setId($id);
            $route->setSource($source);
            $route->setDestination($destination);
            $route->setDate(date('Y-m-d H:i:s'));

            $isUpdated = $this->db->update('routes', $route->getId(), $route->toArray());
            if ($isUpdated) {
                setMessage('success', 'Route update successful!');
            } else {
                setMessage('error', 'Failed to update route.');
            }
            redirect('RoutesController/route');
        }
    }

    public function destroy($id)
    {

        $id = base64_decode($id); // Decode the base64-encoded ID
        $route = new RoutesModel();
        $route->setId($id);
    
        $RoutesDeleted = $this->db->delete('routes', ['id' => $id]);

        if ($RoutesDeleted) {
            setMessage('success', 'Delete Bus successful!');
        } else {
            setMessage('error', 'Delete Bus failed!');
        }
        
        redirect('RoutesController/route');
    }

}