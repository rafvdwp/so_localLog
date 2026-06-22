<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In &middot; Log Monitoring</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

<div class="flex min-h-screen items-center justify-center px-4">
    <div class="w-full max-w-sm">

        {{-- Brand --}}
        <div class="flex items-center justify-center gap-3 mb-8">
            <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                <path d="M5.2 18L0 9L5.2 0H15.6L20.8 9L15.6 18H5.2Z" fill="#0050D5"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-slate-800 leading-tight">Log Monitoring</p>
                <p class="text-xs text-slate-500 leading-tight">Observability Platform</p>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200/60 bg-white shadow-sm p-8">
            <h1 class="text-xl font-bold text-slate-900 mb-1">Sign in</h1>
            <p class="text-sm text-slate-500 mb-6">Sign in to manage log data.</p>

            @if ($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="flex flex-col gap-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@gmail.com"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-300">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <input id="password" type="password" name="password" required
                           placeholder="••••••••"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-300">
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600 select-none">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-200">
                    Remember me
                </label>

                <button type="submit"
                        class="mt-2 w-full rounded-full bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition-colors">
                    Sign In
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-slate-500">
            <a href="{{ route('logs.index') }}" class="text-blue-600 hover:underline">&larr; Back to dashboard</a>
        </p>
    </div>
</div>

</body>
</html>