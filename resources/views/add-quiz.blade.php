<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz</title>
    @vite('resources/css/app.css')
    <style>
        .input-focus:focus { outline:none; border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,0.15); }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <x-navbar :name="$name"></x-navbar>

    <div class="flex-1 flex items-start justify-center px-4 py-10">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 w-full max-w-lg p-8">

            @if(!session('quizDetails'))

                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white text-lg">📝</div>
                    <h3 class="text-xl font-bold text-slate-700">Create New Quiz</h3>
                </div>

                <form action="add_quiz" method="get" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Quiz Name</label>
                        <input type="text" name="quizName" required placeholder="e.g. General Knowledge"
                            class="input-focus w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Category</label>
                        <select name="category_id" class="input-focus w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 transition">
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-sm transition">
                        Create Quiz →
                    </button>
                </form>

            @else

                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl bg-violet-600 flex items-center justify-center text-white text-lg">❓</div>
                    <h3 class="text-xl font-bold text-slate-700">Add MCQs</h3>
                </div>

                <div class="bg-slate-50 rounded-xl px-4 py-3 mb-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400">Quiz</p>
                        <p class="font-bold text-slate-700 text-sm">{{ session('quizDetails')->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400">MCQs Added</p>
                        <p class="font-bold text-indigo-600 text-sm">
                            {{ $totalMCQs }}
                            @if($totalMCQs > 0)
                                <a href="/show_quiz/{{ session('quizDetails')->id }}/{{ session('quizDetails')->name }}" class="text-xs text-indigo-400 hover:underline ml-1">(View)</a>
                            @endif
                        </p>
                    </div>
                </div>

                <form action="add_mcq" method="post" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Question</label>
                        <textarea name="mcqname" rows="3" placeholder="Enter your question here..."
                            class="input-focus w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 transition resize-none"></textarea>
                        @error('mcqname')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    @foreach(['a' => 'Option A', 'b' => 'Option B', 'c' => 'Option C', 'd' => 'Option D'] as $key => $label)
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">{{ $label }}</label>
                        <input type="text" name="{{ $key }}" placeholder="{{ $label }}"
                            class="input-focus w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 transition">
                        @error($key)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    @endforeach

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Correct Answer</label>
                        <select name="correct_ans" class="input-focus w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 transition">
                            <option value="">Select correct option</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                        @error('correct_ans')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex gap-3 pt-1">
                        <button type="submit" name="submit" value="add-more"
                            class="flex-1 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl text-sm transition">
                            + Add More
                        </button>
                        <button type="submit" name="submit" value="done"
                            class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-sm transition">
                            Save
                        </button>
                    </div>
                    <a href="end_quiz"
                        class="block text-center py-2.5 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-xl text-sm transition border border-red-100">
                        🏁 Finish Quiz
                    </a>
                </form>

            @endif
        </div>
    </div>

</body>
</html>
