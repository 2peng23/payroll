@extends('admin.layout.app')
@section('title')
    Attendance
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card print ">
                            <div class="row">
                                <form action="{{ route('admin.reports.attendance') }}" class='col-md-9' method='get'>
                                    <div class="card-body  d-flex">

                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">From</div>
                                            </div>
                                            <input type="date" value="{{ old('from', request()->get('from')) }}"
                                                class='form-control mr-2' name='from' />
                                        </div>

                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">To</div>
                                            </div>
                                            <input type="date" value="{{ old('to', request()->get('to')) }}"
                                                class='form-control' name='to' />
                                        </div>

                                        <button class='btn btn-lg    btn-success ml-2'> <i class="fa fa-random"></i>
                                            Generate
                                        </button>
                                        @if (request()->get('from') != null)
                                            <a href='javascript:;' onclick='window.print()' class='btn btn-lg  text-white btn-primary ml-2'> <i class="fa fa-print"></i>
                                                Print
                                            </a>
                                        @endif

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if (request()->get('from') != null && request()->get('to') != null)
                <div class="printable-header">
                    <div class="logo">
                        <img src="{{ asset('images/blmc.jpg') }}" alt="">
                    </div>
                    <div class="details">
                        <h4>BANSUD LIVESTOCK MULTI-PURPOSE COOPERATIVE</h4>
                        <p>Poblacion, Bansud, Oriental Mindoro</p>
                        <p>CDA Reg. No. 9520-04000617</p> 
                        <p><strong>ATTENDANCE REPORT</strong></p> 
                        <span class="date">{{ request()->get('from') .'-'. request()->get('to') }}</span>
                    </div>
                </div>

                <table class="table bg-white table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Employee Id</th>
                                <th>Time In </th>   
                                <th>Status</th>
                                <th>Time Out</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $att)
                                <tr>
                                    <td>{{ $att->employee->first_name . ' ' . $att->employee->last_name }}</td>
                                    <td>{{ $att->employee->employee_id }}</td>
                                    <td>{{ $att->time_in }}</td>
                                    <td>{{ $att->ontime_status }}</td>
                                    <td>{{ str_slug($att->time_out) == '1200-am' ? '' : $att->time_out }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="card border-success bg-success">
                        <div class="card-body text-white">
                            <span class="f-16"> <i class="fa fa-info-circle"></i> Please select a specific date range to
                                generate a report!</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
