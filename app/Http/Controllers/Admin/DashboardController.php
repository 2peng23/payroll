<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Deduction,Position};
use Response;
use Carbon\Carbon;
use App\Attendance;

class DashboardController extends Controller
{
    private $folder = "admin.";

    public function dashboard()
    {  
    	return View($this->folder."dashboard.dashboard",[
			'attendance'=>Attendance::where('date',Carbon::today()->format('Y-m-d'))->orderBy('date','desc')->get(),
    		'deductions'=> Deduction::latest('id')->get(),
    		'total_deduction' => Deduction::sum('amount'),
    		'positions'=> Position::inRandomOrder()->get(),
    	]);
    }

}
