@extends('admin.layout.app')

@section('title') Employees Archive @endsection

@section('content')
<div class="page-header">
  <div class="row align-items-end">
    <div class="col-lg-8">
      <div class="page-header-title">
        <i class="ik ik-users bg-blue"></i>
        <div class="d-inline">
          <h5>Employees</h5>
          <span>You can show and manage Employees from here.</span>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <nav class="breadcrumb-container" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('admin.employee.index') }}">Employees</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">List of Employees</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 mt-4">
      <div class="card">

     
        <div class="tabs_contant">
          <div class="card-header">
            <h5>List of Archive Employees</h5>
          </div>
          <div class="card-body">
            <table  class="table table-striped">
              <thead>
                <tr>
                  <th>Avatar</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Details</th>
                  <th>Publish</th>
                  <th>Actions</th>
                   
                </tr>
              </thead>
              <tbody>
                @foreach($employees as $k => $employee)
                <tr>
                 <td>
                   <img src="{{$employee->mediaUrl['thumb']}}" class='table-user-thumb'>
                 </td>
                 <td>{{ $employee->first_name }}</td>
                 <td>{{ $employee->last_name }}</td>
                 <td>{{ $employee->phone }}</td>
                 <td>{{ $employee->email }}</td>
                 <td>{{ $employee->position->title }}</td>
                 <td>
                   <div class=''>
                    <b>Gender :</b> <span>{{$employee->gender}}</span></br>
                    <b>Employee Id :</b> <span>{{$employee->employee_id}}</span></br>
                    <b>Schedule :</b> <span>{{$employee->schedule->time_in.'-'.$employee->schedule->time_out}}</span></br>
                    <b>Address :</b> <span>{{$employee->address}}</span></br>
                  </div>
                 </td>
                 <td>
                  @if($employee->is_active == '1')
                    <span class='success-dot' title='Published' title='Active Employee'></span>
                  @else
                    <i class='ik ik-alert-circle text-danger alert-status' title='In-Active Employee'></i>
                  @endif
                 </td>
                 <td>                   
                    <a href="{{route("admin.employee.restore",['id'=>$employee->id])}}" class='cursure-pointer'><i class='ik ik-clock text-danger'></i></a>
                 
                 </td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!--End Tab Content-->
      </div>
    </div>
  </div>
  
</div>
@endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    td.p-0 img.img-thumbnail{
      width: 140px;
    }
    button.h-33{
      height: 33px !important;
    }
    #map{
      height: 500px;
      border: 2px solid #00000054;
      border-radius: 11px;
    }s
</style>
@endsection
