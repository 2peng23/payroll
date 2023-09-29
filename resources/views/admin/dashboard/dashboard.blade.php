@extends('admin.layout.app')

@section('title') Dashboard @endsection

@section('css')
<style type="text/css">

</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
   <div class="col-lg-8">
    <div class="page-header-title">
     <i class="ik ik-bar-chart bg-blue"></i>
     <div class="d-inline">
      <h5>Dashboard</h5>
      <span>This is dashboard of the Payroll System.</span>
    </div>
  </div>
</div>
<div class="col-lg-4">
  <nav class="breadcrumb-container" aria-label="breadcrumb">
   <ol class="breadcrumb">
    <li class="breadcrumb-item">
     <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
   </li>
   <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
 </ol>
</nav>
</div>
</div>
</div>

<div class="container-fluid">
  <div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12 cursure-pointer">
      <a href="#">
        <div class="widget bg-primary">
          <div class="widget-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="state">
                <h6>Total Employees</h6>
                <h2>{{ $counts['employees'] }}</h2>
              </div>
              <div class="icon">
                <i class="ik ik-users"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 cursure-pointer">
      <a href="#">
        <div class="widget bg-success">
          <div class="widget-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="state">
                <h6>On Time Percentage</h6>
                <h2>{{ $counts['on_time_perc'] }}%</h2>
              </div>
              <div class="icon">
                <i class="ik ik-pie-chart"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 cursure-pointer">
      <a href="#">
        <div class="widget bg-warning">
          <div class="widget-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="state">
                <h6>On Time Today</h6>
                <h2>{{ $counts['on_time_attendance'] }}</h2>
              </div>
              <div class="icon">
                <i class="ik ik-clock"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 cursure-pointer">
      <a href=#>
        <div class="widget bg-danger">
          <div class="widget-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="state">
                <h6>Late Today</h6>
                <h2>{{ $counts['late_attendance'] }}</h2>
              </div>
              <div class="icon">
                <i class="ik ik-alert-circle"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

   <div class="row">
    
    <div class="col-xl-12 col-md-12 col-sm-12">
      <div class="card latest-update-card">
        <div class="card-header">
          <h3>Daily Attendance - {{ \Carbon\Carbon::today()->format('F d, Y') }}</h3>
          <div class="card-header-right"></div>
        </div>
        <div class="card p-0">
         <table class="table mb-0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Time</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($attendance as $att)
            <tr>
              <td>{{ $att->employee->first_name .' '. $att->employee->last_name }}</td>
              <td>{{$att->time_in }}</td>
              <td>{{ $att->ontime_status }} </td>
            </tr>
            @endforeach
          </tbody>
         </table>
        </div>
      </div>
    </div>
  </div> 
</div>

@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection