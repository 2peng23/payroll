@extends('admin.layout.app')

@section('title')
    Attendances
@endsection

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
      <div class="col-lg-4 col-md-6 col-sm-12 cursure-pointer">
        <a href="{{ route('admin.reports.attendance') }}">
          <div class="widget bg-primary">
            <div class="widget-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="state">
                  <h6>Attendance</h6>
                  <h2>Report</h2>
                </div>
                <div class="icon">
                  <i class="ik ik-users"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 cursure-pointer">
        <a href="{{ route('admin.reports.payroll') }}">
          <div class="widget bg-success">
            <div class="widget-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="state">
                  <h6>Payroll</h6>
                  <h2>Report</h2>
                </div>
                <div class="icon">
                  <i class="ik ik-pie-chart"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 cursure-pointer">
        <a href="{{ route('admin.reports.payslip') }}">
          <div class="widget bg-warning">
            <div class="widget-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="state">
                  <h6>Payslip</h6>
                  <h2>Report</h2>
                </div>
                <div class="icon">
                  <i class="ik ik-clock"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <!--<div class="col-lg-3 col-md-6 col-sm-12 cursure-pointer">
        <a href=#>
          <div class="widget bg-danger">
            <div class="widget-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="state">
                  <h6>Logs</h6>
                  <h2>Trail</h2>
                </div>
                <div class="icon">
                  <i class="ik ik-alert-circle"></i>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>-->
    </div>
  
    
  </div>
@endsection