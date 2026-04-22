<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Quizzes</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <x-navbar :name="$name"></x-navbar>

    <div class="max-w-6xl mx-auto w-full px-6 py-10 flex-1">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800">📝 All Quizzes</h1>
                <p class="text-sm text-slate-400 mt-1">Total: {{ count($quizzes) }} quizzes</p>
            </div>
            <a href="/admin_dashboard"
                class="bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-sm font-semibold px-4 py-2 rounded-xl transition">
                ← Back
            </a>
        </div>

        <!-- Quizzes Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-16">ID</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Quiz Name</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Category</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-24 text-center">MCQs</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-40">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($quizzes as $quiz)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <span class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 text-xs font-bold flex items-center justify-center">
                                {{ $quiz->id }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-700">{{ $quiz->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $quiz->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-violet-50 text-violet-600 text-xs font-semibold px-2 py-1 rounded-full">{{ $quiz->mcq_count }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-xs">{{ $quiz->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
