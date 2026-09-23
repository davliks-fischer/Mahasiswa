<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth; // <-- INI YANG KELEWAT

class ActivityLogController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dataLog = ActivityLog::with('user')
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);

        return view('admin.kelola_log_aktivitas', compact('user', 'dataLog'));
    }
}