<?php

namespace App\Http\Controllers\Admin;

use App\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    private $folder = "admin.holiday.";

    public function index()
    {
     
        $holidays = Holiday::orderBy('date','asc')->get();
        return View($this->folder.'index',[
            'holidays' => $holidays,
        ]);
    }
    

    public function create()
    {
        return View($this->folder.".create");
    }


    
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'date'=>'required|date',
            'description'=>'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $holiday = Holiday::firstOrNew(['date'=>$request->date]);
        $holiday->description = $request->description;
        $holiday->save();

        return redirect()->route('admin.holiday.index');
    }

   
    public function show(Holiday $holiday)
    {
        //
    }
 
    public function edit(Holiday $holiday)
    {
        return view('admin.holiday.edit',compact('holiday'));
    }

    
    public function update(Request $request, Holiday $holiday)
    {
        $validate = Validator::make($request->all(),[
            'date'=>'required|date',
            'description'=>'required',
        ]);

        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $holiday = $holiday->firstOrNew(['date'=>$request->date]);
        $holiday->description = $request->description;
        $holiday->save();

        return redirect()->route('admin.holiday.index');
    }

  
    public function destroy(Holiday $holiday)
    {
    
    }
}
