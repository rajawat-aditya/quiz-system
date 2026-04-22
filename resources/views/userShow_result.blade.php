<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    @vite('resources/css/app.css')
    <style>
        .grad-bg { background: linear-gradient(135deg,#6366f1 0%,#8b5cf6 40%,#ec4899 100%); }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <x-usernavbar></x-usernavbar>

    <!-- Result Banner -->
    <div class="grad-bg text-white py-12 px-6 text-center">
        @if($correctAnswer * 100 / $totalMcqs >= 70)
            <div class="text-5xl mb-3">🎉</div>
            <h1 class="text-3xl font-extrabold mb-2">Congratulations! You Passed!</h1>
            <p class="text-indigo-100 text-sm mb-4">You scored {{ $correctAnswer }} out of {{ $totalMcqs }}</p>
            <a href="/certificate"
                class="inline-block bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-6 py-2.5 rounded-xl transition shadow text-sm">
                🏆 View & Download Certificate
            </a>
        @else
            <div class="text-5xl mb-3">😔</div>
            <h1 class="text-3xl font-extrabold mb-2">Better Luck Next Time!</h1>
            <p class="text-indigo-100 text-sm">You scored {{ $correctAnswer }} out of {{ $totalMcqs }} — need 70% to pass</p>
        @endif
    </div>

    <!-- Score Card -->
    <div class="max-w-3xl mx-auto w-full px-6 py-10 flex-1">

        <!-- Score Summary -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-2xl p-5 text-center shadow-sm border border-gray-100">
                <p class="text-3xl font-extrabold text-indigo-600">{{ $totalMcqs }}</p>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wide">Total</p>
            </div>
            <div class="bg-white rounded-2xl p-5 text-center shadow-sm border border-gray-100">
                <p class="text-3xl font-extrabold text-green-500">{{ $correctAnswer }}</p>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wide">Correct</p>
            </div>
            <div class="bg-white rounded-2xl p-5 text-center shadow-sm border border-gray-100">
                <p class="text-3xl font-extrabold text-red-400">{{ $totalMcqs - $correctAnswer }}</p>
                <p class="text-xs text-gray-400 mt-1 uppercase tracking-wide">Wrong</p>
            </div>
        </div>

        <!-- Result Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-700 text-base">Detailed Results</h2>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach ($resultData as $key => $item)
                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-full bg-indigo-50 text-indigo-500 text-xs font-bold flex items-center justify-center">
                            {{ $key + 1 }}
                        </span>
                        <p class="text-gray-700 text-sm">{{ $item->question }}</p>
                    </div>
                    @if($item->is_correct)
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">✓ Correct</span>
                    @else
                        <span class="text-xs font-bold text-red-500 bg-red-50 px-3 py-1 rounded-full">✗ Wrong</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center mt-8 flex justify-center gap-6">
            <a href="/" class="text-indigo-600 hover:underline text-sm font-semibold">← Back to Home</a>
            <a href="/show-category" class="text-purple-500 hover:underline text-sm font-semibold">Browse Categories</a>
        </div>
    </div>

    <x-userfooter></x-userfooter>
</body>
</html>
