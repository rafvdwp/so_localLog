<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Log Server</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-4 py-8">

    <!-- Header -->
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Monitoring Log Server</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Total Log</p>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Error</p>
            <p class="text-2xl font-bold text-red-600">{{ $stats['error'] }}</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Warning</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['warning'] }}</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Info</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['info'] }}</p>
        </div>
    </div>

    <!-- Filter -->
    <form method="GET" class="bg-white rounded-lg p-4 shadow-sm mb-4 flex gap-3">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari pesan log..."
               class="border rounded-lg px-3 py-2 flex-1 text-sm">
        <select name="level" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Level</option>
            <option value="info"    {{ request('level') == 'info'    ? 'selected' : '' }}>Info</option>
            <option value="warning" {{ request('level') == 'warning' ? 'selected' : '' }}>Warning</option>
            <option value="error"   {{ request('level') == 'error'   ? 'selected' : '' }}>Error</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
        <a href="/" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">Reset</a>
    </form>

    <!-- Tabel Log -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Waktu</th>
                    <th class="px-4 py-3 text-left">Server</th>
                    <th class="px-4 py-3 text-left">Level</th>
                    <th class="px-4 py-3 text-left">Pesan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-500 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($log->logged_at)->format('d M Y H:i:s') }}
                    </td>
                    <td class="px-4 py-3 font-medium">{{ $log->server->name ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @if($log->level == 'error')
                            <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-medium">ERROR</span>
                        @elseif($log->level == 'warning')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded text-xs font-medium">WARNING</span>
                        @else
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-medium">INFO</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-700">{{ Str::limit($log->message, 120) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada log. Jalankan: php artisan logs:fetch</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $logs->withQueryString()->links() }}
    </div>

</div>
</body>
</html>