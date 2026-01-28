<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $data = ActivityLog::latest()->paginate(15);
        return view('activity_logs.index', compact('data'));
    }
}
