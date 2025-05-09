<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    //
    public function index(){
        $activity = Activity::latest()->get();
        return view('activity.index')->with('activitys',$activity);
    }
}
