@component('mail::message')
# Salary Payslip

<div class="payslip">
   
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

Thanks,<br>
{{ config('app.name') }}
@endcomponent
