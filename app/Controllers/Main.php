<?php

namespace App\Controllers;

use App\Models\UserModel;

class Main extends BaseController
{
    public function index()
    {
        return view('Main', [
            'errors' => session()->getFlashdata('errors'),
            'message' => session()->getFlashdata('message'),
        ]);
    }

    public function register()
    {
        $rules = [
            'Fname' => 'required|min_length[2]|max_length[50]',
            'Lname' => 'required|min_length[2]|max_length[50]',
            'Mname' => 'permit_empty|max_length[50]',
            'Bday'  => 'required|valid_date[Y-m-d]',
            'Gender'=> 'required|in_list[Male,Female,Prefer not to say]',
            'EmAdd' => 'required|valid_email|is_unique[users.EmailAddress]',
            'PhNo'  => 'required|regex_match[/^[0-9]{11}$/]',
            'Addrs' => 'required|min_length[5]|max_length[255]',
            'Uname' => 'required|min_length[4]|max_length[50]|is_unique[users.Username]',
            'Pwd'   => 'required|min_length[8]|max_length[72]',
            'CPwd'  => 'required|matches[Pwd]',
            'TnC'   => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->insert([
            'FirstName'    => trim((string) $this->request->getPost('Fname')),
            'LastName'     => trim((string) $this->request->getPost('Lname')),
            'MiddleName'   => trim((string) $this->request->getPost('Mname')),
            'BirthDate'    => $this->request->getPost('Bday'),
            'Gender'       => $this->request->getPost('Gender'),
            'EmailAddress' => strtolower(trim((string) $this->request->getPost('EmAdd'))),
            'PhoneNumber'  => trim((string) $this->request->getPost('PhNo')),
            'Address'      => trim((string) $this->request->getPost('Addrs')),
            'Username'     => trim((string) $this->request->getPost('Uname')),
            'Password'     => password_hash((string) $this->request->getPost('Pwd'), PASSWORD_DEFAULT),
            'Departments'  => null,
            'Role'         => 'Customer',
            'Status'       => 'Active',
        ]);

        return redirect()->to('/login')->with('message', 'Account created successfully. You may now sign in.');
    }
}
