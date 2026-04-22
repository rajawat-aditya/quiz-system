<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center min-h-screen">

    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md">
        <div class="text-center mb-8">
            <div class="text-4xl mb-2">🔐</div>
            <h3 class="text-2xl font-bold text-gray-800">Admin Login</h3>
            <p class="text-gray-500 text-sm mt-1">Sign in to your admin panel</p>
        </div>

        @error('user')
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg px-4 py-2 mb-4 text-sm">{{ $message }}</div>
        @enderror

        <form action="admin_login" method="post" class="space-y-5">
            @csrf
            <div>
                <label for="name1" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="name" placeholder="@adminname" id="name1"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="pass" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" id="pass"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition">
                Login
            </button>
        </form>
    </div>

</body>
</html>
