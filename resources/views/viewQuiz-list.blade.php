<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin Quiz List</title>
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
                <p class="text-xs text-slate-400 uppercase tracking-wide mb-1">Category</p>
                <h1 class="text-2xl font-extrabold text-slate-800">{{ $categories }}</h1>
            </div>
            <a href="/admin_category"
                class="bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 text-sm font-semibold px-4 py-2 rounded-xl transition shadow-sm">
                ← Back
            </a>
        </div>

        <!-- Quiz Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-700">Quizzes</h3>
                <span class="text-xs text-slate-400">{{ count($quizData) }} total</span>
            </div>
            <div class="divide-y divide-slate-50">
                @foreach($quizData as $quiz)
                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 text-xs font-bold flex items-center justify-center">
                            {{ $quiz->id }}
                        </span>
                        <p class="text-slate-700 font-semibold text-sm">{{ $quiz->name }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="/show_quiz/{{ $quiz->id }}/{{ $quiz->name }}"
                            class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                            View MCQs
                        </a>
                        <a href="/delete_quiz/{{ $quiz->id }}"
                            class="bg-red-50 hover:bg-red-100 text-red-500 text-xs font-semibold px-3 py-1.5 rounded-lg transition"
                            onclick="return confirm('Delete this quiz and all its MCQs?')">
                            Delete
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</body>
</html>
