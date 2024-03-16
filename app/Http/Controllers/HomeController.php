<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
    	$hospitals = Hospital::all();
        $specialties = Specialty::all();

    	return view('home',compact(['hospitals','specialties']));
    }
    public function getdoctors(Request $request)
    {
    	if($request->ajax()){
    		$doctors = Doctor::where('hospital_id',$request->hospital_id)->get();
            $data = view('doctoroptions',compact('doctors'))->render();

    		return response()->json(['options'=>$data]);
    	}
    }
    public function getworkingdays(Request $request)
    {
    	if($request->ajax()){
    		$doctor = Doctor::where('id',$request->doctor_id)->first();
         
            $workingdays = array_map('trim', explode(',', $doctor->working_days));
           
    		return response()->json(['workingdays'=>$workingdays]);
    	}
    }
}
