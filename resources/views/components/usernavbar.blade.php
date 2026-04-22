<div>
    <nav class="bg-white shadow-sm border-b border-gray-100 px-6 py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold tracking-tight" style="background: linear-gradient(135deg,#6366f1,#ec4899); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">
                🧠 QuizSystem
            </a>

            <!-- Desktop -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/" class="text-gray-600 hover:text-indigo-600 font-medium transition text-sm">Home</a>
                <a href="/show-category" class="text-gray-600 hover:text-indigo-600 font-medium transition text-sm">Categories</a>
                @if(Session('user'))
                    <a href="/user-details" class="text-gray-600 hover:text-indigo-600 font-medium transition text-sm">👤 {{ Session('user')->name }}</a>
                    <a href="/user_logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-xl text-sm font-semibold transition">Logout</a>
                @else
                    <a href="/user_login" class="text-gray-600 hover:text-indigo-600 font-medium transition text-sm">Login</a>
                    <a href="/user_signup" class="text-white px-4 py-1.5 rounded-xl text-sm font-semibold transition" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);">Sign Up</a>
                    <a href="/admin_login" class="text-gray-600 hover:text-red-600 font-medium transition text-sm border-l border-gray-300 pl-6">Admin Login</a>
                @endif
            </div>

            <!-- Hamburger -->
            <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden text-gray-500 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile -->
        <div id="mobile-menu" class="hidden md:hidden mt-3 space-y-2 px-2 pb-2">
            <a href="/" class="block text-gray-600 hover:text-indigo-600 py-1 text-sm">Home</a>
            <a href="/show-category" class="block text-gray-600 hover:text-indigo-600 py-1 text-sm">Categories</a>
            @if(Session('user'))
                <a href="/user-details" class="block text-gray-600 hover:text-indigo-600 py-1 text-sm">👤 {{ Session('user')->name }}</a>
                <a href="/user_logout" class="block text-red-500 py-1 text-sm">Logout</a>
            @else
                <a href="/user_login" class="block text-gray-600 hover:text-indigo-600 py-1 text-sm">Login</a>
                <a href="/user_signup" class="block text-indigo-600 font-semibold py-1 text-sm">Sign Up</a>
                <a href="/admin_login" class="block text-gray-600 hover:text-red-600 py-1 text-sm border-t border-gray-300 pt-2 mt-1">Admin Login</a>
            @endif
        </div>
    </nav>
</div>
