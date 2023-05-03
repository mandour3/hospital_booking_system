<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
;

class ProjectController extends Controller
{
   public function getdata(request $request){
    $data ="hello";
    return view("index",['key'=>$data]);
   }
   public function getalldepartments(Request $request){
      $departments = Department::all();
      return view('index',['departments'=>$departments]);
   }

   public function showAppointments(Request $request){
      $department_id =$request->input('D_id');
      $Appointments = Appointment::where('department_id',$department_id)->get();
      return view('appointments',['appointments'=>$Appointments]);


   }
   public function bookAppointments(Request $request){
      $Appointment_id =$request->input('Appointment_id');
      $department_name =$request->input('department_name');
      $department_date =$request->input('department_date');

      $exists = Booking::where('appointment_id','=',$Appointment_id)->exists();

      if($exists){
         Session::flash('message','Appointment was already taken');
         Session::flash('alert-class','alert-danger');
         return redirect('/');
      }
      else{
         $booking = new Booking;
         $booking->appointment_id =$Appointment_id;
         $booking->department_name =$department_name;
         $booking->appointment_date =$department_date;
         $booking->username = Auth::user()->name;
         $booking->user_id = Auth::user()->id;

         $booking->save();
         Appointment::where('id',$Appointment_id)->update(['taken'=>1]);

         Session::flash('message','Appointment was booked successfully');
         Session::flash('alert-class','alert-success');
         return redirect('/');
      }
     
   }
   public function myBookings(Request $request){
      $bookings = Booking::where('user_id',Auth::user()->id)->get();
      return view("myBookings",['bookings'=>$bookings]);

   }
   public function cancelBooking(Request $request){
      $booking_id =$request->input('booking_id');
      $Appointment_id =$request->input('Appointment_id');
      Booking::where('id',$booking_id)->delete();
      Appointment::where('id',$Appointment_id)->update(['taken'=>0]);

      Session::flash('message','Appointment was canceled successfully');
      Session::flash('alert-class','alert-success');
      return redirect('/');

   }
}
