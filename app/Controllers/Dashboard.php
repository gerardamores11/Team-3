<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function customer()
    {
        if (! session()->get('logged_in') || session()->get('role') !== 'Customer') {
            return redirect()->to('/login');
        }
        return view('CustomerDashboard');
    }

    public function employee()
    {
        if (! session()->get('logged_in') || session()->get('role') === 'Customer') {
            return redirect()->to('/login');
        }
        return view('EmployeeDashboard');
    }
}
