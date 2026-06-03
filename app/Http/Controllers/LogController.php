<?php
namespace App\Http\Controllers;

use App\Models\LogEntry;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = LogEntry::with('server')->orderBy('logged_at', 'desc');

        // Filter berdasarkan level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->where('message', 'ilike', '%' . $request->search . '%');
        }

        $logs = $query->paginate(50);

        $stats = [
            'total'   => LogEntry::count(),
            'error'   => LogEntry::where('level', 'error')->count(),
            'warning' => LogEntry::where('level', 'warning')->count(),
            'info'    => LogEntry::where('level', 'info')->count(),
        ];

        return view('logs.index', compact('logs', 'stats'));
    }
}