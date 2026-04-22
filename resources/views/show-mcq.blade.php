<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> admin MCQ List</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <x-navbar :name="$name"></x-navbar>

    <div class="max-w-4xl mx-auto w-full px-6 py-10 flex-1">

        @if(session('deleteMessage'))
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-2 mb-5 text-sm">🗑️ {{ session('deleteMessage') }}</div>
        @endif

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">Quiz</p>
                <h1 class="text-2xl font-extrabold text-slate-800">{{ $quizName }}</h1>
            </div>
            <a href="javascript:history.back()"
                class="bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-sm font-semibold px-4 py-2 rounded-xl transition shadow-sm cursor-pointer">
                ← Back
            </a>
        </div>

        <!-- MCQ List -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-700">MCQ Questions</h3>
                <span class="text-xs text-slate-600">{{ count($showMcqs) }} questions</span>
            </div>
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-16">Sr. No.</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Question</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-24 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($showMcqs as $key => $mcq)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <span class="w-8 h-8 rounded-lg bg-pink-50 text-pink-500 text-xs font-bold flex items-center justify-center">
                                {{ $key + 1 }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-700 leading-relaxed">{{ $mcq->question }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="/delete_mcq/{{ $mcq->id }}"
                                class="bg-red-50 hover:bg-red-100 text-red-500 text-xs font-semibold px-3 py-1.5 rounded-lg transition inline-block"
                                onclick="return confirm('Delete this MCQ?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
