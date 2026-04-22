<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    @vite('resources/css/app.css')
    <style>
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(99,102,241,0.15); }
        .grad-btn { background: linear-gradient(135deg,#6366f1,#8b5cf6); }
        .grad-btn:hover { opacity:0.9; }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <x-usernavbar></x-usernavbar>

    <!-- Page Header -->
    <div style="background:linear-gradient(135deg,#6366f1 0%,#8b5cf6 40%,#ec4899 100%);" class="text-white py-12 px-6 text-center">
        <h1 class="text-4xl font-extrabold mb-2">📂 All Categories</h1>
        <p class="text-indigo-100 text-sm">Browse all quiz categories and pick your challenge</p>
    </div>

    <div class="max-w-6xl mx-auto w-full px-6 py-10 flex-1">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-2 mb-5 text-sm">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-2 mb-5 text-sm">❌ {{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($categories as $key => $category)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 card-hover flex items-center justify-between">
                <div>
                    <p class="text-xs text-indigo-400 font-semibold uppercase tracking-wide mb-1">Category</p>
                    <h3 class="text-gray-800 font-bold text-base">{{ $category->name }}</h3>
                    <p class="text-gray-400 text-xs mt-1">{{ $category->quizes_count }} Quizzes</p>
                </div>
                <a href="user-quiz-list/{{ $category->id }}/{{ $category->name }}"
                    class="grad-btn text-white px-4 py-2 rounded-xl text-xs font-semibold transition shadow">
                    View →
                </a>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $categories->links() }}
        </div>
    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
