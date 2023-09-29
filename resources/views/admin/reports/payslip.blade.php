@extends('admin.layout.app')

@section('title')
    Payslip
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

                                    <a href='{{ route('admin.payslip.mail',[request()->get('from'),request()->get('to')]) }}' class='ml-3  btn btn-lg btn-secondary' type='button'> <i
                                      class="fa fa-envelope"></i> Email Payslips</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
       
        @php
          $counter = 0;
        @endphp
        @if (request()->get('from') != null && request()->get('to') != null)
        @foreach($payrolls as $slip)
        <div class="payslip">
          <div class="number">{{ $counter+=1 }}</div>
            <div class="heading">
                <h5>BANSUD LIVESTOCK MULTI-PURPOSE COOPERATIVE</h5>
                <P>Poblacion, Bansud, Oriental Mindoro</P>
                <h3>SALARY SLIP</h3>
            </div>

            <div class="heading-2">
                <table class='table-heading'>
                   <tbody>
                    <tr>
                      <td>Employee Name: </td>
                      <td>{{ $slip['employee'] }}</td>
                  </tr>
                  <tr>
                      <td>Designation: </td>
                      <td>{{ $slip['designation'] }}</td>
                  </tr>
                  <tr>
                      <td>Month & Year: </td>
                      <td>{{ $slip['month_year'] }}</td>
                  </tr>
                   </tbody>
                </table>
            </div>
                <table class='body'>
                    <thead>
                        <tr>
                            <th colspan="2">EARNINGS</th>
                            <th colspan="2">DEDUCTIONS</th>
                        </tr>
                        <tr>
                            <td><strong>DESCRIPTION</strong></td>
                            <td><strong>AMOUNT</strong></td>
                            <td><strong>DESCRIPTION</strong></td>
                            <td><strong>AMOUNT</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Salary</td>
                            <td>{{ number_format($slip['total_wage'],2) }}</td>
                            <td>SSS Contribution</td>
                            <td>{{ number_format($slip['sss'],2) }}</td>
                        </tr>
                        <tr>
                          <td>Overtime Pay</td>
                          <td>{{ $slip['overtime'] }}</td>
                            <td>Philhealth Contributtion</td>
                            <td>{{ number_format($slip['philhealth'],2) }}</td>
                        </tr>
                        <tr>
                            <td>Others</td>
                            <td></td>
                            <td>PAGIBIG Contribution</td>
                            <td>{{ number_format($slip['pagibig'],2) }}</td>
                        </tr>


                        <tr>
                            <td></td>
                            <td></td>
                            <td>Cola</td>
                            <td>{{ number_format($slip['cola'],2) }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>CASH ADVANCE</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>TOTAL DEDUCTION</td>
                            <td>{{ number_format($slip['total_deductions'],2) }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>TOTAL SALARY</td>
                            <td>{{ number_format($slip['total_amount'],2) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>NET PAY</strong></td>
                            <td>{{ number_format($slip['net_amount'],2) }}</td>
                        </tr>
                    </tbody>
                </table>  
                <div class="payslip-footer">
                  <table>
                    <tr>
                      <td>Prepared by:</td>
                      <td>
                       <div class="text-center">
                        <u>Marilyn G. Pedraza</u> <br>
                        Treasurer
                       </div>

                      </td>
                      <td>Received by:</td>
                      <td>____________</td>
                    </tr>
                  </table>
                </div>
        </div>
        @endforeach
        @endif

        
         
    </div>
@endsection
