<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('LoginHome', [
            'error' => session()->getFlashdata('error'),
            'message' => session()->getFlashdata('message'),
        ]);
    }

    public function authenticate()
    {
        $identifier = trim((string) $this->request->getPost('identifier'));
        $password = (string) $this->request->getPost('password');

        if ($identifier === '' || $password === '') {
            return redirect()->to('/login')->withInput()->with('error', 'Enter your username/email and password.');
        }

        $model = new UserModel();
        $user = $model->groupStart()
            ->where('Username', $identifier)
            ->orWhere('EmailAddress', strtolower($identifier))
            ->groupEnd()
            ->where('Status', 'Active')
            ->first();

        if (! $user || ! password_verify($password, $user['Password'])) {
            return redirect()->to('/login')->withInput()->with('error', 'Invalid username/email or password.');
        }

        session()->regenerate();
        session()->set([
            'user_id' => $user['id'],
            'name' => $user['FirstName'] . ' ' . $user['LastName'],
            'role' => $user['Role'],
            'logged_in' => true,
        ]);

        switch ($user['Role']) {
            case 'Customer':
                return redirect()->to('/customer/dashboard');

            case 'Admin':
            case 'HR':
            case 'Dispatcher':
                return redirect()->to('/admin/dashboard');

            case 'Technician':
                return redirect()->to('/technician/dashboard');

            case 'Employee':
                return redirect()->to('/employee/dashboard');

            default:
                session()->destroy();
                return redirect()->to('/login')->with('error', 'Your account role is not configured.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'You have signed out.');
    }
}
