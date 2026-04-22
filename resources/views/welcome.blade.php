<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizSystem - Test Your Skills</title>
    @vite('resources/css/app.css')
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 40%, #ec4899 100%);
        }
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(99,102,241,0.15);
        }
        .section-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #ec4899);
            border-radius: 2px;
            margin-top: 8px;
        }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen font-sans">

    <x-usernavbar></x-usernavbar>

    <!-- Hero Section -->
    <div class="hero-bg text-white py-20 px-6 text-center relative overflow-hidden">
        <!-- decorative blobs -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white opacity-5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full translate-x-1/3 translate-y-1/3"></div>

        @if(session('success'))
            <div class="bg-white/20 backdrop-blur text-white rounded-xl px-5 py-2 mb-6 inline-block text-sm font-medium border border-white/30">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/30 backdrop-blur text-white rounded-xl px-5 py-2 mb-6 inline-block text-sm font-medium border border-red-300/30">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="relative z-10">
            <span class="bg-white/20 text-white text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-widest mb-5 inline-block">
                🎯 Quiz Platform
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight">
                Test Your Skills.<br>
                <span class="text-yellow-300">Earn Your Certificate.</span>
            </h1>
            <p class="text-indigo-100 text-lg mb-10 max-w-xl mx-auto">
                Attempt quizzes across multiple categories, track your progress, and prove your knowledge.
            </p>

            <!-- Search Bar -->
            <div class="max-w-lg mx-auto">
                <form action="/quiz-search" method="get" class="flex gap-2 bg-white/10 backdrop-blur p-2 rounded-2xl border border-white/20">
                    <input class="flex-1 px-5 py-3 bg-white text-gray-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-300 text-sm"
                        type="text" name="search" placeholder="Search for a quiz...">
                    <button class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-6 py-3 rounded-xl transition text-sm">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    @php
        $totalCats   = \App\Models\Category::count();
        $totalQuizzes = \App\Models\Quiz::count();
        $totalMCQs   = \App\Models\MCQ::count();
    @endphp
    <div class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-6 grid grid-cols-3 divide-x divide-gray-100 text-center">
            <div class="px-4">
                <p class="text-3xl font-extrabold text-indigo-600">{{ $totalCats }}</p>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wide">Categories</p>
            </div>
            <div class="px-4">
                <p class="text-3xl font-extrabold text-purple-600">{{ $totalQuizzes }}</p>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wide">Quizzes</p>
            </div>
            <div class="px-4">
                <p class="text-3xl font-extrabold text-pink-500">{{ $totalMCQs }}</p>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wide">Questions</p>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto w-full px-6 py-12 flex-1">

        <!-- Top Categories -->
        <h2 class="text-2xl font-extrabold text-gray-800 mb-6 section-title">📂 Top Categories</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-14">
            @foreach ($categories as $key => $category)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 card-hover flex items-center justify-between">
                <div>
                    <p class="text-xs text-indigo-400 font-semibold uppercase tracking-wide mb-1">Category</p>
                    <h3 class="text-gray-800 font-bold text-base">{{ $category->name }}</h3>
                    <p class="text-gray-400 text-xs mt-1">{{ $category->quizes_count }} Quizzes</p>
                </div>
                <a href="user-quiz-list/{{ $category->id }}/{{ str_replace(' ', '-', $category->name) }}"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition shadow">
                    View →
                </a>
            </div>
            @endforeach
        </div>

        <!-- Top Quizzes -->
        <h2 class="text-2xl font-extrabold text-gray-800 mb-6 section-title">🏆 Top Quizzes</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($quizdata as $key => $quiz)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 card-hover">
                <div class="flex items-start justify-between mb-4">
                    <span class="bg-indigo-50 text-indigo-500 text-xs font-bold px-3 py-1 rounded-full">#{{ $key + 1 }}</span>
                    <span class="text-2xl">📝</span>
                </div>
                <h3 class="text-gray-800 font-bold text-base mb-4 leading-snug">{{ $quiz->name }}</h3>
                <a href="/start-quiz/{{ $quiz->id }}/{{ str_replace(' ', '-', $quiz->name) }}"
                    class="block text-center bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white py-2 rounded-xl text-sm font-semibold transition shadow">
                    Attempt Quiz 🚀
                </a>
            </div>
            @endforeach
        </div>

    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
