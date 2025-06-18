<?php

namespace App\Http\Controllers;

use App\Models\Synclog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('./dashboard/index', [
            'title' => 'Dashboard',
            'logs' => Synclog::all(),
            'syncLogs' => Synclog::whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('synclogs')
                    ->whereIn('process_name', ['sheetnames', 'questionmedias', 'filemedias'])
                    ->groupBy('process_name');
            })->get()
        ]);
    }

    public function detail($id)
    {
        $synclog = Synclog::with('synclogs_details')->findOrFail($id);

        return view('./dashboard/detail', [
            'title' => 'Synclog Detail',
            'synclog' => $synclog,
            'details' => $synclog->synclogs_details,
        ]);
    }
}
