<?php
namespace App\Controllers;
use App\Models\{UserModel,BookingModel,AnnouncementModel,NotificationModel};
class Admin extends BaseController {
 private function guard(){ return session()->get('logged_in') && in_array(session()->get('role'),['Admin','HR','Dispatcher'],true); }
 public function dashboard(){ if(!$this->guard())return redirect()->to('/login'); return view('EmployeeDashboard'); }
 public function users(){ if(!$this->guard())return redirect()->to('/login'); return view('admin/Users',['users'=>(new UserModel())->orderBy('id','DESC')->findAll()]); }
 public function setUserStatus($id){ if(!$this->guard())return redirect()->to('/login'); (new UserModel())->update($id,['Status'=>$this->request->getPost('Status')]); return redirect()->to('/admin/users'); }
 public function bookings(){ if(!$this->guard())return redirect()->to('/login'); $db=db_connect(); $bookings=$db->table('bookings b')->select('b.*,u.FirstName,u.LastName')->join('users u','u.id=b.customer_id')->orderBy('b.id','DESC')->get()->getResultArray(); $tech=(new UserModel())->where('Role','Technician')->where('Status','Active')->findAll(); return view('admin/Bookings',['bookings'=>$bookings,'technicians'=>$tech]); }
 public function updateBooking($id){ if(!$this->guard())return redirect()->to('/login'); $m=new BookingModel(); $m->update($id,['status'=>$this->request->getPost('status'),'technician_id'=>$this->request->getPost('technician_id')?:null,'admin_notes'=>$this->request->getPost('admin_notes')]); $b=$m->find($id); (new NotificationModel())->insert(['user_id'=>$b['customer_id'],'title'=>'Booking update','message'=>'Your service request is now '.$b['status'].'.','is_read'=>0]); return redirect()->to('/admin/bookings'); }
 public function announcements(){ if(!$this->guard())return redirect()->to('/login'); return view('admin/Announcements',['items'=>(new AnnouncementModel())->orderBy('id','DESC')->findAll()]); }
 public function createAnnouncement(){ if(!$this->guard())return redirect()->to('/login'); (new AnnouncementModel())->insert(['title'=>$this->request->getPost('title'),'message'=>$this->request->getPost('message'),'audience'=>$this->request->getPost('audience'),'created_by'=>session('user_id')]); return redirect()->to('/admin/announcements'); }
 public function reports(){ if(!$this->guard())return redirect()->to('/login'); $db=db_connect(); $data=['users'=>$db->table('users')->countAllResults(),'customers'=>$db->table('users')->where('Role','Customer')->countAllResults(),'pending'=>$db->table('bookings')->where('status','Pending')->countAllResults(),'completed'=>$db->table('bookings')->where('status','Completed')->countAllResults()]; return view('admin/Reports',$data); }
}
