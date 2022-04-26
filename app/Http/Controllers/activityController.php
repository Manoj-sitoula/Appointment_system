<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class activityController extends Controller
{
    function getActivitiesDetails()
    {
        $data = Activity::paginate(10);
        return view('activity',['value'=>$data]);
    }
}
