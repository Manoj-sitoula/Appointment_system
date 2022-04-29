<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class visitorController extends Controller
{
    function getVisitorsDetails()
   {
      $data = Visitor::paginate(10);
      return view('visitor',['value'=>$data]); 
   }

   function insertVisitor(Request $request)
   {
       $request->validate([
           'visitor_first_name' => 'bail|required|min:3',
           'visitor_last_name' => 'bail|required|min:3',
           'phone_no' => 'required',
           'email' =>'required',
           'status' => 'required',
       ]);

       $id = rand(time(), 10000);
       $visitor = new Visitor();

       $visitor->id = $id;
       $visitor->visitor_first_name = $request->visitor_first_name;
       $visitor->visitor_last_name = $request->visitor_last_name;
       $visitor->mobile_number = $request->phone_no;
       $visitor->email = $request->email;
       $visitor->status = $request->status;

       $visitor->save();
       return redirect()->back()->with('success','You have successfully added an Visitor');
   }

   function getVisitorDetail($id)
   {
    $visitor = Visitor::find($id);

    return response()->json([
        'status'=>200,
        'visitor'=>$visitor,
    ]);
   }

   function updateVisitor(Request $request)
   {
  
    $request->validate([
        'new_visitor_first_name' => 'bail|required|min:3',
        'new_visitor_last_name' => 'bail|required|min:3',
        'new_phone_no' => 'required',
        'new_email' =>'required',
    ]);
    
    $id = $request->visitor_id;
    $obj = Visitor::findOrFail($id);

    $obj->visitor_first_name = $request->new_visitor_first_name;
    $obj->visitor_last_name = $request->new_visitor_last_name;
    $obj->mobile_number = $request->new_phone_no;
    $obj->email = $request->new_email;

    $obj->update();
    return redirect()->back()->with('success','You have successfully updated an Visitor');
   }

   
   function updateVisitorStatus(Request $req)
   {
    $id = $req->user_id;
    $status = $req->status_value;
    $obj = Visitor::findOrFail($id);

    if($status == 'active')
    {
        $obj->status = 'inactive';
    }else{
        $obj->status = 'active';
    }
    
    $obj->update();
    
    return redirect()->back()->with('success','Status changed Successfully');
   }

   function getVisitorAppointments($id)
   {
        $data = DB::table('activities')
        ->join('officers','activities.officer_id','=','officers.id')
        ->join('visitors','activities.visitor_id','=','visitors.id')
        ->where('visitor_id','=',$id)
        ->where('type','=','Appointment')
        ->get();

       return response()->json([
        'data'=>$data,
    ]);
   }
}
