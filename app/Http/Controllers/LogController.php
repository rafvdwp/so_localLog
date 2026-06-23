<?php

namespace App\Http\Controllers;

use App\Models\LogEntry;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class LogController extends Controller
{

    private const LAST_SEEN_OPTIONS = [
        '5m'   => 5,
        '15m'  => 15,
        '30m'  => 30,
        '1h'   => 60,
        '1d'   => 60 * 24,
        '1w'   => 60 * 24 * 7,
        '1mo'  => 60 * 24 * 30,
        '1y'   => 60 * 24 * 365,
    ];

    public function reset(Request $request)
    {
        $request->validate([
            'confirmation' => ['required', 'string'],
        ]);

        if ($request->input('confirmation') !== 'Delete') {
            return back()->withErrors([
                'confirmation' => 'Confirmation text did not match. Type "Delete" exactly to clear all logs.',
            ]);
        }

        LogEntry::truncate();

        return redirect()
            ->route('logs.index')
            ->with('status', 'All log entries have been permanently deleted.');
    }

    public function index(Request $request)
    {
        $query = LogEntry::with('server')->orderBy('logged_at', 'desc');

        $this->applyLevelFilter($query, $request);
        $this->applySearchFilter($query, $request);
        $this->applyLastSeenFilter($query, $request);

        $logs = $query->paginate(30)->withQueryString();

        $stats = $this->buildStats($request);

        return view('logs.index', [
            'logs'             => $logs,
            'stats'            => $stats,
            'lastSeenOptions'  => self::LAST_SEEN_OPTIONS,
        ]);
    }

    private function applyLevelFilter(Builder $query, Request $request): void
    {
        if ($request->filled('level')) {
            $query->where('level', $request->string('level'));
        }
    }

    private function applySearchFilter(Builder $query, Request $request): void
    {
        if ($request->filled('search')) {
            $term = trim($request->string('search'));

            $query->whereRaw('LOWER(message) LIKE ?', ['%' . strtolower($term) . '%']);
        }
    }

    private function applyLastSeenFilter(Builder $query, Request $request): void
    {
        $range = $request->string('last_seen')->toString();

        if ($range !== '' && isset(self::LAST_SEEN_OPTIONS[$range])) {
            $minutes = self::LAST_SEEN_OPTIONS[$range];
            $query->where('created_at', '>=', now()->subMinutes($minutes));
        }
    }

    private function buildStats(Request $request): array
    {
        $base = LogEntry::query();

        $range = $request->string('last_seen')->toString();
        if ($range !== '' && isset(self::LAST_SEEN_OPTIONS[$range])) {
            $minutes = self::LAST_SEEN_OPTIONS[$range];
            $base->where('created_at', '>=', now()->subMinutes($minutes));
        }

        return [
            'total'   => $base->clone()->count(),
            'error'   => $base->clone()->where('level', 'error')->count(),
            'warning' => $base->clone()->where('level', 'warning')->count(),
            'info'    => $base->clone()->where('level', 'info')->count(),
        ];
    }
}