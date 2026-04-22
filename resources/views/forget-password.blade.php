<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite('resources/css/app.css')
    <style>
        .grad-btn { background: linear-gradient(135deg,#6366f1 0%,#8b5cf6 50%,#ec4899 100%); }
        .grad-btn:hover { opacity: 0.9; }
        .grad-text { background: linear-gradient(135deg,#6366f1,#ec4899); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .input-focus:focus { outline:none; border-color:#8b5cf6; box-shadow:0 0 0 3px rgba(139,92,246,0.15); }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background:linear-gradient(135deg,#f0f0ff 0%,#fdf2f8 100%);">

    <x-usernavbar></x-usernavbar>

    <div class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-10 border border-purple-50">

            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl grad-btn flex items-center justify-center text-3xl mx-auto mb-4 shadow-lg">🔑</div>
                <h3 class="text-2xl font-extrabold text-gray-800">Forgot Password</h3>
                <p class="text-gray-400 text-sm mt-1">Enter your email to receive a reset link</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-2 mb-4 text-sm">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-2 mb-4 text-sm">❌ {{ session('error') }}</div>
            @endif
            @error('user')
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-2 mb-4 text-sm">{{ $message }}</div>
            @enderror

            <form action="/forget-password" method="post" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Email Address</label>
                    <input type="email" name="email" placeholder="abc@gmail.com"
                        class="input-focus w-full px-4 py-3 border border-gray-200 rounded-xl text-sm transition bg-gray-50">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <button class="grad-btn w-full py-3 text-white font-bold rounded-xl transition text-sm shadow-lg">
                    Send Reset Link →
                </button>

                <p class="text-center text-xs text-gray-400">
                    Remembered it? <a href="/user_login" class="grad-text font-semibold hover:opacity-80">Back to Login</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>
