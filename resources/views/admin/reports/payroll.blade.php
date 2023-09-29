@extends('admin.layout.app')

@section('title')
    Payroll
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row clearfix print">
            <div class="card">
                <div class="card-body">
                    <form action="?filter" method='get'>
                        <div class="row">
                            <div class="input-group mb-0 col-5">
                                <span class="input-group-prepend">
                                    <label class="input-group-text"><i class="ik ik-calendar"></i> </label>
                                </span>
                                <input type="date" value='{{ $has_date[0] ?? null }}' name='from'
                                    class="form-control form-control-bold text-center">
                                <input name='to' value='{{ $has_date[1] ?? null }}' type="date"
                                    class="form-control form-control-bold text-center">
                                <span class="input-group-append">
                                    <label class="input-group-text"><i class="ik ik-calendar"></i> </label>
                                </span>

                            </div>
                            <button class='btn btn-lg btn-success'> <i class="fa fa-random"></i> Generate</button>
                            @if ($has_date != null)
                                <button onclick='window.print()' class='ml-3  btn btn-lg btn-secondary' type='button'> <i
                                        class="fa fa-print"></i> Print</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row clearfix">  
            @if(session('message')!=null)
                <div class="col-md-12">
                    <div class="alert alert-success">{{ session('message') }}</div>
                </div>
            @endif
            @if ($has_date != null)
                <div class="printable-header">
                    <div class="logo">
                        <img src="{{ asset('images/blmc.jpg') }}" alt="">
                    </div>
                    <div class="details">
                        <h4>BANSUD LIVESTOCK MULTI-PURPOSE COOPERATIVE</h4>
                        <p>Poblacion, Bansud, Oriental Mindoro</p>
                        <p>CDA Reg. No. 9520-04000617</p>
                        <p><strong>PAYROLL REPORT</strong></p> 
                        <span class="date">{{ $has_date[0] . ' to ' . $has_date[1] }}</span>
                    </div>
                </div>

                <table class="table bg-white table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="3"></th>
                            <th rowspan="3">NAME OF EMPLOYEE</th>
                            <th rowspan="3" class='text-center'>DAYS <br> OF <br> WORK</th>
                            <th rowspan="3" class='text-center'>Rate</th>
                            <th rowspan="3" class='text-center'>COLA</th>
                            <th rowspan="3" class='text-center'>Rate with <br> COLA</th>
                            <th rowspan="3" class='text-center'>TOTAL <br> REGULAR <br> WAGE</th>
                            <th rowspan="3" class='text-center'>OT HOURS <br> (Undertime)</th>
                            <th rowspan="3" class='text-center'>TOTAL AMOUNT</th>
                            <th colspan="{{ \Carbon\Carbon::parse($has_date[0])->format('d') <= 15 ? 1 : 2 }}"
                                class='text-center'>Deductions</th>
                            <th rowspan="3" class='text-center'>NET <br> AMOUNT</th>
                            <th rowspan="3" class='text-center'>Signature</th>
                        </tr>
                        <tr>
                            @if (\Carbon\Carbon::parse($has_date[0])->format('d') <= 15)
                                <th rowspan="2" class='text-center'>SSS</th>
                            @else
                                <th rowspan="2" class='text-center'>Pag-ibig</th>
                                <th rowspan="2" class='text-center'>Philhealth</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($payrolls as $roll)
                            <tr>
                                <td>{{ $counter += 1 }}</td>
                                <td>{{ $roll['employee'] }}</td>
                                <td class='text-center'>{{ $roll['days_of_work'] }}</td>
                                <td class='text-right'>{{ $roll['rate'] }}</td>
                                <td class='text-right'>{{ $roll['cola'] }}</td>
                                <td class='text-right'>{{ $roll['rate_with_cola'] }}</td>
                                <td class='text-right'>{{ $roll['total_wage'] }}</td>
                                <td class='text-right'>{{ $roll['overtime'] }}</td>
                                <td class='text-right'>{{ $roll['total_amount'] }}</td>
                                @if (\Carbon\Carbon::parse($has_date[0])->format('d') <= 15)
                                    <td class='text-right'>{{ $roll['sss'] }}</td>
                                    <td class='text-right'><strong>{{ $roll['with_sss'] }}</strong></td>
                                @else
                                    <td class='text-right'>{{ $roll['pagibig'] }}</td>
                                    <td class='text-right'>{{ $roll['philhealth'] }}</td>
                                    <td class='text-right'><strong>{{ $roll['net_amount'] }}</strong></td>
                                @endif
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
`
