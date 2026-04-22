<div>
    <nav class="bg-slate-900 shadow-lg px-6 py-4 border-b border-slate-700">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <span class="text-xl font-extrabold text-white tracking-tight flex items-center gap-2">
                🧠 QuizSystem
                <span class="bg-indigo-600 text-indigo-100 text-xs font-semibold px-2 py-0.5 rounded-md">Admin</span>
            </span>

            <div class="hidden md:flex items-center space-x-1">
                <a href="/admin_dashboard" class="text-slate-300 hover:text-white hover:bg-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition">📊 Dashboard</a>
                <a href="/admin_category" class="text-slate-300 hover:text-white hover:bg-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition">📂 Categories</a>
                <a href="/add_quiz" class="text-slate-300 hover:text-white hover:bg-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition">➕ Add Quiz</a>
                <span class="text-slate-400 text-sm px-3">👤 {{ $name }}</span>
                <a href="admin_logout" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Logout</a>
            </div>

            <button onclick="document.getElementById('admin-mobile-menu').classList.toggle('hidden')" class="md:hidden text-slate-300 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="admin-mobile-menu" class="hidden md:hidden mt-3 space-y-1 px-2 pb-2">
            <a href="/admin_dashboard" class="block text-slate-300 hover:text-white py-2 px-3 rounded-lg text-sm">📊 Dashboard</a>
            <a href="/admin_category" class="block text-slate-300 hover:text-white py-2 px-3 rounded-lg text-sm">📂 Categories</a>
            <a href="/add_quiz" class="block text-slate-300 hover:text-white py-2 px-3 rounded-lg text-sm">➕ Add Quiz</a>
            <a href="admin_logout" class="block text-red-400 py-2 px-3 rounded-lg text-sm">Logout</a>
        </div>
    </nav>
</div>
