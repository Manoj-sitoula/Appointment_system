<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class activityController extends Controller
{
    function getActivitiesDetails()
    {
        // $activitydata = Activity::paginate(10);
        // return view('activity',['value'=>$activitydata]);

        $activitydata = DB::table('officers')
        ->join('activities','activities.officer_id','=','officers.id')
        ->get();

        return view('activity',['value'=>$activitydata]);
    }
}
