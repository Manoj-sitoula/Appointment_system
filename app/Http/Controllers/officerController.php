<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;

class officerController extends Controller
{

    function getOfficerDetails()
   {
      $data = Officer::paginate(10);
      return view('officer',['value'=>$data]); 
   }

    function insertOfficer(Request $request){
        
     $obj = new Officer();
        // $request->validate([
        //     $request->officer_first_name => ['bail','required'],
        //     $request->officer_last_name => ['bail','required'],
        //     $request->post => ['bail','required'],
        //     $request->status => ['bail','required'],
        //     $request->work_start_time => ['bail','required'],
        //     $request->work_end_time => ['bail','required'],
        // ]);

        $obj->officer_first_name = $request->officer_first_name;
        $obj->officer_last_name = $request->officer_last_name;
        $obj->officer_post = $request->post;
        $obj->officer_status = $request->status;
        $obj->work_start_time = $request->work_start_time;
        $obj->work_end_time = $request->work_end_time;

        $obj->save();
        return redirect()->back()->with('success','You have successfully added an Officer');

    }
}
