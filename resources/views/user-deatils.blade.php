<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Quizzes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <x-usernavbar></x-usernavbar>

    <!-- Header -->
    <div style="background:linear-gradient(135deg,#6366f1 0%,#8b5cf6 40%,#ec4899 100%);" class="text-white py-12 px-6 text-center">
        <div class="text-4xl mb-3">👤</div>
        <h1 class="text-3xl font-extrabold mb-1">{{ Session::get('user')->name }}</h1>
        <p class="text-indigo-100 text-sm">{{ Session::get('user')->email }}</p>
    </div>

    <div class="max-w-5xl mx-auto w-full px-6 py-10 flex-1">

        <!-- User Info Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <h2 class="font-bold text-gray-700 mb-4">Profile Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">Name</p>
                    <p class="font-semibold text-slate-700">{{ Session::get('user')->name }}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">Email</p>
                    <p class="font-semibold text-slate-700 text-sm">{{ Session::get('user')->email }}</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">Account Status</p>
                    @if(Session::get('user')->active == 2)
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">✓ Verified</span>
                    @else
                        <span class="text-xs font-bold text-orange-500 bg-orange-50 px-3 py-1 rounded-full">⏳ Pending</span>
                    @endif
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">Member Since</p>
                    <p class="font-semibold text-slate-700 text-sm">{{ Session::get('user')->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        @php
            $totalAttempted = count($quizrecords);
            $totalCompleted = $quizrecords->where('status', 2)->count();
            $totalIncomplete = $quizrecords->where('status', '!=', 2)->count();
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-2xl">📝</div>
                <div>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $totalAttempted }}</p>
                    <p class="text-slate-400 text-xs mt-0.5">Total Attempted</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-2xl">✓</div>
                <div>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $totalCompleted }}</p>
                    <p class="text-slate-400 text-xs mt-0.5">Completed</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center text-2xl">⏳</div>
                <div>
                    <p class="text-2xl font-extrabold text-slate-800">{{ $totalIncomplete }}</p>
                    <p class="text-slate-400 text-xs mt-0.5">Incomplete</p>
                </div>
            </div>
        </div>

        <!-- Quiz History -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-bold text-gray-700">Quiz History</h2>
                <span class="text-xs text-gray-400">{{ count($quizrecords) }} quizzes</span>
            </div>
            
            @if(count($quizrecords) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-16">#</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Quiz Name</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-32 text-center">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-40">Attempted On</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($quizrecords as $key => $record)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <span class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 text-xs font-bold flex items-center justify-center">
                                    {{ $key + 1 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $record->name }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($record->status == 2)
                                    <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">✓ Completed</span>
                                @else
                                    <span class="text-xs font-bold text-orange-500 bg-orange-50 px-3 py-1 rounded-full">⏳ Incomplete</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">{{ $record->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-6 py-12 text-center">
                <div class="text-5xl mb-3">📝</div>
                <p class="text-slate-400 text-sm">No quizzes attempted yet</p>
                <a href="/" class="inline-block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition">
                    Browse Quizzes
                </a>
            </div>
            @endif
        </div>

        <div class="text-center mt-8">
            <a href="/" class="text-indigo-600 hover:underline text-sm font-semibold">← Back to Home</a>
        </div>
    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
