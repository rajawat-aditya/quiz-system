<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <style>
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <x-navbar :name="$name"></x-navbar>

    <div class="max-w-7xl mx-auto w-full px-6 py-10 flex-1">

        <!-- Welcome Banner -->
        <div class="rounded-2xl p-8 mb-8 text-white relative overflow-hidden" style="background: linear-gradient(135deg,#1e293b 0%,#334155 60%,#475569 100%);">
            <div class="absolute right-6 top-4 text-8xl opacity-10">🧠</div>
            <p class="text-slate-400 text-sm mb-1 uppercase tracking-widest">Welcome back,</p>
            <h1 class="text-3xl font-extrabold mb-2">{{ $name }} 👋</h1>
            <p class="text-slate-300 text-sm">Manage your quiz platform from here.</p>
            <div class="flex gap-3 mt-5">
                <a href="/admin_category" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition">+ Add Category</a>
                <a href="/add_quiz" class="bg-slate-600 hover:bg-slate-500 text-white text-sm font-semibold px-5 py-2 rounded-xl transition">+ Add Quiz</a>
            </div>
        </div>

        <!-- Stats -->
        @php
            $totalCategories = \App\Models\Category::count();
            $totalQuizzes    = \App\Models\Quiz::count();
            $totalMCQs       = \App\Models\MCQ::count();
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
            <a href="/admin_all_categories" class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-indigo-200 transition cursor-pointer">
                <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center text-2xl">📂</div>
                <div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalCategories }}</p>
                    <p class="text-slate-400 text-sm mt-0.5">Total Categories</p>
                </div>
            </a>
            <a href="/admin_all_quizzes" class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-violet-200 transition cursor-pointer">
                <div class="w-14 h-14 rounded-xl bg-violet-100 flex items-center justify-center text-2xl">📝</div>
                <div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalQuizzes }}</p>
                    <p class="text-slate-400 text-sm mt-0.5">Total Quizzes</p>
                </div>
            </a>
            <a href="/admin_all_mcqs" class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-pink-200 transition cursor-pointer">
                <div class="w-14 h-14 rounded-xl bg-pink-100 flex items-center justify-center text-2xl">❓</div>
                <div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalMCQs }}</p>
                    <p class="text-slate-400 text-sm mt-0.5">Total MCQs</p>
                </div>
            </a>
            <a href="/admin_users" class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-green-200 transition cursor-pointer">
                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-2xl">👥</div>
                <div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalUser }}</p>
                    <p class="text-slate-400 text-sm mt-0.5">Total Users</p>
                </div>
            </a>
        </div>

   


   


        <!-- Quick Actions -->
        <h2 class="text-lg font-bold text-slate-700 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <a href="/admin_category" class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-indigo-200 transition">
                <div class="w-12 h-12 rounded-xl bg-indigo-600 flex items-center justify-center text-xl text-white">📂</div>
                <div>
                    <p class="font-bold text-slate-700">Manage Categories</p>
                    <p class="text-slate-400 text-xs mt-0.5">Add or delete categories</p>
                </div>
            </a>
            <a href="/add_quiz" class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-violet-200 transition">
                <div class="w-12 h-12 rounded-xl bg-violet-600 flex items-center justify-center text-xl text-white">➕</div>
                <div>
                    <p class="font-bold text-slate-700">Add New Quiz</p>
                    <p class="text-slate-400 text-xs mt-0.5">Create quiz with MCQs</p>
                </div>
            </a>
            <a href="/admin_category" class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 hover:border-pink-200 transition">
                <div class="w-12 h-12 rounded-xl bg-pink-500 flex items-center justify-center text-xl text-white">📋</div>
                <div>
                    <p class="font-bold text-slate-700">View All Quizzes</p>
                    <p class="text-slate-400 text-xs mt-0.5">Browse by category</p>
                </div>
            </a>
        </div>

    </div>

</body>
</html>
