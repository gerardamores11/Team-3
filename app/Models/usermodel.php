<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'FirstName',
        'LastName',
        'MiddleName',
        'BirthDate',
        'Gender',
        'EmailAddress',
        'PhoneNumber',
        'Address',
        'Username',
        'Password',
        'Departments'
    ];
}