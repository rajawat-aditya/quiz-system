<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <x-navbar :name="$name"></x-navbar>

    <div class="max-w-6xl mx-auto w-full px-6 py-10 flex-1">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800">👥 Registered Users</h1>
                <p class="text-sm text-slate-400 mt-1">Total: {{ count($users) }} users</p>
            </div>
            <div class="flex gap-3">
                <a href="/export_users"
                    class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition flex items-center gap-2">
                    📥 Export to Excel
                </a>
                <a href="/admin_dashboard"
                    class="bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-sm font-semibold px-4 py-2 rounded-xl transition">
                    ← Back
                </a>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-16">ID</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Name</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Email</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-24 text-center">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-40">Registered</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-bold flex items-center justify-center">
                                {{ $user->id }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-700">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($user->active == 2)
                                <span class="bg-green-50 text-green-600 text-xs font-semibold px-2 py-1 rounded-full">Active</span>
                            @else
                                <span class="bg-orange-50 text-orange-500 text-xs font-semibold px-2 py-1 rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-xs">{{ $user->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
