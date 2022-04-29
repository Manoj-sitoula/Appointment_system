<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


date_default_timezone_set("Asia/Katmandu");
class activityController extends Controller
{
    function getActivitiesDetails()
    {
        $activity['a'] = Activity::leftjoin('officers','activities.officer_id','=','officers.id')
        ->leftjoin('visitors','activities.visitor_id','=','visitors.id')
        ->get()->all(); 

        $activity['b'] = DB::table('officers')->get()->all();

        $activity['c'] = DB::table('visitors')->get()->all();

        return view('activity',['value'=>$activity]);

    }

    function insertActivity(Request $request)
    {
        $data = Activity::get()->all();
        
        $obj = new Activity();


        if($request->type == "Appointment")
        {
            $request->validate([
                'officer_id' => 'bail|required', 
                'visitor_id' => 'bail|required',
                'name' => 'required',
                'date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
            
        }else
        {
            $request->validate([
                'officer_id' => 'bail|required',
                'name' => 'required',
                'date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
        } 

        if(count($data) > 0)
        {

            $days = DB::table('work_days')
                    ->where('officer_id','=',$request->officer_id)
                    ->get()
                    ->all();

            $requestedDay = strtolower(date("l", strtotime($request->date)));

            $isInWorkDay = false;
            
            foreach ($days as $column => $value)
            {
                if($requestedDay == $value->day_of_week){
                   $isInWorkDay = true;
                   break;
                }
            }

            $officeTime = DB::table('officers')
                        ->where('id','=',$request->officer_id)
                        ->get()
                        ->all();
        
            foreach ($officeTime as $column => $value)
            {
                $officerWorkStartTime = $value->work_start_time ;
                $officerWorkEndTime = $value->work_end_time;
            }


            foreach ($data as $column => $value)
            {
                $officerid = $value->officer_id;
                $visitorid = $value->visitor_id;
                $type = $value->type;
                $status = $value->status;
                $date = $value->date;
                $starttime = $value->start_time;
                $endtime = $value->end_time;
            }

            if($isInWorkDay)
            {
                if($request->start_time >= $officerWorkStartTime && $request-> end_time <= $officerWorkEndTime)
                {
                    
                    if($request->date == $date)
                    {
                        if($request->visitor_id == $visitorid || $request->officer_id == $officerid)
                        {
                            if(((strtotime("$request->start_time") < strtotime("$starttime") && strtotime("$request->end_time") < strtotime("$starttime")) || (strtotime("$request->start_time") > strtotime("$endtime") && strtotime("$request->end_time") > strtotime("$endtime"))) && (strtotime("$request->start_time") < strtotime("$request->end_time")))
                            {
                                $obj->officer_id = $request->officer_id;
                                $obj->visitor_id = $request->visitor_id;
                                $obj->name = $request->name;
                                $obj->type = $request->type;
                                $obj->status = $request->status;
                                $obj->date = $request->date;
                                $obj->start_time = $request->start_time;
                                $obj->end_time = $request->end_time;
                                $obj->added_on = date("Y-m-d h:i:s",time());

                                $obj->save();

                                return redirect()->back()->with('success','You have successfully Inserted an Activity');

                            }else{
                                return redirect()->back()->with('error','Officer or Visitor already has Appointment or Officer is on Break or Leave.');
                            }
                        }else
                        {
                                $obj->officer_id = $request->officer_id;
                                $obj->visitor_id = $request->visitor_id;
                                $obj->name = $request->name;
                                $obj->type = $request->type;
                                $obj->status = $request->status;
                                $obj->date = $request->date;
                                $obj->start_time = $request->start_time;
                                $obj->end_time = $request->end_time;
                                $obj->added_on = date("Y-m-d h:i:s",time());

                                $obj->save();

                                return redirect()->back()->with('success','You have successfully Inserted an Activity');
                        }
                    }else
                    {
                        $obj->officer_id = $request->officer_id;
                        $obj->visitor_id = $request->visitor_id;
                        $obj->name = $request->name;
                        $obj->type = $request->type;
                        $obj->status = $request->status;
                        $obj->date = $request->date;
                        $obj->start_time = $request->start_time;
                        $obj->end_time = $request->end_time;
                        $obj->added_on = date("Y-m-d h:i:s",time());

                        $obj->save();

                        return redirect()->back()->with('success','You have successfully Inserted an Activity');
                    }

                }else
                {
                    return redirect()->back()->with('error',' Officer has no working hour in given time.');
                }
            }else
            {
                return redirect()->back()->with('error',' Officer is not availabe.');
            }
        }else
        {
            $obj->officer_id = $request->officer_id;
            $obj->visitor_id = $request->visitor_id;
            $obj->name = $request->name;
            $obj->type = $request->type;
            $obj->status = $request->status;
            $obj->date = $request->date;
            $obj->start_time = $request->start_time;
            $obj->end_time = $request->end_time;
            $obj->added_on = date("Y-m-d h:i:s",time());

            $obj->save();

            return redirect()->back()->with('success','You have successfully Inserted an Activity');
        }
    }

    function getActivityDetail($id)
    {
        // $activity = Activity::find($id);
        $activity = DB::table('activities')->where('activity_id',$id)->get()->all();
        foreach ($activity as $column => $value)
            {
                $officerid = $value->officer_id ;
                $visitorid = $value->visitor_id;
            }
        $officername = DB::table('officers')->select('officer_first_name','officer_last_name')->where('id',$officerid)->get();
        $visitorname = DB::table('visitors')->select('visitor_first_name','visitor_last_name')->where('id',$visitorid)->get();

        return response()->json([
            'status' => 200,
            'activity' => $activity,
            'officername' => $officername,
            'visitorname' => $visitorname,
        ]);
    }

    function updateActivityStatus(Request $req)
    {
        if($req->status_value == 'active')
        {
            DB::table('activities')->where('activity_id',$req->activity_id)->update(array('status'=> 'inactive'));
        }else
        {
            $statusOfficer = DB::table('officers')->select('officer_status')->where('id',$req->officer_id)->get();
            $statusVisitor = DB::table('visitors')->select('visitor_status')->where('id',$req->visitor_id)->get();
            if($statusOfficer == 'active' && $statusVisitor == 'active')
            {
                DB::table('activities')->where('activity_id',$req->activity_id)->update(array('status'=> 'active'));
            }else{
                return redirect()->back()->with('error','Officer Or Visitor Deactivated');

            }
        }
        
        
        return redirect()->back()->with('success','Status changed Successfully');
    }

    function cancelActivity(Request $req)
    {
        DB::table('activities')->where('activity_id',$req->activity_id)->update(array('status'=> 'cancelled'));
        return redirect()->back()->with('success','Activity Cancelled Successfully');
    }
}
