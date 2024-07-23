<?php

class CustomerController extends Controller
{
    private $customerModel;
    private $db;

    public function __construct()
    {
        $this->customerModel = $this->model('CustomerModel');
        $this->db = new Database();
    }

    // Method to list all customers
    public function customer()
    {
        $customers = $this->db->readAll('customers');
        $data = [
            'customers' => $customers
        ];
        $this->view('admin/bus/customer', $data);
    }

    // Method to store a new customer
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            // $email = $_POST['email'];
            $phone = $_POST['phone'];
            

            // Validate input
        if (empty($name) ||  empty($phone)) {
            $error = 'All fields are required';
            setMessage('error', $error);
            redirect('CustomerController/create');
        } else {
            // Check if email already exists
                $existingCustomer = $this->db->columnFilter('customers', 'phone', $phone);

                if ($existingCustomer) {
                    // If email exists, display an error message
                    setMessage('error', 'Email already exists');
                    redirect('CustomerController/create');
                } else {
                $customer = new CustomerModel();
                $customer->setName($name);
        
                $customer->setPhone($phone);
                $customer->setDate(date('Y-m-d H:i:s'));

                $customerCreated = $this->db->create('customers', $customer->toArray());

                if ($customerCreated) {
                    setMessage('success', 'Customer created successfully!');
                } else {
                    setMessage('error', 'Failed to create customer.');
                }
                redirect('CustomerController/customer');
            }
        }
    
    }
}
    // Method to edit a customer
    public function edit($id)
    {
        $customer = $this->db->readAll('customers', $id);
        if ($customer) {
            $data = [
                'customer' => $customer
            ];
            $this->view('admin/bus/customer', $data);
        } else {
            setMessage('error', 'Customer not found.');
            redirect('CustomerController/customer');
        }
    }

    // Method to update a customer
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            // $email = $_POST['email'];
            $phone = $_POST['phone'];

            $customer = new CustomerModel();
            $customer->setId($id);
            $customer->setName($name);
            // $customer->setEmail($email);
            $customer->setPhone($phone);
            $customer->setDate(date('Y-m-d H:i:s'));

            $isUpdated = $this->db->update('customers', $customer->getId(), $customer->toArray());
            if ($isUpdated) {
                setMessage('success', 'Customer updated successfully!');
            } else {
                setMessage('error', 'Failed to update customer.');
            }
            redirect('CustomerController/customer');
        }
    }

    // Method to delete a customer
    public function destroy($id)
    {
        $id = base64_decode($id); // Decode the base64-encoded ID
        $isDeleted = $this->db->delete('customers', ['id' => $id]);

        if ($isDeleted) {
            setMessage('success', 'Customer deleted successfully!');
        } else {
            setMessage('error', 'Failed to delete customer.');
        }

        redirect('CustomerController/customer');
    }
}
