<?php

namespace App\Controllers;

use App\Models\UserModel;

class Main extends BaseController
{
    public function index()
    {
        return view('Main');
    }

    public function register()
    {
        $userModel = new UserModel();

        $data = [
            'FirstName'    => $this->request->getPost('Fname'),
            'LastName'     => $this->request->getPost('Lname'),
            'MiddleName'   => $this->request->getPost('Mname'),
            'BirthDate'    => $this->request->getPost('Bday'),
            'Gender'       => $this->request->getPost('Gender'),
            'EmailAddress' => $this->request->getPost('EmAdd'),
            'PhoneNumber'  => $this->request->getPost('PhNo'),
            'Address'      => $this->request->getPost('Addrs'),
            'Username'     => $this->request->getPost('Uname'),
            'Password'     => $this->request->getPost('Pwd'),
            'Departments'  => $this->request->getPost('Departments')
        ];

        $userModel->insert($data);

        return 'Registration successful!';
    }
}