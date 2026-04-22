<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    @vite('resources/css/app.css')
    <style>
        .input-focus:focus { outline:none; border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,0.15); }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col">

    <x-navbar :name="$name"></x-navbar>

    <div class="max-w-5xl mx-auto w-full px-6 py-10 flex-1">

        @if(session('category'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-2 mb-5 text-sm">✅ {{ session('category') }}</div>
        @endif
        @if(session('deleteMessage'))
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-2 mb-5 text-sm">🗑️ {{ session('deleteMessage') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Add Category Form -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-bold text-slate-700 mb-5">📂 Add Category</h3>
                    <form action="admin_category" method="get" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-600 mb-1.5">Category Name</label>
                            <input type="text" name="category" placeholder="e.g. Science"
                                class="input-focus w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 transition">
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-sm transition">
                            Add Category
                        </button>
                    </form>
                </div>
            </div>

            <!-- Category List -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-bold text-slate-700">Category List</h3>
                        <span class="text-xs text-slate-400">{{ count($categories) }} total</span>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @foreach($categories as $category)
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 text-xs font-bold flex items-center justify-center">
                                    {{ $category->id }}
                                </span>
                                <div>
                                    <p class="text-slate-700 font-semibold text-sm">{{ $category->name }}</p>
                                    <p class="text-slate-400 text-xs">by {{ $category->creator }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="quiz_list/{{ $category->id }}/{{ $category->name }}"
                                    class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                    View
                                </a>
                                <a href="delete_category/{{ $category->id }}"
                                    class="bg-red-50 hover:bg-red-100 text-red-500 text-xs font-semibold px-3 py-1.5 rounded-lg transition"
                                    onclick="return confirm('Delete this category?')">
                                    Delete
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
