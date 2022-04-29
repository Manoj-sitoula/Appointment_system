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
        $activity['a'] = Activity::join('officers','activities.officer_id','=','officers.id')
        ->join('visitors','activities.visitor_id','=','visitors.id')
        ->get();

        $activity['b'] = DB::table('officers')->get()->all();

        $activity['c'] = DB::table('visitors')->get()->all();

        return view('activity',['value'=>$activity]);

    }

    function insertActivity(Request $request)
    {
        $request->validate([
            'officer_id' => 'bail|required', 
            'name' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $data = Activity::get();


    }
}
