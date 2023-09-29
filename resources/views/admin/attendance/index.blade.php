@extends('admin.layout.app')

@section('title')
    Attendances
@endsection
 
@section("content")
<div id='attendance-date' class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               Select Month
            </div>
            <div class="modal-body">
               
                <div class='month-grid'>
                    @foreach($month_dates as $mkey=> $mo)
                        <div class='grid-item'> <a href="?date={{ \Carbon\Carbon::parse($year.'-'.$mo.'-1')->format('Y-m-d') }}">{{ $mo }}</a> </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="print-head">
                Attendance</div> <a href="javascript:;" onclick="window.print()" class='float-right print'> <i class="fa fa-print"></i> Print</a>
        </div>
       <div class="table-responsive p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style='min-width:150px'  class=''>Name</th>
                    <th class='text-center' colspan="{{ $days }}"> <a href="javascript:;" data-toggle='modal' data-target='#attendance-date'>{{ \Carbon\Carbon::parse(request()->get('date') ?? now())->format('F Y') }}</a> </th>
                </tr>
                <tr>
                    @for($d=1; $d<=$days; $d++)
                        <td>{{ $d }}</td>
                    @endfor
                </tr>
            </thead>
            @foreach($employees as $emp)
                <tr>
                    <td>{{ $emp->last_name .', '. $emp->first_name }}   </td>
                    @for($d=1; $d<=$days; $d++)
                       <td> 
                        
                         {!! \App\Attendance::where('employee_id',$emp->id)->where('date',  \Carbon\Carbon::parse($year.'-'.$month.'-'. $d)->format('Y-m-d') )->first() != null ? '<span class="text-success ik ik-check-circle"></span>' : '<span class="text-danger fa fa-times-circle"></span>' !!}
                       </td>
                    @endfor
                </tr>
            @endforeach
        </table>
       </div>
    </div>
@endsection

@section('js')
    
@endsection
