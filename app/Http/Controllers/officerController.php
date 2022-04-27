<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Officer;
use App\Models\WorkDays;

class officerController extends Controller
{

    function getOfficersDetails()
   {
      $data = Officer::paginate(10);
      return view('officer',['value'=>$data]); 
   }

    function insertOfficer(Request $request){

        $request->validate([
            'officer_first_name' => 'bail|required|min:3',
            'officer_last_name' => 'bail|required|min:3',
            'post' => 'required',
            'status' => 'required',
            'work_start_time' => 'required',
            'work_end_time' => 'required',
        ]);
        $id = $user_id = rand(time(), 10000);
        
        $obj = new Officer();
        $obj->id = $id;
        $obj->officer_first_name = $request->officer_first_name;
        $obj->officer_last_name = $request->officer_last_name;
        $obj->officer_post = $request->post;
        $obj->officer_status = $request->status;
        $obj->work_start_time = $request->work_start_time;
        $obj->work_end_time = $request->work_end_time;
        $obj->save();

        foreach($request->days as $key=>$name)
        {
            $obj1 = new WorkDays();
            $obj1->officer_id = $id;
            $obj1->day_of_week = $name;
            $obj1->save();
        }
        return redirect()->back()->with('success','You have successfully added an Officer');

    }

    function getOfficerDetail($id)
    {
        $officer = Officer::find($id);
        $workdays = WorkDays::where('officer_id', $id)->get();
        return response()->json([
            'status'=>200,
            'officer'=>$officer,
            'workdays' => $workdays,
        ]);
    }

    function updateOfficer(Request $req)
    {
       $req->validate([
            'new_officer_first_name' => 'bail|required|min:3',
            'new_officer_last_name' => 'bail|required|min:3',
            'new_post' => 'required',
            'new_work_start_time' => 'required',
            'new_work_end_time' => 'required',
        ]);
        
        $id = $req->officer_id;
        $obj = Officer::findOrFail($id);

        $obj->officer_first_name = $req->new_officer_first_name;
        $obj->officer_last_name = $req->new_officer_last_name;
        $obj->officer_post = $req->new_post;
        $obj->work_start_time = $req->new_work_start_time;
        $obj->work_end_time = $req->new_work_end_time;
        $obj->update();

        WorkDays::where('officer_id', $id)->delete();

        foreach($req->newdays as $key=>$name)
        {
            $obj1 = new WorkDays();
            $obj1->officer_id = $id;
            $obj1->day_of_week = $name;
            $obj1->save();
        }

        return redirect()->back()->with('success','You have successfully Updated an Officer');
    }

    function updateOfficerStatus(Request $req)
   {
        $id = $req->user_id;
        $status = $req->status_value;
        $obj = Officer::findOrFail($id);

        if($status == 'active')
        {
            $obj->officer_status = 'inactive';
        }else{
            $obj->officer_status = 'active';
        }
        
        $obj->update();
        
        return redirect()->back()->with('success','Status changed Successfully');
   }
}
