<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - MCQ</title>
    @vite('resources/css/app.css')
    <style>
        .option-label { transition: all 0.15s ease; cursor: pointer; }
        .option-label:hover { background: #f5f3ff; border-color: #8b5cf6; }
        input[type="radio"]:checked + span { color: #6366f1; font-weight: 700; }
        .grad-btn { background: linear-gradient(135deg,#6366f1 0%,#8b5cf6 50%,#ec4899 100%); }
        .grad-btn:hover { opacity:0.9; }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <x-usernavbar></x-usernavbar>

    <div class="flex-1 flex flex-col items-center justify-center px-4 py-10">

        <!-- Progress Info -->
        <div class="w-full max-w-xl mb-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-semibold text-indigo-500">{{ $quizName }}</span>
                <span class="text-sm text-gray-400 font-medium">
                    Question {{ session('currentQuiz.currentMcq') }} / {{ session('currentQuiz.totalMcqs') }}
                </span>
            </div>
            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="h-2 rounded-full transition-all"
                    style="background:linear-gradient(135deg,#6366f1,#ec4899); width:{{ (session('currentQuiz.currentMcq') / session('currentQuiz.totalMcqs')) * 100 }}%">
                </div>
            </div>
        </div>

        <!-- MCQ Card -->
        <div class="bg-white rounded-3xl shadow-xl w-full max-w-xl p-8 border border-purple-50">

            <h3 class="text-gray-800 font-bold text-lg mb-6 leading-snug">
                <span class="text-indigo-400 font-extrabold mr-2">Q.</span>{{ $mcqData->question }}
            </h3>

            <form action="/submit-next/{{ $mcqData->id }}" method="post" class="space-y-3">
                @csrf
                <input type="hidden" value="{{ $mcqData->id }}" name="mcq_id">

                @foreach(['a' => $mcqData->a, 'b' => $mcqData->b, 'c' => $mcqData->c, 'd' => $mcqData->d] as $val => $text)
                <label for="option_{{ $val }}" class="option-label flex items-center gap-3 border border-gray-200 p-4 rounded-2xl">
                    <input id="option_{{ $val }}" type="radio" class="accent-indigo-500 w-4 h-4" value="{{ $val }}" name="option">
                    <span class="text-gray-700 text-sm">{{ $text }}</span>
                </label>
                @endforeach

                <button type="submit" class="grad-btn w-full py-3 text-white font-bold rounded-xl transition shadow-lg mt-2 text-sm">
                    Submit & Next →
                </button>
            </form>
        </div>
    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
