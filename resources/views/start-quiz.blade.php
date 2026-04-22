<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Quiz</title>
    @vite('resources/css/app.css')
    <style>
        .grad-btn { background: linear-gradient(135deg,#6366f1 0%,#8b5cf6 50%,#ec4899 100%); }
        .grad-btn:hover { opacity:0.9; }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <x-usernavbar></x-usernavbar>

    @if(session('success'))
        <div class="bg-green-50 border-b border-green-200 text-green-700 text-center px-4 py-2 text-sm">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-b border-red-200 text-red-600 text-center px-4 py-2 text-sm">❌ {{ session('error') }}</div>
    @endif

    <div class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-10 text-center border border-purple-50">

            <!-- Back -->
        <a href="javascript:history.back()" class="inline-flex items-center gap-1 text-indigo-500 hover:text-indigo-700 text-sm font-semibold mb-6 transition">
            ← Back
        </a>

        <!-- Icon -->
            <div class="w-20 h-20 rounded-2xl grad-btn flex items-center justify-center text-4xl mx-auto mb-6 shadow-lg">📝</div>

            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">{{ $quizname }}</h1>
            <p class="text-gray-500 text-sm mb-1">
                This quiz contains <span class="font-bold text-indigo-600">{{ $totalMcqs }}</span> questions
            </p>
            <p class="text-gray-400 text-xs mb-8">No time limit — take your time and do your best!</p>

            <!-- Good Luck Banner -->
            <div class="rounded-2xl px-6 py-4 mb-8 text-white font-semibold text-base shadow-inner"
                style="background:linear-gradient(135deg,#6366f1,#8b5cf6,#ec4899);">
                🍀 Good Luck! You've got this.
            </div>

            @if(session('user'))
                <a href="/attempt-mcq/{{ session('firstMcq')->id.'/'.$quizname }}/"
                    class="grad-btn inline-block text-white font-bold px-10 py-3 rounded-xl transition text-base shadow-lg">
                    Start Quiz →
                </a>
            @else
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="/user_signup_quiz"
                        class="grad-btn text-white font-semibold px-6 py-2.5 rounded-xl transition shadow">
                        Sign Up to Start
                    </a>
                    <a href="/user_login_quiz"
                        class="bg-white border-2 border-indigo-500 text-indigo-600 font-semibold px-6 py-2.5 rounded-xl transition hover:bg-indigo-50">
                        Login to Start
                    </a>
                </div>
            @endif
        </div>
    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
