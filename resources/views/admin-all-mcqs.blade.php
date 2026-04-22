<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All MCQs</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <x-navbar :name="$name"></x-navbar>

    <div class="max-w-6xl mx-auto w-full px-6 py-10 flex-1">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800">❓ All MCQs</h1>
                <p class="text-sm text-slate-400 mt-1">Total: {{ count($mcqs) }} questions</p>
            </div>
            <a href="/admin_dashboard"
                class="bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-sm font-semibold px-4 py-2 rounded-xl transition">
                ← Back
            </a>
        </div>

        <!-- MCQs Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-16">ID</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Question</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-48">Quiz</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-32">Category</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-40">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($mcqs as $mcq)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <span class="w-8 h-8 rounded-lg bg-pink-50 text-pink-500 text-xs font-bold flex items-center justify-center">
                                {{ $mcq->id }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-700 leading-relaxed">{{ Str::limit($mcq->question, 80) }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $mcq->quiz->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $mcq->category->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-slate-400 text-xs">{{ $mcq->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
