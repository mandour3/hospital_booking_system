@extends('layouts.main')

@section('content')

<div class="container-lg" style="margin: 0 auto;">
<h1 class="text-center mt-2 mb-2 " style="color:RED;">APPOINTMENT</h1>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">department name</th>
      <th scope="col">department date</th>
      <th scope="col">taken</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($appointments as $appointment )
        <tr>
      <th scope="row">{{$appointment->id}}</th>
      <td>{{$appointment->department_name}}</td>
      <td>{{$appointment->department_date}}</td>
      @if ($appointment->taken)
          <td>you can not book this appointment</td>
          
          @else
<td>
    <form method="post" action="{{route('bookAppointments')}}" >
      @csrf
      <input type="hidden" value="{{$appointment->id}}" name="Appointment_id">
      <input type="hidden" value="{{$appointment->department_name}}" name="department_name">
      <input type="hidden" value="{{$appointment->department_date}}" name="department_date">
        <input type="submit" value="book" class="btn btn-primary">
    </form>
</td>
      @endif
      
    </tr>
    @endforeach
    
    
  </tbody>
</table>
</div>


@endsection