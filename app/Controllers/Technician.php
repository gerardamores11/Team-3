<?php
namespace App\Controllers;
use App\Models\{BookingModel,ServiceReportModel,AnnouncementModel};
class Technician extends BaseController {
 private function guard(){ return session()->get('logged_in') && session()->get('role')==='Technician'; }
 public function dashboard(){ if(!$this->guard())return redirect()->to('/login'); $m=new BookingModel(); return view('technician/Dashboard',['bookings'=>$m->where('technician_id',session('user_id'))->orderBy('id','DESC')->findAll(),'announcements'=>(new AnnouncementModel())->groupStart()->where('audience','All')->orWhere('audience','Technician')->groupEnd()->orderBy('id','DESC')->findAll()]); }
 public function checkIn($id){ if(!$this->guard())return redirect()->to('/login'); $m=new BookingModel(); $b=$m->find($id); if($b && $b['technician_id']==session('user_id'))$m->update($id,['checkin_time'=>date('Y-m-d H:i:s'),'latitude'=>$this->request->getPost('latitude'),'longitude'=>$this->request->getPost('longitude'),'status'=>'In Progress']); return redirect()->to('/technician/dashboard'); }
 public function reportIssue($id){ if(!$this->guard())return redirect()->to('/login'); (new ServiceReportModel())->insert(['booking_id'=>$id,'technician_id'=>session('user_id'),'problem'=>$this->request->getPost('problem'),'action_taken'=>$this->request->getPost('action_taken'),'status'=>'Submitted']); return redirect()->to('/technician/dashboard'); }
}
