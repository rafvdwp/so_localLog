<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Monitoring &middot; Observability Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

<div class="min-h-screen">

    {{-- ============================== SIDEBAR TOGGLE BUTTON ============================== --}}
    <button id="sidebarToggle" type="button" aria-label="Toggle sidebar" aria-expanded="false"
            class="fixed left-4 top-1/2 -translate-y-1/2 z-50 flex h-11 w-11 items-center justify-center rounded-full bg-white border border-slate-200 shadow-lg shadow-slate-900/10 text-slate-500 hover:text-blue-600 hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-200">
        <svg id="sidebarToggleIcon" width="9" height="14" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg"
             class="transition-transform duration-300">
            <path d="M3.83333 5L0 1.16667L1.16667 0L6.16667 5L1.16667 10L0 8.83333L3.83333 5Z" fill="currentColor"/>
        </svg>
    </button>

    {{-- ============================== SIDEBAR BACKDROP ============================== --}}
    <div id="sidebarBackdrop"
         class="fixed inset-0 z-30 bg-slate-900/30 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300"></div>

    {{-- ============================== SIDEBAR ============================== --}}
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 flex flex-col w-72 shrink-0 bg-[#eff1f2] border-r border-slate-200/60 p-4 -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl">
        <div class="flex flex-col h-full">

            {{-- Brand --}}
            <div class="flex items-center gap-3 px-2 py-3 mb-6">
                <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                    <path d="M5.2 18L0 9L5.2 0H15.6L20.8 9L15.6 18H5.2Z" fill="#0050D5"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-slate-800 leading-tight">Log Monitoring</p>
                    <p class="text-xs text-slate-500 leading-tight">Observability Platform</p>
                </div>
            </div>

            {{-- Primary nav --}}
            <nav class="flex flex-col gap-2">
                <a href="{{ route('logs.index') }}"
                   class="flex items-center gap-3 rounded-full px-4 py-3 bg-[#7b9cff]/20 text-[#0050d5] text-sm font-medium">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                        <path d="M10 6V0H18V6H10ZM0 10V0H8V10H0ZM10 18V8H18V18H10ZM0 18V12H8V18H0Z" fill="#0050D5"/>
                    </svg>
                    <span>Overview</span>
                </a>
            </nav>

            {{-- Secondary nav, pushed to the bottom --}}
            <div class="mt-auto pt-4 border-t border-slate-300/30 flex flex-col gap-2">
                <span class="flex items-center gap-3 rounded-full px-4 py-3 text-sm text-slate-500 cursor-default select-none">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                        <path d="M5.80417 9.33333C6.00833 9.33333 6.1809 9.26285 6.32188 9.12187C6.46285 8.9809 6.53333 8.80833 6.53333 8.60417C6.53333 8.4 6.46285 8.22743 6.32188 8.08646C6.1809 7.94549 6.00833 7.875 5.80417 7.875C5.6 7.875 5.42743 7.94549 5.28646 8.08646C5.14549 8.22743 5.075 8.4 5.075 8.60417C5.075 8.80833 5.14549 8.9809 5.28646 9.12187C5.42743 9.26285 5.6 9.33333 5.80417 9.33333ZM5.27917 7.0875H6.35833C6.35833 6.76667 6.39479 6.51389 6.46771 6.32917C6.54062 6.14444 6.74722 5.89167 7.0875 5.57083C7.34028 5.31806 7.53958 5.07743 7.68542 4.84896C7.83125 4.62049 7.90417 4.34583 7.90417 4.025C7.90417 3.48056 7.70486 3.0625 7.30625 2.77083C6.90764 2.47917 6.43611 2.33333 5.89167 2.33333C5.3375 2.33333 4.88785 2.47917 4.54271 2.77083C4.19757 3.0625 3.95694 3.4125 3.82083 3.82083L4.78333 4.2C4.83194 4.025 4.94132 3.83542 5.11146 3.63125C5.2816 3.42708 5.54167 3.325 5.89167 3.325C6.20278 3.325 6.43611 3.41007 6.59167 3.58021C6.74722 3.75035 6.825 3.9375 6.825 4.14167C6.825 4.33611 6.76667 4.5184 6.65 4.68854C6.53333 4.85868 6.3875 5.01667 6.2125 5.1625C5.78472 5.54167 5.52222 5.82847 5.425 6.02292C5.32778 6.21736 5.27917 6.57222 5.27917 7.0875ZM5.83333 11.6667C5.02639 11.6667 4.26806 11.5135 3.55833 11.2073C2.84861 10.901 2.23125 10.4854 1.70625 9.96042C1.18125 9.43542 0.765625 8.81806 0.459375 8.10833C0.153125 7.39861 0 6.64028 0 5.83333C0 5.02639 0.153125 4.26806 0.459375 3.55833C0.765625 2.84861 1.18125 2.23125 1.70625 1.70625C2.23125 1.18125 2.84861 0.765625 3.55833 0.459375C4.26806 0.153125 5.02639 0 5.83333 0C6.64028 0 7.39861 0.153125 8.10833 0.459375C8.81806 0.765625 9.43542 1.18125 9.96042 1.70625C10.4854 2.23125 10.901 2.84861 11.2073 3.55833C11.5135 4.26806 11.6667 5.02639 11.6667 5.83333C11.6667 6.64028 11.5135 7.39861 11.2073 8.10833C10.901 8.81806 10.4854 9.43542 9.96042 9.96042C9.43542 10.4854 8.81806 10.901 8.10833 11.2073C7.39861 11.5135 6.64028 11.6667 5.83333 11.6667ZM5.83333 10.5C7.13611 10.5 8.23958 10.0479 9.14375 9.14375C10.0479 8.23958 10.5 7.13611 10.5 5.83333C10.5 4.53056 10.0479 3.42708 9.14375 2.52292C8.23958 1.61875 7.13611 1.16667 5.83333 1.16667C4.53056 1.16667 3.42708 1.61875 2.52292 2.52292C1.61875 3.42708 1.16667 4.53056 1.16667 5.83333C1.16667 7.13611 1.61875 8.23958 2.52292 9.14375C3.42708 10.0479 4.53056 10.5 5.83333 10.5Z" fill="#595C5D"/>
                    </svg>
                    <span>Support</span>
                </span>
                <span class="flex items-center gap-3 rounded-full px-4 py-3 text-sm text-slate-500 cursor-default select-none">
                    <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                        <path d="M2.33333 9.33333H7V8.16667H2.33333V9.33333ZM2.33333 7H7V5.83333H2.33333V7ZM1.16667 11.6667C0.845833 11.6667 0.571181 11.5524 0.342708 11.324C0.114236 11.0955 0 10.8208 0 10.5V1.16667C0 0.845833 0.114236 0.571181 0.342708 0.342708C0.571181 0.114236 0.845833 0 1.16667 0H5.83333L9.33333 3.5V10.5C9.33333 10.8208 9.2191 11.0955 8.99063 11.324C8.76215 11.5524 8.4875 11.6667 8.16667 11.6667H1.16667ZM5.25 4.08333V1.16667H1.16667V10.5H8.16667V4.08333H5.25ZM1.16667 1.16667V4.08333V1.16667V4.08333V10.5V1.16667Z" fill="#595C5D"/>
                    </svg>
                    <span>Documentation</span>
                </span>

                @guest
                    <a href="{{ route('login') }}"
                       class="flex items-center gap-3 rounded-full px-4 py-3 mt-2 border-t border-slate-300/30 pt-4 text-sm font-medium text-blue-600 hover:bg-blue-50/60 transition-colors">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                            <path d="M10 11.3333L13.3333 8L10 4.66667L9.06667 5.6L10.8 7.33333H4V8.66667H10.8L9.06667 10.4L10 11.3333ZM2.66667 14C2.3 14 1.98611 13.8694 1.72 13.6083C1.45889 13.3472 1.32833 13.0333 1.33 12.6667V3.33333C1.33 2.96667 1.46056 2.65278 1.72167 2.39167C1.98278 2.13056 2.29667 2 2.66667 2H8V3.33333H2.66667V12.6667H8V14H2.66667Z" fill="#0050D5"/>
                        </svg>
                        <span>Login</span>
                    </a>
                @else
                    <div class="flex items-center gap-3 px-4 py-3 mt-2 border-t border-slate-300/30 pt-4">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-semibold text-blue-700">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </span>
                        <span class="text-sm font-medium text-slate-700 truncate">{{ auth()->user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 rounded-full px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50/60 transition-colors">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                                <path d="M6 11.3333L2.66667 8L6 4.66667L6.93333 5.6L5.2 7.33333H12V8.66667H5.2L6.93333 10.4L6 11.3333ZM13.3333 14C12.9667 14 12.6528 13.8694 12.3917 13.6083C12.1306 13.3472 12 13.0333 12 12.6667V3.33333C12 2.96667 12.1306 2.65278 12.3917 2.39167C12.6528 2.13056 12.9667 2 13.3333 2H14.6667V3.33333H13.3333V12.6667H14.6667V14H13.3333Z" fill="#DC2626" transform="scale(-1,1) translate(-16,0)"/>
                            </svg>
                            <span>Sign Out</span>
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </aside>

    {{-- ============================== MAIN CONTENT ============================== --}}
    <main class="px-4 sm:px-8 pl-16 sm:pl-20 py-8 max-w-screen-2xl mx-auto w-full">

        {{-- Header --}}
        <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Overview</h1>
                <p class="text-sm text-slate-500 mt-1">Real-time log ingestion.</p>
            </div>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        @error('confirmation')
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                {{ $message }}
            </div>
        @enderror

        {{-- KPI cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <div class="group rounded-3xl border border-slate-200/60 p-6 bg-gradient-to-br from-[#ddf4d7]/40 to-[#115ffb]/10 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-900/10 hover:border-blue-200">
                <div class="flex items-start justify-between">
                    <p class="text-sm font-medium text-slate-600">Total Logs</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#7b9cff]/20 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:rotate-6">
                        <svg width="20" height="20" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 26C14.4833 26 12.3542 25.6125 10.6125 24.8375C8.87083 24.0625 8 23.1167 8 22V12C8 10.9 8.87917 9.95833 10.6375 9.175C12.3958 8.39167 14.5167 8 17 8C19.4833 8 21.6042 8.39167 23.3625 9.175C25.1208 9.95833 26 10.9 26 12V22C26 23.1167 25.1292 24.0625 23.3875 24.8375C21.6458 25.6125 19.5167 26 17 26ZM17 14.025C18.4833 14.025 19.975 13.8125 21.475 13.3875C22.975 12.9625 23.8167 12.5083 24 12.025C23.8167 11.5417 22.9792 11.0833 21.4875 10.65C19.9958 10.2167 18.5 10 17 10C15.4833 10 13.9958 10.2125 12.5375 10.6375C11.0792 11.0625 10.2333 11.525 10 12.025C10.2333 12.525 11.0792 12.9833 12.5375 13.4C13.9958 13.8167 15.4833 14.025 17 14.025Z" fill="#0050D5"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format($stats['total']) }}</p>
            </div>

            <div class="group rounded-3xl border border-slate-200/60 p-6 bg-gradient-to-br from-white to-[#ffd7e5] transition-all duration-300 ease-out hover:-translate-y-1.5 hover:shadow-xl hover:shadow-red-900/10 hover:border-red-200">
                <div class="flex items-start justify-between">
                    <p class="text-sm font-medium text-slate-600">Errors</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#fb5151]/20 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:rotate-6">
                        <svg width="18" height="18" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 23C18.2833 23 18.5208 22.9042 18.7125 22.7125C18.9042 22.5208 19 22.2833 19 22C19 21.7167 18.9042 21.4792 18.7125 21.2875C18.5208 21.0958 18.2833 21 18 21C17.7167 21 17.4792 21.0958 17.2875 21.2875C17.0958 21.4792 17 21.7167 17 22C17 22.2833 17.0958 22.5208 17.2875 22.7125C17.4792 22.9042 17.7167 23 18 23ZM17 19H19V13H17V19ZM18 28C16.6167 28 15.3167 27.7375 14.1 27.2125C12.8833 26.6875 11.825 25.975 10.925 25.075C10.025 24.175 9.3125 23.1167 8.7875 21.9C8.2625 20.6833 8 19.3833 8 18C8 16.6167 8.2625 15.3167 8.7875 14.1C9.3125 12.8833 10.025 11.825 10.925 10.925C11.825 10.025 12.8833 9.3125 14.1 8.7875C15.3167 8.2625 16.6167 8 18 8C19.3833 8 20.6833 8.2625 21.9 8.7875C23.1167 9.3125 24.175 10.025 25.075 10.925C25.975 11.825 26.6875 12.8833 27.2125 14.1C27.7375 15.3167 28 16.6167 28 18C28 19.3833 27.7375 20.6833 27.2125 21.9C26.6875 23.1167 25.975 24.175 25.075 25.075C24.175 25.975 23.1167 26.6875 21.9 27.2125C20.6833 27.7375 19.3833 28 18 28Z" fill="#B31B25"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-bold text-slate-900">{{ number_format($stats['error']) }}</p>
            </div>

            <div class="group rounded-3xl border border-amber-200/60 p-6 bg-gradient-to-br from-amber-50 to-amber-100/60 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:shadow-xl hover:shadow-amber-900/10 hover:border-amber-300">
                <div class="flex items-start justify-between">
                    <p class="text-sm font-medium text-slate-600">Warnings</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-amber-400/30 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:rotate-6">
                        <svg width="19" height="18" viewBox="0 0 38 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 25L19 6L30 25H8ZM11.45 23H26.55L19 10L11.45 23ZM19 22C19.2833 22 19.5208 21.9042 19.7125 21.7125C19.9042 21.5208 20 21.2833 20 21C20 20.7167 19.9042 20.4792 19.7125 20.2875C19.5208 20.0958 19.2833 20 19 20C18.7167 20 18.4792 20.0958 18.2875 20.2875C18.0958 20.4792 18 20.7167 18 21C18 21.2833 18.0958 21.5208 18.2875 21.7125C18.4792 21.9042 18.7167 22 19 22ZM18 19H20V14H18V19Z" fill="#B45309"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-bold text-amber-700">{{ number_format($stats['warning']) }}</p>
            </div>

            <div class="group rounded-3xl border border-emerald-200/60 p-6 bg-gradient-to-br from-emerald-50 to-emerald-100/60 transition-all duration-300 ease-out hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-900/10 hover:border-emerald-300">
                <div class="flex items-start justify-between">
                    <p class="text-sm font-medium text-slate-600">Info</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-400/30 transition-transform duration-300 ease-out group-hover:scale-110 group-hover:rotate-6">
                        <svg width="18" height="18" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 23H19V17H17V23ZM18 15C18.2833 15 18.5208 14.9042 18.7125 14.7125C18.9042 14.5208 19 14.2833 19 14C19 13.7167 18.9042 13.4792 18.7125 13.2875C18.5208 13.0958 18.2833 13 18 13C17.7167 13 17.4792 13.0958 17.2875 13.2875C17.0958 13.4792 17 13.7167 17 14C17 14.2833 17.0958 14.5208 17.2875 14.7125C17.4792 14.9042 17.7167 15 18 15ZM18 28C16.6167 28 15.3167 27.7375 14.1 27.2125C12.8833 26.6875 11.825 25.975 10.925 25.075C10.025 24.175 9.3125 23.1167 8.7875 21.9C8.2625 20.6833 8 19.3833 8 18C8 16.6167 8.2625 15.3167 8.7875 14.1C9.3125 12.8833 10.025 11.825 10.925 10.925C11.825 10.025 12.8833 9.3125 14.1 8.7875C15.3167 8.2625 16.6167 8 18 8C19.3833 8 20.6833 8.2625 21.9 8.7875C23.1167 9.3125 24.175 10.025 25.075 10.925C25.975 11.825 26.6875 12.8833 27.2125 14.1C27.7375 15.3167 28 16.6167 28 18C28 19.3833 27.7375 20.6833 27.2125 21.9C26.6875 23.1167 25.975 24.175 25.075 25.075C24.175 25.975 23.1167 26.6875 21.9 27.2125C20.6833 27.7375 19.3833 28 18 28Z" fill="#047857"/>
                        </svg>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-bold text-emerald-700">{{ number_format($stats['info']) }}</p>
            </div>
        </div>

        {{-- ============================== FILTER BAR ============================== --}}
        <form method="GET" action="{{ route('logs.index') }}"
              class="flex flex-wrap items-center gap-3 mb-6">

            {{-- Search --}}
            <div class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2.5 flex-1 min-w-[220px]">
                <svg width="16" height="16" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 text-slate-400">
                    <path d="M16.6 18L10.3 11.7C9.8 12.1 9.225 12.4167 8.575 12.65C7.925 12.8833 7.23333 13 6.5 13C4.68333 13 3.14583 12.3708 1.8875 11.1125C0.629167 9.85417 0 8.31667 0 6.5C0 4.68333 0.629167 3.14583 1.8875 1.8875C3.14583 0.629167 4.68333 0 6.5 0C8.31667 0 9.85417 0.629167 11.1125 1.8875C12.3708 3.14583 13 4.68333 13 6.5C13 7.23333 12.8833 7.925 12.65 8.575C12.4167 9.225 12.1 9.8 11.7 10.3L18 16.6L16.6 18ZM6.5 11C7.75 11 8.8125 10.5625 9.6875 9.6875C10.5625 8.8125 11 7.75 11 6.5C11 5.25 10.5625 4.1875 9.6875 3.3125C8.8125 2.4375 7.75 2 6.5 2C5.25 2 4.1875 2.4375 3.3125 3.3125C2.4375 4.1875 2 5.25 2 6.5C2 7.75 2.4375 8.8125 3.3125 9.6875C4.1875 10.5625 5.25 11 6.5 11Z" fill="currentColor"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search log message…"
                       class="w-full bg-transparent text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none">
            </div>

            {{-- Level filter --}}
            <select name="level"
                    class="rounded-full border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <option value="">All Levels</option>
                <option value="info"    {{ request('level') == 'info'    ? 'selected' : '' }}>Info</option>
                <option value="warning" {{ request('level') == 'warning' ? 'selected' : '' }}>Warning</option>
                <option value="error"   {{ request('level') == 'error'   ? 'selected' : '' }}>Error</option>
            </select>

            {{-- Last seen filter --}}
            <select name="last_seen"
                    class="rounded-full border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <option value="">Last Seen: Any time</option>
                <option value="5m"  {{ request('last_seen') == '5m'  ? 'selected' : '' }}>Last 5 minutes</option>
                <option value="15m" {{ request('last_seen') == '15m' ? 'selected' : '' }}>Last 15 minutes</option>
                <option value="30m" {{ request('last_seen') == '30m' ? 'selected' : '' }}>Last 30 minutes</option>
                <option value="1h"  {{ request('last_seen') == '1h'  ? 'selected' : '' }}>Last 1 hour</option>
                <option value="1d"  {{ request('last_seen') == '1d'  ? 'selected' : '' }}>Last 1 day</option>
                <option value="1w"  {{ request('last_seen') == '1w'  ? 'selected' : '' }}>Last 1 week</option>
                <option value="1mo" {{ request('last_seen') == '1mo' ? 'selected' : '' }}>Last 1 month</option>
                <option value="1y"  {{ request('last_seen') == '1y'  ? 'selected' : '' }}>Last 1 year</option>
            </select>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                <button type="submit"
                        class="rounded-full border border-blue-200 bg-white px-5 py-2.5 text-sm font-medium text-blue-600 hover:bg-blue-100 transition-colors">
                    Filter
                </button>
                @auth
                    {{-- <a href="{{ route('logs.index') }}"
                       class="rounded-full bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 transition-colors">
                        Reset
                    </a> --}}
                    <button type="button" id="openClearLogsModal"
                            class="rounded-full border border-red-200 bg-white px-5 py-2.5 text-sm font-medium text-red-600 hover:bg-red-100 transition-colors">
                        Clear All Logs
                    </button>
                @endauth
            </div>
        </form>

        {{-- ============================== LOG TABLE ============================== --}}
        <div class="rounded-3xl border border-slate-200/60 bg-white shadow-sm overflow-hidden">

            <div class="flex items-center justify-between border-b border-slate-200/60 bg-slate-50/60 px-6 py-4">
                <h2 class="text-sm font-semibold text-slate-700">Live Log Stream</h2>
                <span class="text-xs text-slate-400">Auto-refreshes every 30s</span>
            </div>

            <div class="overflow-x-auto overflow-y-auto max-h-[600px]">
                <table class="w-full text-sm table-fixed">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wide sticky top-0 z-10">
                        <tr>
                            <th class="w-44 px-6 py-3 text-left font-medium">Timestamp</th>
                            <th class="w-28 px-6 py-3 text-left font-medium">Level</th>
                            <th class="w-44 px-6 py-3 text-left font-medium">Service</th>
                            <th class="px-6 py-3 text-left font-medium">Message</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($logs as $log)
                            @php
                                $rowClasses = match($log->level) {
                                    'error'   => 'border-l-2 border-[#B31B25] bg-[#B31B25]/[0.04]',
                                    'warning' => 'border-l-2 border-transparent',
                                    default   => 'border-l-2 border-transparent',
                                };

                                $badgeClasses = match($log->level) {
                                    'error'   => 'bg-red-500 text-white',
                                    'warning' => 'bg-amber-100 text-amber-700',
                                    default   => 'bg-emerald-100 text-emerald-700',
                                };
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors {{ $rowClasses }} align-top">
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-500">
                                    {{ \Carbon\Carbon::parse($log->logged_at)->format('d M Y H:i:s') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeClasses }}">
                                        {{ strtoupper($log->level) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-700 whitespace-nowrap truncate">
                                    {{ $log->server->name ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 whitespace-normal break-words">
                                    {{ $log->message }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                    No logs yet. Run <code class="rounded bg-slate-100 px-1.5 py-0.5 text-xs">php artisan logs:fetch</code> to ingest some.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer / pagination --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-t border-slate-200/60 px-6 py-4">
                <p class="text-xs text-slate-500">
                    Showing {{ $logs->firstItem() ?? 0 }}–{{ $logs->lastItem() ?? 0 }} of {{ number_format($logs->total()) }} logs
                </p>
                {{ $logs->links() }}
            </div>
        </div>
    </main>
</div>

{{-- ============================== CLEAR ALL LOGS — CONFIRMATION MODAL ============================== --}}
@auth
    <div id="clearLogsBackdrop"
         class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4">
        <div id="clearLogsModal"
             class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">

            <div class="flex items-start gap-3 mb-4">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                    <svg width="18" height="18" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 23C18.2833 23 18.5208 22.9042 18.7125 22.7125C18.9042 22.5208 19 22.2833 19 22C19 21.7167 18.9042 21.4792 18.7125 21.2875C18.5208 21.0958 18.2833 21 18 21C17.7167 21 17.4792 21.0958 17.2875 21.2875C17.0958 21.4792 17 21.7167 17 22C17 22.2833 17.0958 22.5208 17.2875 22.7125C17.4792 22.9042 17.7167 23 18 23ZM17 19H19V13H17V19ZM18 28C16.6167 28 15.3167 27.7375 14.1 27.2125C12.8833 26.6875 11.825 25.975 10.925 25.075C10.025 24.175 9.3125 23.1167 8.7875 21.9C8.2625 20.6833 8 19.3833 8 18C8 16.6167 8.2625 15.3167 8.7875 14.1C9.3125 12.8833 10.025 11.825 10.925 10.925C11.825 10.025 12.8833 9.3125 14.1 8.7875C15.3167 8.2625 16.6167 8 18 8C19.3833 8 20.6833 8.2625 21.9 8.7875C23.1167 9.3125 24.175 10.025 25.075 10.925C25.975 11.825 26.6875 12.8833 27.2125 14.1C27.7375 15.3167 28 16.6167 28 18C28 19.3833 27.7375 20.6833 27.2125 21.9C26.6875 23.1167 25.975 24.175 25.075 25.075C24.175 25.975 23.1167 26.6875 21.9 27.2125C20.6833 27.7375 19.3833 28 18 28Z" fill="#B31B25"/>
                    </svg>
                </span>
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Clear all log entries?</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        This will permanently delete <strong>all</strong> log entries from the database.
                        This action cannot be undone.
                    </p>
                </div>
            </div>

            <form id="clearLogsForm" method="POST" action="{{ route('logs.reset') }}">
                @csrf
                @method('DELETE')

                <label for="confirmationInput" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Type <span class="font-mono font-semibold text-red-600">Delete</span> to confirm
                </label>
                <input type="text" id="confirmationInput" name="confirmation" autocomplete="off"
                       placeholder="Delete"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-red-200">

                <div class="mt-6 flex items-center justify-end gap-2">
                    <button type="button" id="cancelClearLogs"
                            class="rounded-full px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" id="confirmClearLogs" disabled
                            class="rounded-full bg-red-600 px-5 py-2.5 text-sm font-medium text-white opacity-50 cursor-not-allowed transition-colors">
                        Delete all logs
                    </button>
                </div>
            </form>
        </div>
    </div>
@endauth

<script>
    (function () {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('sidebarToggleIcon');
        const backdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            toggleIcon.style.transform = 'rotate(180deg)';
            toggleBtn.setAttribute('aria-expanded', 'true');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
            toggleIcon.style.transform = 'rotate(0deg)';
            toggleBtn.setAttribute('aria-expanded', 'false');
        }

        function isOpen() {
            return !sidebar.classList.contains('-translate-x-full');
        }

        toggleBtn.addEventListener('click', function () {
            isOpen() ? closeSidebar() : openSidebar();
        });

        backdrop.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen()) {
                closeSidebar();
            }
        });
    })();

    // ============================== CLEAR ALL LOGS MODAL ==============================
    (function () {
        const openBtn = document.getElementById('openClearLogsModal');
        if (!openBtn) return; // not authenticated, modal isn't rendered

        const backdrop = document.getElementById('clearLogsBackdrop');
        const cancelBtn = document.getElementById('cancelClearLogs');
        const confirmBtn = document.getElementById('confirmClearLogs');
        const input = document.getElementById('confirmationInput');
        const REQUIRED_TEXT = 'Delete';

        function openModal() {
            backdrop.classList.remove('hidden');
            backdrop.classList.add('flex');
            input.value = '';
            updateConfirmState();
            input.focus();
        }

        function closeModal() {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
            input.value = '';
            updateConfirmState();
        }

        function updateConfirmState() {
            const matches = input.value === REQUIRED_TEXT;
            confirmBtn.disabled = !matches;
            confirmBtn.classList.toggle('opacity-50', !matches);
            confirmBtn.classList.toggle('cursor-not-allowed', !matches);
        }

        openBtn.addEventListener('click', openModal);
        cancelBtn.addEventListener('click', closeModal);
        input.addEventListener('input', updateConfirmState);

        backdrop.addEventListener('click', function (e) {
            if (e.target === backdrop) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !backdrop.classList.contains('hidden')) {
                closeModal();
            }
        });
    })();
</script>

</body>
</html>