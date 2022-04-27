<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return $request;
    }
}
