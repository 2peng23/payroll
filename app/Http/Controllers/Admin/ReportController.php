<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Employee;
use App\EmployeeDeduction;
use App\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Overtime;
use App\SssContributionMatrix;
use Carbon\Carbon;
use Mail;
use App\Mail\PaySlip;
class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function attendance()
    {
        $from_date = request()->get('from');
        $to_date = request()->get('to');

        if($from_date ==null){
            $attendances  = Attendance::all();
        }else{
            $attendances = attendance::whereBetween('date',[$from_date,$to_date])->get();
        }
        return view('admin.reports.attendance',compact('attendances'));
    }

    public function payroll()
    {
        $has_date = request()->get('from') .','. request()->get('to');
        $has_date = explode(',', $has_date);
                 
        $employees = Employee::orderBy('last_name','asc')->get();

        $cola = 50;
        $payrolls = [];
        foreach($employees as $employee){
            
            $attendance = Attendance::where('employee_id',$employee->id)->whereBetween('date',[$has_date[0],$has_date[1]])->sum('num_hour') / 8;
            $holiday = Holiday::whereBetween('date',[$has_date[0],$has_date[1]])->count();
            $total_holiday =  $holiday;

            $days_of_work = number_format($attendance + $total_holiday,1);
             
            $rate_with_cola = ($employee->rate_per_hour + $cola);
            $total_wage = $rate_with_cola * $days_of_work;
            $overtime = Overtime::where('employee_id',$employee->id)->whereBetween('date',[$has_date[0],$has_date[1]])->sum('hour');
            $total_amount = $overtime + $total_wage;
            $deductions = $employee->deductions->toArray(); 

            // Deductions
            $sss = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>1])->first();
            $philhealth = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>2])->first();
            $pagibig = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>3])->first();

            $salary = ($employee->salary);  

            $payrolls[$employee->id] = [
                'employee'=>$employee->last_name .', '. $employee->first_name,
                'days_of_work'=>  $days_of_work,
                'holidays'=>  $total_holiday,
                'rate'=> $days_of_work > 0 ?  $employee->rate_per_hour : '-',
                'cola'=>  $days_of_work > 0 ? $cola : '-',
                'rate_with_cola'=>  $days_of_work > 0 ? $rate_with_cola : '-',
                'total_wage'=> $days_of_work > 0 ? $total_wage : '-',
                'overtime'=> $days_of_work > 0 ? $overtime : '-',
                'total_amount' =>  $days_of_work > 0 ? $overtime + $total_wage : '-',
                'sss'=> $sss !=null ?  number_format( $this->getContribution($salary)  ,2) : '-',
                'philhealth'=> $philhealth !=null ? number_format($philhealth->deduction->amount,2) : '',
                'pagibig'=> $pagibig !=null ? number_format($pagibig->deduction->amount,2) : '',
                'net_amount' => number_format($total_amount - (   ($philhealth !=null ? $philhealth->deduction->amount : 0) + ($pagibig !=null ? $pagibig->deduction->amount : 0)),2),
                'with_sss' => number_format($total_amount - ($sss !=null ?  $this->getContribution($salary) : 0 ),2),
            ];

        } 
       
        return view('admin.reports.payroll',compact('employees','has_date','payrolls'));
    }


    public function getContribution($salary){
    
         
        $con = SssContributionMatrix::where('range_from','<=', $salary)
        ->where('range_to','>=',$salary)
        ->first();
       return $con->value ?? 0;
    }

    public function payslip()
    {
        $has_date = request()->get('from') .','. request()->get('to');
        $has_date = explode(',', $has_date);
                 
        $employees = Employee::orderBy('last_name','asc')->get();

        $cola = 50;
        $payrolls = [];
        foreach($employees as $employee){
            
            $attendance = Attendance::where('employee_id',$employee->id)->whereBetween('date',[$has_date[0],$has_date[1]])->sum('num_hour') / 8;
            $holiday = Holiday::whereBetween('date',[$has_date[0],$has_date[1]])->count();
            $total_holiday =  $holiday;

            $days_of_work = $attendance + $total_holiday;
               
            $rate_with_cola = ($employee->rate_per_hour + $cola);
            $total_wage = $rate_with_cola * $days_of_work;
            $overtime = Overtime::where('employee_id',$employee->id)->whereBetween('date',[$has_date[0],$has_date[1]])->sum('hour');
            $total_amount = $overtime + $total_wage;
            $deductions = $employee->deductions->toArray(); 

            // Deductions
            $sss = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>1])->first();
            $philhealth = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>2])->first();
            $pagibig = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>3])->first();

            $salary = ($employee->salary);
           
          

            $payrolls[$employee->id] = [
                'employee'=>$employee->last_name .', '. $employee->first_name,
                'designation'=>$employee->position->title,
                'salary'=>$salary,
                'days_of_work'=>  $days_of_work,
                'month_year'=>  Carbon::parse($has_date[0])->format('F d -') . Carbon::parse($has_date[1])->endOfMonth()->format(' d Y'),
                'rate'=> $days_of_work > 0 ?  $employee->rate_per_hour : 0,
                'cola'=>  $cola ,
                'rate_with_cola'=>  $days_of_work > 0 ? $rate_with_cola : 0,
                'total_wage'=> $days_of_work > 0 ? $total_wage : 0,
                'overtime'=> $days_of_work > 0 ? $overtime : 0,
                'total_amount' =>  $days_of_work > 0 ? $overtime + $total_wage : 0,
                'sss'=>    $this->getContribution($salary) ,
                'philhealth'=> $philhealth !=null ? $philhealth->deduction->amount : 0,
                'pagibig'=> $pagibig !=null ? $pagibig->deduction->amount : 0,
                'total_deductions' => ( ($philhealth !=null ? $philhealth->deduction->amount : 0) + ($pagibig !=null ? $pagibig->deduction->amount : 0) + $this->getContribution($salary)),
                'net_amount' => $total_amount - (   ($philhealth !=null ? $philhealth->deduction->amount : 0) + ($pagibig !=null ? $pagibig->deduction->amount : 0)+ $this->getContribution($salary)),
                'with_sss' => $total_amount - (   $this->getContribution($salary)   ),
            ];
 
        } 

        
       
        return view('admin.reports.payslip',compact('employees','has_date','payrolls'));
    }

    public function mail_payslip($from, $to){
        $has_date = $from .','. $to;
        $has_date = explode(',', $has_date);
                 
        $employees = Employee::orderBy('last_name','asc')->get();

        $cola = 50;
        $payrolls = [];
        foreach($employees as $employee){
            
            $attendance = Attendance::where('employee_id',$employee->id)->whereBetween('date',[$has_date[0],$has_date[1]])->sum('num_hour') / 8;
            $holiday = Holiday::whereBetween('date',[$has_date[0],$has_date[1]])->count();
            $total_holiday =  $holiday;

            $days_of_work = $attendance + $total_holiday;
               
            $rate_with_cola = ($employee->rate_per_hour + $cola);
            $total_wage = $rate_with_cola * $days_of_work;
            $overtime = Overtime::where('employee_id',$employee->id)->whereBetween('date',[$has_date[0],$has_date[1]])->sum('hour');
            $total_amount = $overtime + $total_wage;
            $deductions = $employee->deductions->toArray(); 

            // Deductions
            $sss = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>1])->first();
            $philhealth = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>2])->first();
            $pagibig = EmployeeDeduction::where(['employee_id'=>$employee->id,'deduction_id'=>3])->first();

            $salary = ($employee->salary);
            
          

            $payrolls[$employee->id] = [
                'employee'=>$employee->last_name .', '. $employee->first_name,
                'designation'=>$employee->position->title,
                'salary'=>$salary,
                'days_of_work'=>  $days_of_work,
                'month_year'=>  Carbon::parse($has_date[0])->format('F d -') . Carbon::parse($has_date[1])->endOfMonth()->format(' d Y'),
                'rate'=> $days_of_work > 0 ?  $employee->rate_per_hour : 0,
                'cola'=>  $cola ,
                'rate_with_cola'=>  $days_of_work > 0 ? $rate_with_cola : 0,
                'total_wage'=> $days_of_work > 0 ? $total_wage : 0,
                'overtime'=> $days_of_work > 0 ? $overtime : 0,
                'total_amount' =>  $days_of_work > 0 ? $overtime + $total_wage : 0,
                'sss'=>   number_format( $this->getContribution($salary)  ,2)  ,
                'philhealth'=> $philhealth !=null ? number_format($philhealth->deduction->amount,2) : 0,
                'pagibig'=> $pagibig !=null ? number_format($pagibig->deduction->amount,2) : 0,
                'total_deductions' => ( ($philhealth !=null ? $philhealth->deduction->amount : 0) + ($pagibig !=null ? $pagibig->deduction->amount : 0) + $this->getContribution($salary)),
                'net_amount' => number_format($total_amount - (   ($philhealth !=null ? $philhealth->deduction->amount : 0) + ($pagibig !=null ? $pagibig->deduction->amount : 0)),2),
                'with_sss' => number_format($total_amount - (   $this->getContribution($salary)   ),2),
            ];

            try {
                Mail::to($employee->email)->send(new PaySlip($employee->email,$payrolls[$employee->id]));
            } catch (\Exeception $th) {
                return redirect()->back()->withMessage('Email settings error: '. $th);
            }

        } 
        
      
        return redirect()->back()->withMessage('Payslips has been sent to employees individual email');
    }
}
