@extends('layouts.main')

@section('content')

<div class="container-lg" style="margin: 0 auto;">
<h1 class="text-center mt-2 mb-2 " style="color:RED;">MyBOOKINGS</h1>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Booking id</th>
      <th scope="col">Appointment id</th>
      <th scope="col">department name</th>
      <th scope="col">Appointment date</th>
      <th scope="col">Cancel</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($bookings as $booking )
        <tr>
      <th scope="row">{{$booking->id}}</th>
      <th>{{$booking->appointment_id}}</th>
      <td>{{$booking->department_name}}</td>
      <td>{{$booking->appointment_date}}</td>
      <td>
        <form method="post"action="{{route('cancelBooking')}}">
          @csrf
          <input type="hidden" value="{{$booking->id}}" name="booking_id">
          <input type="hidden" value="{{$booking->appointment_id}}" name="Appointment_id">
          <input type="submit" value="cancel" class="btn btn-danger">
        </form>

      </td>
    
    </tr>
    @endforeach
    
    
  </tbody>
</table>
</div>


@endsection