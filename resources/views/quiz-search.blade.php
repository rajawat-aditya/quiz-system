<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    @vite('resources/css/app.css')
    <style>
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(99,102,241,0.15); }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <x-usernavbar></x-usernavbar>

    <!-- Header -->
    <div style="background:linear-gradient(135deg,#6366f1 0%,#8b5cf6 40%,#ec4899 100%);" class="text-white py-12 px-6 text-center">
        <h1 class="text-4xl font-extrabold mb-2">🔍 Search Results</h1>
        <p class="text-indigo-100 text-sm">Results for: <span class="font-bold text-yellow-300">{{ $quiz }}</span></p>
    </div>

    <div class="max-w-6xl mx-auto w-full px-6 py-10 flex-1">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($quizdata as $quiz)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 card-hover">
                <div class="flex items-start justify-between mb-4">
                    <span class="bg-indigo-50 text-indigo-500 text-xs font-bold px-3 py-1 rounded-full">#{{ $quiz->id }}</span>
                    <span class="text-2xl">📝</span>
                </div>
                <h3 class="text-gray-800 font-bold text-base mb-1 leading-snug">{{ $quiz->name }}</h3>
                <p class="text-gray-400 text-xs mb-4">{{ $quiz->mcq_count }} Questions</p>
                <a href="/start-quiz/{{ $quiz->id }}/{{ str_replace(' ', '-', $quiz->name) }}"
                    class="block text-center text-white py-2 rounded-xl text-sm font-semibold transition shadow"
                    style="background:linear-gradient(135deg,#8b5cf6,#ec4899);">
                    Attempt Quiz 🚀
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
