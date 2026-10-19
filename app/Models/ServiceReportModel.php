<?php
namespace App\Models;
use CodeIgniter\Model;
class ServiceReportModel extends Model {
 protected $table='service_reports'; protected $primaryKey='id'; protected $returnType='array';
 protected $allowedFields=['booking_id','technician_id','problem','action_taken','status'];
}
